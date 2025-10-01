<?php

namespace App\Http\Controllers\Employe;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Client::with(['colis'])
            ->whereHas('colis', function ($q) use ($user) {
                $q->where('bureau_id', $user->bureau_id)
                  ->orWhere('bureau_destination_id', $user->bureau_id);
            });

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        $clients = $query->paginate(10);

        return view('employe.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('employe.clients.create');
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

        // Cr\u00e9er le user li\u00e9
        $user = User::create([
            'name' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        // Cr\u00e9er le client
        Client::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'user_id' => $user->id,
        ]);

        return redirect()->route('employe.clients.index')->with('success', 'Client ajout\u00e9 avec succ\u00e8s.');
    }

    public function show(Client $client)
    {
        return view('employe.clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('employe.clients.edit', compact('client'));
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

        // Mise \u00e0 jour user
        $client->user->update([
            'name' => $request->nom,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $client->user->password,
        ]);

        // Mise \u00e0 jour client
        $client->update([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('employe.clients.index')->with('success', 'Client mis \u00e0 jour avec succ\u00e8s.');
    }

    public function destroy(Client $client)
    {
        $client->user->delete(); // Supprime aussi le user li\u00e9
        $client->delete();

        return redirect()->route('employe.clients.index')->with('success', 'Client supprim\u00e9 avec succ\u00e8s.');
    }
    public function colis(Client $client)
{
    $colis = $client->colis()->paginate(10);

    return view('employe.clients.colis', compact('client', 'colis'));
}


}

