<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class PatientController extends Controller
{
    public function index(): void  { $this->view('patients/list',  ['patients' => mock('patients')]); }
    public function create(): void { $this->view('patients/create'); }
    public function show(string $id): void  { $this->view('patients/show', ['patient' => mock_find('patients', $id) ?? mock('patients')[0]]); }
    public function edit(string $id): void  { $this->view('patients/edit', ['patient' => mock_find('patients', $id) ?? mock('patients')[0]]); }
}
