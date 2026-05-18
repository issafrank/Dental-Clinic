<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class TreatmentController extends Controller
{
    public function index(): void { $this->view('treatments/list', ['treatments' => mock('treatments')]); }
}
