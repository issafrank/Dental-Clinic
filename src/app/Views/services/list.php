<?php /** @var array $services */ ?>
<h1 class="mb-6 text-2xl font-semibold">Services</h1>

<form method="POST" action="<?= e(url('/services')) ?>" class="card mb-6 grid gap-4 p-4 md:grid-cols-5">
    <?= csrf_field() ?>
    <input class="input md:col-span-2" name="name" placeholder="Service name" required>
    <input class="input" type="number" step="0.01" name="price" placeholder="Price" required>
    <input class="input" type="number" name="duration_min" placeholder="Duration (min)">
    <button class="btn-primary" type="submit">+ Add</button>
</form>

<div class="card overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase tracking-wide text-slate-500">
            <tr><th class="px-4 py-3">Name</th><th class="px-4 py-3">Price</th><th class="px-4 py-3">Duration</th></tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            <?php foreach ($services as $s): ?>
                <tr>
                    <td class="px-4 py-3 font-medium"><?= e($s['name']) ?></td>
                    <td class="px-4 py-3">₱<?= number_format((float) $s['price'], 2) ?></td>
                    <td class="px-4 py-3"><?= e($s['duration_min']) ?> min</td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$services): ?>
                <tr><td colspan="3" class="px-4 py-6 text-center text-slate-500">No services yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
