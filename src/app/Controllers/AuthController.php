<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Core\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        if (Auth::check()) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/login', [], 'auth');
    }

    public function login(): void
    {
        $email    = trim($this->input('email', ''));
        $password = $this->input('password', '');

        $v = new Validator();
        if (!$v->validate(['email' => $email, 'password' => $password], [
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ])) {
            Session::flash('error', implode(' ', array_merge(...array_values($v->errors()))));
            Session::set('_old', ['email' => $email]);
            $this->redirect('/login');
            return;
        }

        $user = (new User())->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            Session::flash('error', 'Invalid email or password.');
            Session::set('_old', ['email' => $email]);
            $this->redirect('/login');
            return;
        }

        if (!($user['is_active'] ?? 1)) {
            Session::flash('error', 'Your account has been deactivated. Contact the administrator.');
            $this->redirect('/login');
            return;
        }

        Auth::login($user);
        Session::forget('_old');
        $this->redirect('/dashboard');
    }

    public function showRegister(): void { $this->view('auth/register', [], 'auth'); }

    public function logout(): void
    {
        Auth::logout();
        Session::flash('success', 'You have been signed out.');
        $this->redirect('/login');
    }
}
