<?php /** @var array $patient */ ?>
<h1 class="mb-6 text-2xl font-semibold">Edit Patient</h1>

<form method="POST" action="<?= e(url('/patients/' . $patient['id'])) ?>" class="card max-w-2xl space-y-4 p-6">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <div>
        <label class="label">Full name</label>
        <input class="input" name="name" value="<?= e($patient['name']) ?>" required>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="label">Email</label>
            <input class="input" type="email" name="email" value="<?= e($patient['email']) ?>">
        </div>
        <div>
            <label class="label">Phone</label>
            <input class="input" name="phone" value="<?= e($patient['phone']) ?>">
        </div>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="label">Birthdate</label>
            <input class="input" type="date" name="birthdate" value="<?= e($patient['birthdate']) ?>">
        </div>
        <div>
            <label class="label">Gender</label>
            <select class="input" name="gender">
                <?php foreach (['male', 'female', 'other'] as $g): ?>
                    <option value="<?= $g ?>" <?= $patient['gender'] === $g ? 'selected' : '' ?>><?= ucfirst($g) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div>
        <label class="label">Address</label>
        <textarea class="input" name="address" rows="2"><?= e($patient['address']) ?></textarea>
    </div>

    <div class="flex justify-end gap-2">
        <a class="btn-secondary" href="<?= e(url('/patients/' . $patient['id'])) ?>">Cancel</a>
        <button class="btn-primary" type="submit">Update</button>
    </div>
</form>
