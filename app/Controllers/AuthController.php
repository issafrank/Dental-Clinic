<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller
{
    public function showLogin(): void    { $this->view('auth/login',    [], 'auth'); }
    public function showRegister(): void { $this->view('auth/register', [], 'auth'); }
    public function logout(): void       { $this->redirect('/dashboard'); }
}
