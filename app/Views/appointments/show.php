<?php /** @var array $appointment */ ?>
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Appointment #<?= e($appointment['id']) ?></h1>
    <a class="btn-secondary" href="<?= e(url('/appointments/' . $appointment['id'] . '/edit')) ?>">Edit</a>
</div>

<div class="card grid gap-4 p-6 md:grid-cols-2">
    <div><div class="text-xs uppercase text-slate-500">Scheduled</div><div><?= e(format_datetime($appointment['scheduled_at'])) ?></div></div>
    <div><div class="text-xs uppercase text-slate-500">Status</div><div><?= e($appointment['status']) ?></div></div>
    <div><div class="text-xs uppercase text-slate-500">Patient</div><div>#<?= e($appointment['patient_id']) ?></div></div>
    <div><div class="text-xs uppercase text-slate-500">Dentist</div><div>#<?= e($appointment['dentist_id']) ?></div></div>
    <div class="md:col-span-2"><div class="text-xs uppercase text-slate-500">Notes</div><div><?= nl2br(e($appointment['notes'])) ?></div></div>
</div>
