<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class DentalChartController extends Controller
{
    public function show(string $patientId): void
    {
        $this->view('dental_chart/show', [
            'patient' => mock_find('patients', $patientId) ?? mock('patients')[0],
            'chart'   => [
                ['tooth_number' => '11', 'condition' => 'filled',  'notes' => 'Composite'],
                ['tooth_number' => '21', 'condition' => 'caries',  'notes' => 'Needs filling'],
                ['tooth_number' => '36', 'condition' => 'missing', 'notes' => ''],
                ['tooth_number' => '46', 'condition' => 'crown',   'notes' => ''],
            ],
        ]);
    }
}
