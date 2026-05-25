<?php
/**
 * @var array $stats
 * @var array $upcoming
 * @var array $recentPatients
 * @var array $monthly
 */

$statusTints = [
    'pending'   => 'bg-amber-50 text-amber-700 ring-amber-200 dark:bg-amber-500/10 dark:text-amber-300 dark:ring-amber-500/30',
    'confirmed' => 'bg-emerald-50 text-emerald-700 ring-emerald-200 dark:bg-emerald-500/10 dark:text-emerald-300 dark:ring-emerald-500/30',
    'completed' => 'bg-blue-50 text-blue-700 ring-blue-200 dark:bg-blue-500/10 dark:text-blue-300 dark:ring-blue-500/30',
    'cancelled' => 'bg-red-50 text-red-700 ring-red-200 dark:bg-red-500/10 dark:text-red-300 dark:ring-red-500/30',
    'no_show'   => 'bg-slate-100 text-slate-600 ring-slate-200 dark:bg-slate-700 dark:text-slate-300 dark:ring-slate-600',
];

$maxRevenue = !empty($monthly) ? max(array_column($monthly, 'total')) : 0;
$maxRevenue = $maxRevenue > 0 ? (float) $maxRevenue : 1.0;
?>

<!-- Page header -->
<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Dashboard</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            <?= e(date('l, F j, Y')) ?> &middot; Overview of clinic activity.
        </p>
    </div>
    <div class="flex gap-2">
        <a class="btn-secondary" href="<?= e(url('/patients/create')) ?>">
            <?php icon('plus', 'h-4 w-4'); ?> New Patient
        </a>
        <a class="btn-primary" href="<?= e(url('/appointments/create')) ?>">
            <?php icon('calendar', 'h-4 w-4'); ?> New Appointment
        </a>
    </div>
</div>

<!-- Stat cards -->
<?php
$cards = [
    ['label' => 'Total Patients',       'value' => number_format($stats['patients']),           'icon' => 'users',         'tint' => 'bg-blue-50 text-blue-600 ring-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:ring-blue-500/20',              'href' => '/patients'],
    ['label' => "Today's Appointments", 'value' => number_format($stats['appointments']),       'icon' => 'calendar',      'tint' => 'bg-emerald-50 text-emerald-600 ring-emerald-100 dark:bg-emerald-500/10 dark:text-emerald-400 dark:ring-emerald-500/20', 'href' => '/appointments'],
    ['label' => 'Pending Approvals',    'value' => number_format($stats['pending']),            'icon' => 'clock',         'tint' => 'bg-amber-50 text-amber-600 ring-amber-100 dark:bg-amber-500/10 dark:text-amber-400 dark:ring-amber-500/20',          'href' => '/appointments'],
    ['label' => 'Revenue (This Month)', 'value' => '₱' . number_format($stats['revenue'], 2),   'icon' => 'currency-peso', 'tint' => 'bg-fuchsia-50 text-fuchsia-600 ring-fuchsia-100 dark:bg-fuchsia-500/10 dark:text-fuchsia-400 dark:ring-fuchsia-500/20', 'href' => '/reports'],
];
?>
<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <?php foreach ($cards as $c): ?>
        <a href="<?= e(url($c['href'])) ?>"
           class="card group p-5 transition hover:shadow-md hover:ring-slate-300 dark:hover:ring-slate-600">
            <div class="flex items-start justify-between">
                <div class="min-w-0">
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400"><?= e($c['label']) ?></p>
                    <p class="mt-2 truncate text-2xl font-bold tracking-tight text-slate-900 dark:text-white"><?= $c['value'] ?></p>
                </div>
                <span class="inline-flex h-10 w-10 flex-none items-center justify-center rounded-lg ring-1 ring-inset <?= $c['tint'] ?>">
                    <?php icon($c['icon'], 'h-5 w-5'); ?>
                </span>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<!-- Main grid -->
