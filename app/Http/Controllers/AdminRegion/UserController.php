<?php

namespace App\Http\Controllers\AdminRegion;

use App\Models\User;
use App\Models\Region;
use App\Models\Bureau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $regionId = Auth::user()->region_id;
        $bureauxIds = Bureau::where('region_id', $regionId)->pluck('id');
        $users = User::with(['region', 'bureau'])
            ->whereIn('role', ['employe', 'admin_bureau'])
            ->whereIn('bureau_id', $bureauxIds)
            ->paginate(10);
    return view('adminRegion.users.index', compact('users'));
    }


    public function create()
    {
        $regionId = Auth::user()->region_id;
        $bureaux = Bureau::where('region_id', $regionId)->get();
    return view('adminRegion.users.create', compact('bureaux'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'bureau_id' => 'required|exists:bureaux,id',
        ]);

        $data = $request->only(['name', 'email', 'bureau_id']);
        $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        $data['role'] = 'employe';

        // Récupérer la région via le bureau choisi
        $bureau = \App\Models\Bureau::find($data['bureau_id']);
        $data['region_id'] = $bureau ? $bureau->region_id : null;

        \App\Models\User::create($data);

        return redirect()->route('admin.region.users.index')->with('success', 'Employé créé avec succès.');
    }

    public function show(User $user)
    {
    return view('adminRegion.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $regionId = Auth::user()->region_id;
        $bureaux = Bureau::where('region_id', $regionId)->get();
    return view('adminRegion.users.edit', compact('user', 'bureaux'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|string|min:6',
            'role'      => 'required|in:admin_global,admin_region,admin_bureau,employe,client',
            'region_id' => 'nullable|exists:regions,id',
            'bureau_id' => 'nullable|exists:bureaux,id',
        ]);

        $data = $request->only(['name', 'email', 'role', 'region_id', 'bureau_id']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 🔹 Si le rôle est admin_bureau ou employe → la région vient du bureau choisi
        if (in_array($data['role'], ['admin_bureau', 'employe']) && $data['bureau_id']) {
            $bureau = Bureau::find($data['bureau_id']);
            $data['region_id'] = $bureau ? $bureau->region_id : null;
        }

        $user->update($data);

        return redirect()->route('admin.region.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.region.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function dashboard()
    {
        $bureauId = Auth::user()->bureau_id;
        $employes = \App\Models\User::whereIn('role', ['employe', 'admin_bureau'])->where('bureau_id', $bureauId)->get();
        $colisList = \App\Models\Colis::where('bureau_id', $bureauId)->with('client')->get();
        $clients = \App\Models\Client::whereHas('colis', function($q) use ($bureauId) {
            $q->where('bureau_id', $bureauId);
        })->get();
        return view('dashboards.admin.region', compact('employes', 'colisList', 'clients'));
    }
}
