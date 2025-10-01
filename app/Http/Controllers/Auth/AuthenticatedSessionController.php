<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
{
    // On récupère tous les rôles distincts depuis la table users
    $roles = User::select('role')->distinct()->pluck('role');

    return view('auth.login', compact('roles'));
}

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
{
    // Authentifie avec email + mot de passe
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user();

    // Vérification du rôle choisi dans le formulaire
    if ($request->has('role') && $user->role !== $request->role) {
        Auth::logout();
        return back()->withErrors([
            'role' => 'Rôle incorrect pour cet utilisateur.',
        ]);
    }

    // Vérification Région (uniquement pour admin_region)
    if ($user->role === 'admin_region') {
        if (!$request->filled('region_id') || $user->region_id != $request->region_id) {
            Auth::logout();
            return back()->withErrors([
                'region_id' => 'Vous devez sélectionner la région qui vous est assignée.',
            ]);
        }
        // Stocker la région dans la session
        session(['region_id' => $request->region_id]);
    }

    // Vérification Bureau (pour admin_bureau et employe)
    if (in_array($user->role, ['admin_bureau', 'employe'])) {
        if (!$request->filled('bureau_id') || $user->bureau_id != $request->bureau_id) {
            Auth::logout();
            return back()->withErrors([
                'bureau_id' => 'Vous devez sélectionner le bureau qui vous est assigné.',
            ]);
        }
        // Stocker le bureau dans la session
        session(['bureau_id' => $request->bureau_id]);
    }

    // Redirection en fonction du rôle de l'utilisateur
    switch ($user->role) {
        case 'admin_global':
            return redirect()->route('admin.global.dashboard');
        case 'admin_region':
            return redirect()->route('admin.region.dashboard');
        case 'admin_bureau':
            return redirect()->route('dashboards.admin_bureau');
        case 'employe':
            return redirect()->route('employe.dashboard');
        default:
            return redirect()->route('client.dashboard');
    }
}



    /**
     * Destroy an authenticated session with employee-specific redirection.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Vérifier si l'utilisateur est un employé
        if ($request->user() && $request->user()->hasRole('employe')) {
            return redirect()->route('employe.dashboard');
        }

        return redirect('/');
    }
}
