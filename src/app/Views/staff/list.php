<?php /** @var array $staff */ ?>
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Staff</h1>
    <a class="btn-primary" href="<?= e(url('/staff/create')) ?>">+ Add Staff</a>
</div>

<div class="card overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
            <tr><th class="px-4 py-3">Name</th><th class="px-4 py-3">Position</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Phone</th></tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <?php foreach ($staff as $s): ?>
                <tr>
                    <td class="px-4 py-3 font-medium"><?= e($s['name']) ?></td>
                    <td class="px-4 py-3"><?= e($s['position']) ?></td>
                    <td class="px-4 py-3"><?= e($s['email']) ?></td>
                    <td class="px-4 py-3"><?= e($s['phone']) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$staff): ?>
                <tr><td colspan="4" class="px-4 py-6 text-center text-slate-500">No staff yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
