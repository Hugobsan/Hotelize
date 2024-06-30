<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! $token = auth()->attempt($credentials)) {
            //Gerando mensagem de erro com toastr
            toastr()->error('Usuário ou senha inválidos');
            return redirect()->route('login');
        }

        return redirect()->route('hotels.index');   
    }

    public function logout()
    {
        auth()->logout();
        toastr()->success('Logout efetuado com sucesso');
        return redirect()->route('login');
    }

}
