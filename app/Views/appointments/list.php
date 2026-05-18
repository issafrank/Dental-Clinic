<?php /** @var array $appointments */ ?>
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Appointments</h1>
    <a class="btn-primary" href="<?= e(url('/appointments/create')) ?>">+ New Appointment</a>
</div>

<div class="card overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
            <tr>
                <th class="px-4 py-3">Scheduled</th>
                <th class="px-4 py-3">Patient</th>
                <th class="px-4 py-3">Dentist</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <?php foreach ($appointments as $a): ?>
                <tr>
                    <td class="px-4 py-3"><?= e(format_datetime($a['scheduled_at'])) ?></td>
                    <td class="px-4 py-3">#<?= e($a['patient_id']) ?></td>
                    <td class="px-4 py-3">#<?= e($a['dentist_id']) ?></td>
                    <td class="px-4 py-3">
                        <span class="badge bg-slate-100 text-slate-700"><?= e($a['status']) ?></span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a class="text-brand-600 hover:underline" href="<?= e(url('/appointments/' . $a['id'])) ?>">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$appointments): ?>
                <tr><td colspan="5" class="px-4 py-6 text-center text-slate-500">No appointments yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
