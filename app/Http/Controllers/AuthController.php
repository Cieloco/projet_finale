<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() 
    {
        return view("partiels.login");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials) && auth()->user()->email_verified_at !== NULL) {
            $request->session()->regenerate(true);
            $user = auth()->user();
            if($user->role === 'directeur') {
                return redirect()->route('/list_des_taches')->with('success', "Bienvunue M(me) " . $user->name." ".$user->prenom . " Vous avez été connecté.");
            }
            return redirect()->route('tasks.index')->with('success', "Bienvunue M(me) " . $user->name." ".$user->prenom . " Vous avez été connecté.");
        } else {
            return back()->withErrors([
                'email' => 'E-mail ou mot de passe incorrect.'
            ])->withInput();
        }
    }

    public function logout()
    {
        session()->invalidate();
        auth()->logout();
        return redirect()->route('login');
    }
}
