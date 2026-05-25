<?php /** @var array $treatments */ ?>
<h1 class="mb-6 text-2xl font-semibold">Treatments</h1>

<div class="card overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
            <tr>
                <th class="px-4 py-3">Date</th>
                <th class="px-4 py-3">Patient</th>
                <th class="px-4 py-3">Tooth</th>
                <th class="px-4 py-3">Procedure</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <?php foreach ($treatments as $t): ?>
                <tr>
                    <td class="px-4 py-3"><?= e(format_date($t['performed_at'])) ?></td>
                    <td class="px-4 py-3">#<?= e($t['patient_id']) ?></td>
                    <td class="px-4 py-3"><?= e($t['tooth_number']) ?></td>
                    <td class="px-4 py-3"><?= e($t['procedure']) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$treatments): ?>
                <tr><td colspan="4" class="px-4 py-6 text-center text-slate-500">No treatments yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
