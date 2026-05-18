<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class StaffController extends Controller
{
    public function index(): void  { $this->view('staff/list',  ['staff' => mock('staff')]); }
    public function create(): void { $this->view('staff/create'); }
}
