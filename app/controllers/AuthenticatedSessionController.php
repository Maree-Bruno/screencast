<?php

namespace Animal\Controllers;

use Animal\Models\User;
use Illuminate\Support\Facades\Redirect;
use Tecgdcs\Response;
use Tecgdcs\Validator;
use Tecgdcs\View;

class AuthenticatedSessionController
{
    public function create()
    {
        View::make('auth.login');
    }

    public function store()
    {
        Validator::check([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $_REQUEST['email'])->first();
        if (!$user) {
            $_SESSION['errors']['email'] = 'cet email n’existe pas';
            $_SESSION['old']['email'] = $_REQUEST['email'];
            Redirect::back();
        }
        if (password_verify($_REQUEST['password'], $user->password)) {
            $_SESSION = [];
            $_SESSION['user'] = $user;
            Response::redirect('/dashboard');
        }
        $_SESSION['old']['email'] = $_REQUEST['email'];
        $_SESSION['errors']['password'] = 'Ce mot de passe est incorrecte';
        Response::back();
    }
}