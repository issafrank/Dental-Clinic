<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class BillingController extends Controller
{
    public function index(): void { $this->view('billing/list', ['invoices' => mock('invoices')]); }
    public function show(string $id): void
    {
        $this->view('billing/show', [
            'invoice' => mock_find('invoices', $id) ?? mock('invoices')[0],
        ]);
    }
}
