<h1 class="mb-6 text-2xl font-semibold">Add Patient</h1>

<form method="POST" action="<?= e(url('/patients')) ?>" class="card max-w-2xl space-y-4 p-6">
    <?= csrf_field() ?>

    <div>
        <label class="label">Full name</label>
        <input class="input" name="name" required>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="label">Email</label>
            <input class="input" type="email" name="email">
        </div>
        <div>
            <label class="label">Phone</label>
            <input class="input" name="phone">
        </div>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="label">Birthdate</label>
            <input class="input" type="date" name="birthdate">
        </div>
        <div>
            <label class="label">Gender</label>
            <select class="input" name="gender">
                <option value="">--</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>
    <div>
        <label class="label">Address</label>
        <textarea class="input" name="address" rows="2"></textarea>
    </div>

    <div class="flex justify-end gap-2">
        <a class="btn-secondary" href="<?= e(url('/patients')) ?>">Cancel</a>
        <button class="btn-primary" type="submit">Save Patient</button>
    </div>
</form>
