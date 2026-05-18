<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class DentistController extends Controller
{
    public function index(): void  { $this->view('dentists/list', ['dentists' => mock('dentists')]); }
    public function create(): void { $this->view('dentists/create'); }
}
