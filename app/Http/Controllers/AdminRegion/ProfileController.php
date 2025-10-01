<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Region;
use App\Models\Bureau;

class ProfileController extends Controller
{
    public function __construct()
    {
        // protége toutes les routes de ce contrôleur
        $this->middleware('auth');
    }

    /**
     * Affiche le formulaire d'édition du profil pour les employés.
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        // Fournir les listes pour affichage uniquement
        $regions = Region::all();
        $bureaux = Bureau::all();

        // Vérifier si l'utilisateur est un employé
        if ($user->hasRole('employe')) {
            return view('employe.profile.edit', [
                'user' => $user,
                'regions' => $regions,
                'bureaux' => $bureaux,
                'editableFields' => ['name', 'email', 'password'] // Champs modifiables
            ]);
        }

        return view('profile.edit', compact('user', 'regions', 'bureaux'));
    }

    /**
     * Met à jour le profil de l'utilisateur authentifié.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'], // password_confirmation
            'region_id' => ['nullable', 'exists:regions,id'],
            'bureau_id' => ['nullable', 'exists:bureaux,id'],
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        // Mettre à jour les relations (nullable)
        $user->region_id = $data['region_id'] ?? null;
        $user->bureau_id = $data['bureau_id'] ?? null;

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil mis à jour.');
    }

    /**
     * Supprime le compte de l'utilisateur connecté (après vérification du mot de passe).
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $user = $request->user();

        // Vérifier le mot de passe avant suppression
        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Mot de passe incorrect.']);
        }

        Auth::logout();

        // Suppression (les FK en cascade dans la BDD vont nettoyer les dépendances)
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Compte supprimé.');
    }
}
