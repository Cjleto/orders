<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Effettua il login e restituisce un token di autenticazione.
     */
    public function login(Request $request)
    {
        // Validazione dei dati di input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tentativo di autenticazione
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => 'Login effettuato con successo',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // Se l'autenticazione fallisce
        return response()->json([
            'message' => 'Credenziali non valide',
        ], 401);
    }

    /**
     * Effettua il logout e revoca il token di autenticazione.
     */
    public function logout(Request $request)
    {
        // Revoca il token corrente
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout effettuato con successo',
        ], 200);
    }
}
