<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Models\Bureau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // On exclut les clients par défaut
        $query = User::with(['region', 'bureau'])
                     ->where('role', '!=', 'client');

        // Si un filtre par rôle est appliqué
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Pagination
        $users = $query->paginate(10);

        return view('adminGlobal.users.index', compact('users'));
    }


    public function create()
    {
        $regions = Region::all();
        $bureaux = Bureau::with('region')->get();
        return view('adminGlobal.users.create', compact('regions', 'bureaux'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'role'      => 'required|in:admin_global,admin_region,admin_bureau,employe,client',
            'region_id' => 'nullable|exists:regions,id',
            'bureau_id' => 'nullable|exists:bureaux,id',
        ]);

        $data = $request->only(['name', 'email', 'role', 'region_id', 'bureau_id']);
        $data['password'] = Hash::make($request->password);

        // 🔹 Si le rôle est admin_bureau ou employe → on récupère la région via le bureau choisi
        if (in_array($data['role'], ['admin_bureau', 'employe']) && $data['bureau_id']) {
            $bureau = Bureau::find($data['bureau_id']);
            $data['region_id'] = $bureau ? $bureau->region_id : null;
        }

        User::create($data);

        return redirect()->route('admin.global.users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function show(User $user)
    {
        return view('adminGlobal.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $regions = Region::all();
        $bureaux = Bureau::with('region')->get();
        return view('adminGlobal.users.edit', compact('user', 'regions', 'bureaux'));
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

        return redirect()->route('admin.global.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.global.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
