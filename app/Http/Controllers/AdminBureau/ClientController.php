<?php

namespace App\Http\Controllers\AdminBureau;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $currentBureauId = Auth::user()->bureau_id;
        $query = Client::with(['colis', 'user'])
            ->whereHas('colis', function($q) use ($currentBureauId) {
                $q->where('bureau_id', $currentBureauId);
            });
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }
        $clients = $query->paginate(10);
        return view('adminBureau.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('adminBureau.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'password' => 'required|min:6',
        ]);
        $user = User::create([
            'name' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
            'bureau_id' => Auth::user()->bureau_id,
        ]);
        Client::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'user_id' => $user->id,
        ]);
        return redirect()->route('admin.bureau.clients.index')->with('success', 'Client ajouté avec succès.');
    }

    public function show(Client $client)
    {
        return view('adminBureau.clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('adminBureau.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $client->user_id,
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'password' => 'nullable|min:6',
        ]);
        $client->user->update([
            'name' => $request->nom,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $client->user->password,
        ]);
        $client->update([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);
        return redirect()->route('admin.bureau.clients.index')->with('success', 'Client mis à jour avec succès.');
    }

    public function destroy(Client $client)
    {
        $client->user->delete();
        $client->delete();
        return redirect()->route('admin.bureau.clients.index')->with('success', 'Client supprimé avec succès.');
    }

    public function colis(Client $client)
    {
        $colis = $client->colis()->paginate(10);
        return view('adminBureau.clients.colis', compact('client', 'colis'));
    }
}
