<?php
/**
 * @var array $upcoming
 */

$u = auth() ?? [];
$patientName = $u['name'] ?? 'Patient';

$patientRow = null;
foreach (mock('patients') as $p) {
    if (($p['name'] ?? '') === $patientName) {
        $patientRow = $p;
        break;
    }
}

$appointments = array_values(array_filter($upcoming, function ($a) use ($patientName) {
    return ($a['patient_name'] ?? '') === $patientName;
}));
$nextAppt = $appointments[0] ?? ($upcoming[0] ?? null);

$treatments = mock('treatments');
if ($patientRow) {
    $pid = $patientRow['id'] ?? null;
    if ($pid !== null) {
        $treatments = array_values(array_filter($treatments, function ($t) use ($pid) {
            return ($t['patient_id'] ?? null) == $pid;
        }));
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Patient Dashboard</h1>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Welcome back, <?= e($patientName) ?>.</p>
</div>

<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Next Appointment</p>
        <?php if ($nextAppt): ?>
            <?php $ts = strtotime($nextAppt['scheduled_at'] ?? ''); ?>
            <p class="mt-2 text-lg font-semibold text-slate-900 dark:text-white"><?= e(date('M d, h:i A', $ts)) ?></p>
            <p class="text-xs text-slate-500 dark:text-slate-400"><?= e($nextAppt['service_name'] ?? 'Consultation') ?></p>
        <?php else: ?>
            <p class="mt-2 text-sm text-slate-500">No upcoming appointments.</p>
        <?php endif; ?>
    </div>
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">My Appointments</p>
        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?= e((string) count($appointments)) ?></p>
        <a class="mt-3 inline-flex text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400"
           href="<?= e(url('/appointments')) ?>">View schedule &rarr;</a>
    </div>
    <div class="card p-5">
        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Quick Actions</p>
        <div class="mt-3 flex flex-wrap gap-2">
            <a class="btn-primary" href="<?= e(url('/appointments/create')) ?>">Book appointment</a>
            <a class="btn-secondary" href="<?= e(url('/profile')) ?>">Update profile</a>
        </div>
    </div>
</div>

<div class="mt-6 grid gap-6 lg:grid-cols-2">
    <div class="card">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4 dark:border-slate-700">
            <h3 class="text-base font-semibold text-slate-900 dark:text-white">My Treatments</h3>
            <a class="text-sm font-medium text-slate-600 hover:text-slate-900 dark:text-slate-300 dark:hover:text-white"
               href="<?= e(url('/treatments')) ?>">View all &rarr;</a>
        </div>
        <?php if (!$treatments): ?>
            <div class="px-6 py-10 text-center text-sm text-slate-500">No treatment records yet.</div>
        <?php else: ?>
            <ul class="divide-y divide-slate-100 dark:divide-slate-700">
                <?php foreach (array_slice($treatments, 0, 6) as $t): ?>
                    <li class="flex items-center justify-between gap-3 px-6 py-4">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-slate-900 dark:text-slate-100"><?= e($t['procedure'] ?? 'Procedure') ?></p>
                            <p class="text-xs text-slate-500 dark:text-slate-400"><?= e($t['diagnosis'] ?? 'Diagnosis') ?></p>
                        </div>
                        <div class="text-xs text-slate-500 dark:text-slate-400">
                            <?= e(format_date($t['performed_at'] ?? '')) ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="card p-6">
        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Profile</h3>
        <div class="mt-4 space-y-2 text-sm">
            <div class="flex items-center justify-between">
                <span class="text-slate-500 dark:text-slate-400">Email</span>
                <span class="font-medium text-slate-900 dark:text-slate-100"><?= e($patientRow['email'] ?? ($u['email'] ?? '—')) ?></span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-slate-500 dark:text-slate-400">Phone</span>
                <span class="font-medium text-slate-900 dark:text-slate-100"><?= e($patientRow['phone'] ?? ($u['phone'] ?? '—')) ?></span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-slate-500 dark:text-slate-400">Member Since</span>
                <span class="font-medium text-slate-900 dark:text-slate-100"><?= e(format_date($patientRow['created_at'] ?? '')) ?></span>
            </div>
        </div>
    </div>
</div>
