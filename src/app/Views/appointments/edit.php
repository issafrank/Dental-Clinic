<?php /** @var array $appointment, $patients, $dentists, $services */ ?>
<h1 class="mb-6 text-2xl font-semibold">Edit Appointment</h1>

<form method="POST" action="<?= e(url('/appointments/' . $appointment['id'])) ?>" class="card max-w-2xl space-y-4 p-6">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div>
        <label class="label">Patient</label>
        <select name="patient_id" class="input" required>
            <?php foreach ($patients as $p): ?>
                <option value="<?= e($p['id']) ?>" <?= $p['id'] == $appointment['patient_id'] ? 'selected' : '' ?>><?= e($p['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="label">Dentist</label>
        <select name="dentist_id" class="input" required>
            <?php foreach ($dentists as $d): ?>
                <option value="<?= e($d['id']) ?>" <?= $d['id'] == $appointment['dentist_id'] ? 'selected' : '' ?>><?= e($d['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="label">Service</label>
        <select name="service_id" class="input">
            <option value="">--</option>
            <?php foreach ($services as $s): ?>
                <option value="<?= e($s['id']) ?>" <?= $s['id'] == $appointment['service_id'] ? 'selected' : '' ?>><?= e($s['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="label">Schedule</label>
        <input type="datetime-local" name="scheduled_at" class="input" value="<?= e(str_replace(' ', 'T', substr($appointment['scheduled_at'] ?? '', 0, 16))) ?>" required>
    </div>
    <div>
        <label class="label">Status</label>
        <select name="status" class="input">
            <?php foreach (['pending', 'confirmed', 'completed', 'cancelled', 'no_show'] as $s): ?>
                <option value="<?= $s ?>" <?= $appointment['status'] === $s ? 'selected' : '' ?>><?= ucfirst(str_replace('_', ' ', $s)) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="label">Notes</label>
        <textarea name="notes" class="input" rows="3"><?= e($appointment['notes']) ?></textarea>
    </div>

    <div class="flex justify-end gap-2">
        <a class="btn-secondary" href="<?= e(url('/appointments')) ?>">Cancel</a>
        <button class="btn-primary" type="submit">Update</button>
    </div>
</form>