<div class="mt-6 grid gap-6 lg:grid-cols-3">

    <!-- Upcoming appointments (spans 2 cols) -->
    <div class="card lg:col-span-2">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4 dark:border-slate-700">
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Upcoming Appointments</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Next 5 scheduled visits</p>
            </div>
            <a class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white" href="<?= e(url('/appointments')) ?>">View all &rarr;</a>
        </div>

        <?php if (!$upcoming): ?>
            <div class="px-6 py-10 text-center">
                <span class="mx-auto mb-3 inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-400 dark:bg-slate-700 dark:text-slate-500">
                    <?php icon('calendar', 'h-5 w-5'); ?>
                </span>
                <p class="text-sm text-slate-500">No upcoming appointments.</p>
                <a class="btn-primary mt-4 inline-flex" href="<?= e(url('/appointments/create')) ?>">
                    <?php icon('plus', 'h-4 w-4'); ?> Schedule one
                </a>
            </div>
        <?php else: ?>
            <ul class="divide-y divide-slate-100 dark:divide-slate-700">
                <?php foreach ($upcoming as $a): ?>
                    <?php
                    $ts = strtotime($a['scheduled_at']);
                    $tint = $statusTints[$a['status']] ?? 'bg-slate-100 text-slate-600 ring-slate-200';
                    ?>
                    <li class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50/60 dark:hover:bg-slate-700/40">
                        <div class="flex h-12 w-12 flex-none flex-col items-center justify-center rounded-lg bg-slate-900 text-white dark:bg-blue-600">
                            <span class="text-[10px] font-medium uppercase opacity-80"><?= e(date('M', $ts)) ?></span>
                            <span class="text-base font-bold leading-none"><?= e(date('d', $ts)) ?></span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <p class="truncate text-sm font-medium text-slate-900 dark:text-slate-100"><?= e($a['patient_name'] ?? 'Patient') ?></p>
                                <span class="badge <?= $tint ?>"><?= e(ucfirst($a['status'])) ?></span>
                            </div>
                            <p class="mt-0.5 truncate text-xs text-slate-500 dark:text-slate-400">
                                <?= e($a['service_name'] ?? 'Consultation') ?>
                                <?php if (!empty($a['dentist_name'])): ?>
                                    &middot; Dr. <?= e($a['dentist_name']) ?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="hidden flex-none text-right sm:block">
                            <p class="text-sm font-medium text-slate-900 dark:text-slate-100"><?= e(date('h:i A', $ts)) ?></p>
                            <p class="text-xs text-slate-500 dark:text-slate-400"><?= e(date('D', $ts)) ?></p>
                        </div>
                        <a class="btn-ghost flex-none" href="<?= e(url('/appointments/' . $a['id'])) ?>" title="View">
                            <?php icon('eye', 'h-4 w-4'); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <!-- Quick Actions + Reminders (stacked, 1 col) -->
    <div class="space-y-6">
        <div class="card p-6">
            <h3 class="mb-4 text-base font-semibold text-slate-900 dark:text-white">Quick Actions</h3>
            <div class="grid gap-2">
                <a class="flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2.5 text-sm transition hover:border-slate-900 dark:border-slate-700 dark:text-slate-200 dark:hover:border-slate-400"
                   href="<?= e(url('/billing')) ?>">
                    <span class="flex items-center gap-2.5">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-emerald-100 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-400">
                            <?php icon('banknotes', 'h-4 w-4'); ?>
                        </span>
                        <span class="font-medium">View Billing</span>
                    </span>
                    <span class="text-slate-400">&rarr;</span>
                </a>
                <a class="flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2.5 text-sm transition hover:border-slate-900 dark:border-slate-700 dark:text-slate-200 dark:hover:border-slate-400"
                   href="<?= e(url('/inventory')) ?>">
                    <span class="flex items-center gap-2.5">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400">
                            <?php icon('archive', 'h-4 w-4'); ?>
                        </span>
                        <span class="font-medium">Inventory</span>
                    </span>
                    <span class="text-slate-400">&rarr;</span>
                </a>
                <a class="flex items-center justify-between rounded-lg border border-slate-200 px-3 py-2.5 text-sm transition hover:border-slate-900 dark:border-slate-700 dark:text-slate-200 dark:hover:border-slate-400"
                   href="<?= e(url('/reports')) ?>">
                    <span class="flex items-center gap-2.5">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-md bg-fuchsia-100 text-fuchsia-700 dark:bg-fuchsia-500/15 dark:text-fuchsia-400">
                            <?php icon('chart-bar', 'h-4 w-4'); ?>
                        </span>
                        <span class="font-medium">Reports</span>
                    </span>
                    <span class="text-slate-400">&rarr;</span>
                </a>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="mb-4 text-base font-semibold text-slate-900 dark:text-white">Reminders</h3>
            <ul class="space-y-3 text-sm">
                <li class="flex items-start gap-2.5">
                    <span class="mt-0.5 inline-flex h-5 w-5 flex-none items-center justify-center rounded-full bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400">
                        <?php icon('bell', 'h-3 w-3'); ?>
                    </span>
                    <span class="text-slate-700 dark:text-slate-300">Confirm tomorrow's appointments.</span>
                </li>
                <li class="flex items-start gap-2.5">
                    <span class="mt-0.5 inline-flex h-5 w-5 flex-none items-center justify-center rounded-full bg-red-100 text-red-700 dark:bg-red-500/15 dark:text-red-400">
                        <?php icon('archive', 'h-3 w-3'); ?>
                    </span>
                    <span class="text-slate-700 dark:text-slate-300">Check low-stock inventory items.</span>
                </li>
                <li class="flex items-start gap-2.5">
                    <span class="mt-0.5 inline-flex h-5 w-5 flex-none items-center justify-center rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-400">
                        <?php icon('banknotes', 'h-3 w-3'); ?>
                    </span>
                    <span class="text-slate-700 dark:text-slate-300">Send overdue invoice reminders.</span>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Bottom row: Revenue trend + Recent patients -->
