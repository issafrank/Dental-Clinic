<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    public function index(): void
    {
        $role = auth()['role'] ?? 'admin';

        // Map each role to its own dashboard view. Admin retains the rich
        // overview; doctor/staff/patient see focused, role-scoped variants.
        $views = [
            'admin'   => 'dashboard/admin',
            'doctor'  => 'dashboard/doctor',
            'staff'   => 'dashboard/staff',
            'patient' => 'dashboard/patient',
        ];
        $view = $views[$role] ?? 'dashboard/admin';

        $this->view($view, [
            'stats'          => mock('stats'),
            'upcoming'       => mock('upcoming'),
            'recentPatients' => array_slice(mock('patients'), 0, 5),
            'monthly'        => mock('monthly'),
        ]);
    }
}
