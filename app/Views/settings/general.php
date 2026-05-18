<?php /** @var array $settings */ ?>
<h1 class="mb-6 text-2xl font-semibold">Settings</h1>

<form method="POST" action="<?= e(url('/settings')) ?>" class="card max-w-2xl space-y-4 p-6">
    <?= csrf_field() ?>
    <div>
        <label class="label">Clinic Name</label>
        <input class="input" name="clinic_name" value="<?= e($settings['clinic_name'] ?? '') ?>">
    </div>
    <div>
        <label class="label">Address</label>
        <textarea class="input" name="clinic_address" rows="2"><?= e($settings['clinic_address'] ?? '') ?></textarea>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div><label class="label">Phone</label><input class="input" name="clinic_phone" value="<?= e($settings['clinic_phone'] ?? '') ?>"></div>
        <div><label class="label">Email</label><input class="input" type="email" name="clinic_email" value="<?= e($settings['clinic_email'] ?? '') ?>"></div>
    </div>
    <div>
        <label class="label">Currency</label>
        <input class="input" name="currency" value="<?= e($settings['currency'] ?? 'PHP') ?>">
    </div>
    <div class="flex justify-end">
        <button class="btn-primary" type="submit">Save Settings</button>
    </div>
</form>