<div class="mt-6 grid gap-6 lg:grid-cols-3">

    <!-- Revenue trend (bar chart, pure CSS) -->
    <div class="card p-6 lg:col-span-2">
        <div class="mb-5 flex items-center justify-between">
            <div>
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Revenue (Last 6 Months)</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Payments collected per month</p>
            </div>
            <a class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white" href="<?= e(url('/reports')) ?>">Full report &rarr;</a>
        </div>

        <?php if (!$monthly): ?>
            <div class="py-10 text-center text-sm text-slate-500">No revenue data yet.</div>
        <?php else: ?>
            <div class="flex h-48 items-stretch gap-3">
                <?php foreach ($monthly as $m):
                    $pct = max(4, (int) round(((float) $m['total'] / $maxRevenue) * 100));
                ?>
                    <div class="flex flex-1 flex-col items-center gap-2">
                        <div class="relative w-full flex-1">
                            <div class="absolute inset-x-0 bottom-0 rounded-t-md bg-slate-900 transition-all hover:bg-slate-700 dark:bg-blue-500 dark:hover:bg-blue-400"
                                 style="height: <?= $pct ?>%"
                                 title="₱<?= number_format((float) $m['total'], 2) ?>"></div>
                        </div>
                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400"><?= e($m['label']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Recent patients -->
    <div class="card">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4 dark:border-slate-700">
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Recent Patients</h3>
            <a class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white" href="<?= e(url('/patients')) ?>">All &rarr;</a>
        </div>

        <?php if (!$recentPatients): ?>
            <div class="px-6 py-10 text-center text-sm text-slate-500">No patients yet.</div>
        <?php else: ?>
            <ul class="divide-y divide-slate-100 dark:divide-slate-700">
                <?php foreach ($recentPatients as $p): ?>
                    <li>
                        <a href="<?= e(url('/patients/' . $p['id'])) ?>"
                           class="flex items-center gap-3 px-6 py-3 hover:bg-slate-50 dark:hover:bg-slate-700/40">
                            <span class="inline-flex h-9 w-9 flex-none items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-700 dark:bg-slate-700 dark:text-slate-200">
                                <?= e(strtoupper(substr($p['name'], 0, 1))) ?>
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-slate-900 dark:text-slate-100"><?= e($p['name']) ?></p>
                                <p class="truncate text-xs text-slate-500 dark:text-slate-400"><?= e($p['email'] ?: $p['phone'] ?: '—') ?></p>
                            </div>
                            <span class="hidden flex-none text-xs text-slate-400 sm:inline dark:text-slate-500"><?= e(format_date($p['created_at'])) ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
