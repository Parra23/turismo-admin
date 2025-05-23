<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ApiAuthController extends Controller
{
    /** Procesar el login */

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);
        $data['role'] = 1;
        $response = Http::withoutVerifying()
            ->post(env('API_TURISMO_URL') . '/LoginRequest/login', $data);

        if (! $response->successful()) {
            $apiError = $response->json('error')
                ?? $response->json('message')
                ?? 'Error de autenticación';
            if ($request->ajax()) {
                return response()->json(['status' => 'error', 'message' => $apiError], 401);
            }
            return back()->with('error', $apiError)->withInput(['email' => $data['email']]);
        }

        
        $userData = $response->json();
        
        $user = User::firstOrCreate(
            ['email' => $userData['email']],
            [
                'name' => $userData['name'] ?? $userData['email'],
                'password' => bcrypt('dummy'),
            ]
        );

        Auth::login($user);
        $request->session()->regenerate();
        session([
            'api_user' => $userData,
            'api_token' => $userData['token'] ?? null,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'WELCOME!',
                'redirect' => route('dashboard')
            ]);
        }
        return redirect()->intended('dashboard');
    }
    public function register(Request $request)
    {
        $response = Http::withoutVerifying()->post(env('API_TURISMO_URL') . '/vw_user', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 1
        ]);
        if ($response->successful()) {
            return redirect()->intended('dashboard')->with('success', 'WELCOME!');
        } else {
            return back();
        }
    }
}
