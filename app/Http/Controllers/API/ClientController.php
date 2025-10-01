<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() { return Client::all(); }
    public function create() { /* return view('admin.clients.create'); */ }
    public function store(Request $request) {
        $request->validate([
            'nom'=>'required|string',
            'telephone'=>'required|string',
            'adresse'=>'required|string',
        ]);
        return Client::create($request->only('nom','telephone','adresse'));
    }
    public function show(Client $client) { return $client; }
    public function edit(Client $client) { /* return view('admin.clients.edit', compact('client')); */ }
    public function update(Request $request, Client $client) {
        $request->validate([
            'nom'=>'required|string',
            'telephone'=>'required|string',
            'adresse'=>'required|string',
        ]);
        $client->update($request->only('nom','telephone','adresse'));
        return $client;
    }
    public function destroy(Client $client) { $client->delete(); return response()->json(['message'=>'Client supprimé']); }
}
