<?php /** @var array $patients */ ?>
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Patients</h1>
    <a class="btn-primary" href="<?= e(url('/patients/create')) ?>">+ Add Patient</a>
</div>

<div class="card overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
            <tr>
                <th class="px-4 py-3">Name</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Phone</th>
                <th class="px-4 py-3">Age</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <?php foreach ($patients as $p): ?>
                <tr>
                    <td class="px-4 py-3 font-medium"><?= e($p['name']) ?></td>
                    <td class="px-4 py-3"><?= e($p['email']) ?></td>
                    <td class="px-4 py-3"><?= e($p['phone']) ?></td>
                    <td class="px-4 py-3"><?= e(age_from($p['birthdate'] ?? null)) ?></td>
                    <td class="px-4 py-3 text-right">
                        <a class="text-brand-600 hover:underline" href="<?= e(url('/patients/' . $p['id'])) ?>">View</a>
                        <a class="ml-2 text-slate-600 hover:underline" href="<?= e(url('/patients/' . $p['id'] . '/edit')) ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$patients): ?>
                <tr><td class="px-4 py-6 text-center text-slate-500" colspan="5">No patients yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
