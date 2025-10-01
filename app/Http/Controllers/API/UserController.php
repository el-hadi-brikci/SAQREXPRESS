<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Models\Bureau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() { return User::with(['region','bureau'])->get(); }
    public function create() { /* return view('admin.users.create', ['regions'=>Region::all(),'bureaux'=>Bureau::all()]); */ }
    public function store(Request $request) {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
            'role'=>'required|string',
            'region_id'=>'nullable|exists:regions,id',
            'bureau_id'=>'nullable|exists:bureaux,id',
        ]);
        return User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'region_id'=>$request->region_id,
            'bureau_id'=>$request->bureau_id,
        ]);
    }
    public function show(User $user) { return $user->load(['region','bureau']); }
    public function edit(User $user) { /* return view('admin.users.edit', compact('user')); */ }
    public function update(Request $request, User $user) {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'role'=>'required|string',
            'region_id'=>'nullable|exists:regions,id',
            'bureau_id'=>'nullable|exists:bureaux,id',
        ]);
        $data = $request->only('name','email','role','region_id','bureau_id');
        if($request->filled('password')) $data['password']=Hash::make($request->password);
        $user->update($data);
        return $user;
    }
    public function destroy(User $user) { $user->delete(); return response()->json(['message'=>'Utilisateur supprimé']); }
}
