<?php
/**
 * @var array $upcoming
 */

$inventory = mock('inventory');
$invoices = mock('invoices');

$lowStock = array_filter($inventory, function ($i) {
    $qty = $i['quantity'] ?? 0;
    $reorder = $i['reorder_at'] ?? 0;
    return $qty <= $reorder;
});

$pendingInvoices = array_filter($invoices, function ($inv) {
    return in_array($inv['status'] ?? '', ['unpaid', 'partial'], true);
});

$today = date('Y-m-d');
$todayCount = 0;
foreach ($upcoming as $a) {
    $scheduled = $a['scheduled_at'] ?? '';
    if (is_string($scheduled) && str_starts_with($scheduled, $today)) {
        $todayCount++;
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Staff Dashboard</h1>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"><?= e(date('l, F j, Y')) ?></p>
</div>

<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Today's Appointments</p>
        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?= e((string) $todayCount) ?></p>
    </div>
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Pending Invoices</p>
        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?= e((string) count($pendingInvoices)) ?></p>
    </div>
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Low Stock Items</p>
        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?= e((string) count($lowStock)) ?></p>
    </div>
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Quick Actions</p>
        <div class="mt-3 flex flex-wrap gap-2">
            <a class="btn-secondary" href="<?= e(url('/appointments')) ?>">Manage appointments</a>
            <a class="btn-primary" href="<?= e(url('/billing')) ?>">Billing</a>
        </div>
    </div>
</div>

<div class="mt-6 grid gap-6 lg:grid-cols-2">
    <div class="card">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4 dark:border-slate-700">
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Upcoming Appointments</h3>
            <a class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
               href="<?= e(url('/appointments')) ?>">View all &rarr;</a>
        </div>
        <?php if (!$upcoming): ?>
            <div class="px-6 py-10 text-center text-sm text-slate-500">No upcoming appointments.</div>
        <?php else: ?>
            <ul class="divide-y divide-slate-100 dark:divide-slate-700">
                <?php foreach (array_slice($upcoming, 0, 6) as $a): ?>
                    <?php $ts = strtotime($a['scheduled_at'] ?? ''); ?>
                    <li class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50/60 dark:hover:bg-slate-700/40">
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-medium text-slate-900 dark:text-slate-100"><?= e($a['patient_name'] ?? 'Patient') ?></p>
                            <p class="mt-0.5 truncate text-xs text-slate-500 dark:text-slate-400"><?= e($a['service_name'] ?? 'Consultation') ?></p>
                        </div>
                        <div class="flex-none text-right">
                            <p class="text-sm font-medium text-slate-900 dark:text-slate-100"><?= e(date('h:i A', $ts)) ?></p>
                            <p class="text-xs text-slate-500 dark:text-slate-400"><?= e(date('M d', $ts)) ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4 dark:border-slate-700">
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Pending Invoices</h3>
            <a class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
               href="<?= e(url('/billing')) ?>">Go to billing &rarr;</a>
        </div>
        <?php if (!$pendingInvoices): ?>
            <div class="px-6 py-10 text-center text-sm text-slate-500">No pending invoices.</div>
        <?php else: ?>
            <ul class="divide-y divide-slate-100 dark:divide-slate-700">
                <?php foreach (array_slice($pendingInvoices, 0, 6) as $inv): ?>
                    <li class="flex items-center justify-between gap-3 px-6 py-4">
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-slate-900 dark:text-slate-100">Invoice #<?= e((string) ($inv['id'] ?? '')) ?></p>
                            <p class="text-xs text-slate-500 dark:text-slate-400"><?= e(ucfirst($inv['status'] ?? 'pending')) ?></p>
                        </div>
                        <div class="text-sm font-semibold text-slate-900 dark:text-slate-100">₱<?= e(number_format((float) ($inv['total'] ?? 0), 2)) ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
