<?php /** @var array $monthly, $services */ ?>
<h1 class="mb-6 text-2xl font-semibold">Reports</h1>

<div class="grid gap-6 lg:grid-cols-2">
    <div class="card p-6">
        <h3 class="mb-4 text-lg font-semibold">Monthly Revenue</h3>
        <table class="min-w-full text-sm">
            <thead class="text-left text-xs uppercase text-slate-500"><tr><th class="py-2">Month</th><th class="py-2 text-right">Total</th></tr></thead>
            <tbody>
                <?php foreach ($monthly as $m): ?>
                    <tr class="border-t border-slate-100">
                        <td class="py-2"><?= e($m['month']) ?></td>
                        <td class="py-2 text-right">₱<?= number_format((float) $m['total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$monthly): ?><tr><td class="py-3 text-slate-500" colspan="2">No data.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card p-6">
        <h3 class="mb-4 text-lg font-semibold">Top Services</h3>
        <table class="min-w-full text-sm">
            <thead class="text-left text-xs uppercase text-slate-500"><tr><th class="py-2">Service</th><th class="py-2 text-right">Count</th></tr></thead>
            <tbody>
                <?php foreach ($services as $s): ?>
                    <tr class="border-t border-slate-100">
                        <td class="py-2"><?= e($s['name']) ?></td>
                        <td class="py-2 text-right"><?= e($s['count']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$services): ?><tr><td class="py-3 text-slate-500" colspan="2">No data.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
