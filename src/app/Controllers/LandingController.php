<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class LandingController extends Controller
{
    public function index(): void
    {
        $this->view('landing/welcome', [], 'guest');
    }
}
