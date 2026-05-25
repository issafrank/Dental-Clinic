<?php
/**
 * @var array $upcoming
 */

$u = auth() ?? [];
$doctorName = $u['name'] ?? 'Doctor';

$appointments = array_values(array_filter($upcoming, function ($a) use ($doctorName) {
    $dentist = $a['dentist_name'] ?? '';
    return $dentist !== '' && stripos($dentist, $doctorName) !== false;
}));
if (!$appointments) {
    $appointments = $upcoming;
}

$today = date('Y-m-d');
$todayCount = 0;
foreach ($appointments as $a) {
    $scheduled = $a['scheduled_at'] ?? '';
    if (is_string($scheduled) && str_starts_with($scheduled, $today)) {
        $todayCount++;
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Doctor Dashboard</h1>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
        <?= e($doctorName) ?> &middot; <?= e(date('l, F j, Y')) ?>
    </p>
</div>

<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Today's Appointments</p>
        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?= e((string) $todayCount) ?></p>
    </div>
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Upcoming Schedule</p>
        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?= e((string) count($appointments)) ?></p>
    </div>
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Quick Actions</p>
        <div class="mt-3 flex flex-wrap gap-2">
            <a class="btn-secondary" href="<?= e(url('/appointments')) ?>">View schedule</a>
            <a class="btn-primary" href="<?= e(url('/treatments')) ?>">Add treatment</a>
        </div>
    </div>
</div>

<div class="mt-6 card">
    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4 dark:border-slate-700">
        <div>
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">My Upcoming Appointments</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400">Next visits assigned to you</p>
        </div>
        <a class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
           href="<?= e(url('/appointments')) ?>">View all &rarr;</a>
    </div>

    <?php if (!$appointments): ?>
        <div class="px-6 py-10 text-center text-sm text-slate-500">No scheduled appointments.</div>
    <?php else: ?>
        <ul class="divide-y divide-slate-100 dark:divide-slate-700">
            <?php foreach ($appointments as $a): ?>
                <?php $ts = strtotime($a['scheduled_at'] ?? ''); ?>
                <li class="flex items-center gap-4 px-6 py-4 hover:bg-slate-50/60 dark:hover:bg-slate-700/40">
                    <div class="flex h-12 w-12 flex-none flex-col items-center justify-center rounded-lg bg-slate-900 text-white dark:bg-blue-600">
                        <span class="text-[10px] font-medium uppercase opacity-80"><?= e(date('M', $ts)) ?></span>
                        <span class="text-base font-bold leading-none"><?= e(date('d', $ts)) ?></span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-medium text-slate-900 dark:text-slate-100"><?= e($a['patient_name'] ?? 'Patient') ?></p>
                        <p class="mt-0.5 truncate text-xs text-slate-500 dark:text-slate-400">
                            <?= e($a['service_name'] ?? 'Consultation') ?>
                        </p>
                    </div>
                    <div class="hidden flex-none text-right sm:block">
                        <p class="text-sm font-medium text-slate-900 dark:text-slate-100"><?= e(date('h:i A', $ts)) ?></p>
                        <p class="text-xs text-slate-500 dark:text-slate-400"><?= e(date('D', $ts)) ?></p>
                    </div>
                    <a class="btn-ghost flex-none" href="<?= e(url('/appointments/' . ($a['id'] ?? '1'))) ?>" title="View">
                        <?php icon('eye', 'h-4 w-4'); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
