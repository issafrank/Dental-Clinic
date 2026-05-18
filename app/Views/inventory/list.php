<?php /** @var array $items */ ?>
<h1 class="mb-6 text-2xl font-semibold">Inventory</h1>

<form method="POST" action="<?= e(url('/inventory')) ?>" class="card mb-6 grid gap-4 p-4 md:grid-cols-6">
    <?= csrf_field() ?>
    <input class="input md:col-span-2" name="name" placeholder="Item name" required>
    <input class="input" name="sku" placeholder="SKU">
    <input class="input" type="number" name="quantity" placeholder="Qty" min="0" required>
    <input class="input" name="unit" placeholder="Unit (pcs/box)">
    <button class="btn-primary" type="submit">+ Add</button>
</form>

<div class="card overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
            <tr><th class="px-4 py-3">Name</th><th class="px-4 py-3">SKU</th><th class="px-4 py-3">Qty</th><th class="px-4 py-3">Unit</th></tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <?php foreach ($items as $i): ?>
                <tr>
                    <td class="px-4 py-3 font-medium"><?= e($i['name']) ?></td>
                    <td class="px-4 py-3"><?= e($i['sku']) ?></td>
                    <td class="px-4 py-3">
                        <span class="<?= ($i['quantity'] <= ($i['reorder_at'] ?? 0)) ? 'text-red-600 font-semibold' : '' ?>">
                            <?= e($i['quantity']) ?>
                        </span>
                    </td>
                    <td class="px-4 py-3"><?= e($i['unit']) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$items): ?>
                <tr><td colspan="4" class="px-4 py-6 text-center text-slate-500">No items yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
