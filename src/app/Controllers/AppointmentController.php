<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class AppointmentController extends Controller
{
    public function index(): void
    {
        $this->view('appointments/list', ['appointments' => mock('appointments')]);
    }

    public function create(): void
    {
        $this->view('appointments/create', [
            'patients' => mock('patients'),
            'dentists' => mock('dentists'),
            'services' => mock('services'),
        ]);
    }

    public function show(string $id): void
    {
        $this->view('appointments/show', [
            'appointment' => mock_find('appointments', $id) ?? mock('appointments')[0],
        ]);
    }

    public function edit(string $id): void
    {
        $this->view('appointments/edit', [
            'appointment' => mock_find('appointments', $id) ?? mock('appointments')[0],
            'patients'    => mock('patients'),
            'dentists'    => mock('dentists'),
            'services'    => mock('services'),
        ]);
    }
}
