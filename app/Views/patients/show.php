<?php /** @var array $patient */ ?>
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-semibold"><?= e($patient['name']) ?></h1>
    <div class="flex gap-2">
        <a class="btn-secondary" href="<?= e(url('/patients/' . $patient['id'] . '/edit')) ?>">Edit</a>
        <a class="btn-primary" href="<?= e(url('/patients/' . $patient['id'] . '/dental-chart')) ?>">Dental Chart</a>
    </div>
</div>

<div class="card grid gap-4 p-6 md:grid-cols-2">
    <div><div class="text-xs uppercase text-slate-500">Email</div><div><?= e($patient['email']) ?></div></div>
    <div><div class="text-xs uppercase text-slate-500">Phone</div><div><?= e($patient['phone']) ?></div></div>
    <div><div class="text-xs uppercase text-slate-500">Birthdate</div><div><?= e(format_date($patient['birthdate'])) ?> (<?= e(age_from($patient['birthdate'])) ?> yrs)</div></div>
    <div><div class="text-xs uppercase text-slate-500">Gender</div><div><?= e(ucfirst($patient['gender'] ?? '')) ?></div></div>
    <div class="md:col-span-2"><div class="text-xs uppercase text-slate-500">Address</div><div><?= e($patient['address']) ?></div></div>
</div>
