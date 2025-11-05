<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Exposer quelques endpoints utiles pour l'application
    Route::get('/colis', [\App\Http\Controllers\Api\ColisController::class, 'index']);
    Route::get('/colis/{colis}', [\App\Http\Controllers\Api\ColisController::class, 'show']);
});

// Public endpoints
Route::get('/tracking/{code_suivi}', [\App\Http\Controllers\Api\ColisController::class, 'tracking']);

// Auth API (token)
Route::post('/login', function (Request $r) {
    $credentials = $r->only('email', 'password');
    if (!\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    /** @var \App\Models\User $user */
    $user = \Illuminate\Support\Facades\Auth::user();
    // @phpstan-ignore-next-line - createToken vient de Laravel Sanctum (stub pour Intelephense)
    $token = $user->createToken('electron')->plainTextToken;
    return response()->json(['token' => $token]);
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $r) {
    $r->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out']);
});
