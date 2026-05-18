<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;

class ProfileController extends Controller
{
    public function edit(): void { $this->view('profile/edit', ['user' => Auth::user()]); }
}
