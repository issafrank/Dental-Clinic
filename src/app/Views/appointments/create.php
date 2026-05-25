<?php /** @var array $patients, $dentists, $services */ ?>
<h1 class="mb-6 text-2xl font-semibold">New Appointment</h1>

<form method="POST" action="<?= e(url('/appointments')) ?>" class="card max-w-2xl space-y-4 p-6">
    <?= csrf_field() ?>

    <div>
        <label class="label">Patient</label>
        <select name="patient_id" class="input" required>
            <option value="">Select patient</option>
            <?php foreach ($patients as $p): ?>
                <option value="<?= e($p['id']) ?>"><?= e($p['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="label">Dentist</label>
        <select name="dentist_id" class="input" required>
            <option value="">Select dentist</option>
            <?php foreach ($dentists as $d): ?>
                <option value="<?= e($d['id']) ?>"><?= e($d['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="label">Service</label>
        <select name="service_id" class="input">
            <option value="">--</option>
            <?php foreach ($services as $s): ?>
                <option value="<?= e($s['id']) ?>"><?= e($s['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="label">Schedule</label>
        <input type="datetime-local" name="scheduled_at" class="input" required>
    </div>
    <div>
        <label class="label">Notes</label>
        <textarea name="notes" class="input" rows="3"></textarea>
    </div>

    <div class="flex justify-end gap-2">
        <a class="btn-secondary" href="<?= e(url('/appointments')) ?>">Cancel</a>
        <button class="btn-primary" type="submit">Save</button>
    </div>
</form>
