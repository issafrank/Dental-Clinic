<?php /** @var array $patient, $chart */ ?>
<h1 class="mb-2 text-2xl font-semibold">Dental Chart</h1>
<p class="mb-6 text-sm text-slate-500">Patient: <span class="font-medium text-slate-800"><?= e($patient['name'] ?? '') ?></span></p>

<?php $byTooth = []; foreach ($chart as $c) { $byTooth[$c['tooth_number']] = $c; } ?>

<div class="card p-6">
    <h3 class="mb-4 text-lg font-semibold">Adult Dentition (FDI Numbering)</h3>

    <div class="grid grid-cols-8 gap-2 sm:grid-cols-16">
        <?php
        $upper = array_merge(range(18, 11), range(21, 28));
        $lower = array_merge(range(48, 41), range(31, 38));
        foreach ([$upper, $lower] as $row):
        ?>
            <?php foreach ($row as $tooth):
                $cond = $byTooth[$tooth]['condition'] ?? null;
                $color = match ($cond) {
                    'caries'    => 'bg-red-100 text-red-700 ring-red-300',
                    'filled'    => 'bg-blue-100 text-blue-700 ring-blue-300',
                    'missing'   => 'bg-slate-200 text-slate-500 ring-slate-300 line-through',
                    'crown'     => 'bg-amber-100 text-amber-700 ring-amber-300',
                    'extracted' => 'bg-rose-100 text-rose-700 ring-rose-300',
                    default     => 'bg-white text-slate-700 ring-slate-200',
                };
            ?>
                <button type="button"
                        class="aspect-square rounded-md ring-1 text-sm font-medium <?= $color ?>"
                        title="<?= e($cond ?? 'healthy') ?>">
                    <?= e($tooth) ?>
                </button>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>

<form method="POST" action="<?= e(url('/patients/' . $patient['id'] . '/dental-chart')) ?>" class="card mt-6 max-w-2xl space-y-4 p-6">
    <?= csrf_field() ?>
    <h3 class="text-lg font-semibold">Update Tooth</h3>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="label">Tooth Number</label>
            <input class="input" name="tooth_number" required>
        </div>
        <div>
            <label class="label">Condition</label>
            <select class="input" name="condition" required>
                <?php foreach (['healthy', 'caries', 'filled', 'crown', 'missing', 'extracted'] as $c): ?>
                    <option value="<?= $c ?>"><?= ucfirst($c) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div>
        <label class="label">Notes</label>
        <textarea class="input" name="notes" rows="2"></textarea>
    </div>
    <div class="flex justify-end">
        <button class="btn-primary" type="submit">Save</button>
    </div>
</form>
