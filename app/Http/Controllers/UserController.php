<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // Regras de Negócio
        // Variaveis e conteúdos -> view
        return view('users.index', [
            'greting' => 'Hello World!',
            'users' => $users
        ]);
    }

    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }
}
