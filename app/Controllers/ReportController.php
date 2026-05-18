<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class ReportController extends Controller
{
    public function index(): void
    {
        $this->view('reports/overview', [
            'monthly'  => mock('monthly'),
            'services' => mock('top_services'),
        ]);
    }
}
