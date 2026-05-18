<?php /** @var array $invoice */ ?>
<h1 class="mb-6 text-2xl font-semibold">Invoice #<?= e($invoice['id']) ?></h1>

<div class="card grid gap-4 p-6 md:grid-cols-2">
    <div><div class="text-xs uppercase text-slate-500">Patient</div><div>#<?= e($invoice['patient_id']) ?></div></div>
    <div><div class="text-xs uppercase text-slate-500">Total</div><div>₱<?= number_format((float) $invoice['total'], 2) ?></div></div>
    <div><div class="text-xs uppercase text-slate-500">Status</div><div><?= e($invoice['status']) ?></div></div>
    <div><div class="text-xs uppercase text-slate-500">Issued</div><div><?= e(format_date($invoice['issued_at'])) ?></div></div>
    <div class="md:col-span-2"><div class="text-xs uppercase text-slate-500">Notes</div><div><?= nl2br(e($invoice['notes'])) ?></div></div>
</div>

<form method="POST" action="<?= e(url('/payments')) ?>" class="card mt-6 max-w-md space-y-4 p-6">
    <?= csrf_field() ?>
    <input type="hidden" name="invoice_id" value="<?= e($invoice['id']) ?>">
    <h3 class="text-lg font-semibold">Record Payment</h3>
    <div><label class="label">Amount</label><input type="number" step="0.01" class="input" name="amount" required></div>
    <div>
        <label class="label">Method</label>
        <select class="input" name="method">
            <?php foreach (['cash', 'card', 'gcash', 'maya', 'bank_transfer'] as $m): ?>
                <option value="<?= $m ?>"><?= strtoupper(str_replace('_', ' ', $m)) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button class="btn-primary w-full" type="submit">Record</button>
</form>
