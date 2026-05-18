<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class ServiceController extends Controller
{
    public function index(): void { $this->view('services/list', ['services' => mock('services')]); }
}
