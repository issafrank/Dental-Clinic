<?php /** @var array $invoices */ ?>
<h1 class="mb-6 text-2xl font-semibold">Billing</h1>

<div class="card overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
            <tr>
                <th class="px-4 py-3">Invoice #</th>
                <th class="px-4 py-3">Patient</th>
                <th class="px-4 py-3">Issued</th>
                <th class="px-4 py-3">Total</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <?php foreach ($invoices as $i): ?>
                <tr>
                    <td class="px-4 py-3 font-medium">#<?= e($i['id']) ?></td>
                    <td class="px-4 py-3">#<?= e($i['patient_id']) ?></td>
                    <td class="px-4 py-3"><?= e(format_date($i['issued_at'])) ?></td>
                    <td class="px-4 py-3">₱<?= number_format((float) $i['total'], 2) ?></td>
                    <td class="px-4 py-3"><span class="badge bg-slate-100 text-slate-700"><?= e($i['status']) ?></span></td>
                    <td class="px-4 py-3 text-right">
                        <a class="text-brand-600 hover:underline" href="<?= e(url('/billing/' . $i['id'])) ?>">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$invoices): ?>
                <tr><td colspan="6" class="px-4 py-6 text-center text-slate-500">No invoices yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
