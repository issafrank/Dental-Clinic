<h1 class="mb-6 text-2xl font-semibold">Add Dentist</h1>

<form method="POST" action="<?= e(url('/dentists')) ?>" class="card max-w-2xl space-y-4 p-6">
    <?= csrf_field() ?>
    <div><label class="label">Name</label><input class="input" name="name" required></div>
    <div class="grid gap-4 md:grid-cols-2">
        <div><label class="label">Email</label><input type="email" class="input" name="email"></div>
        <div><label class="label">Phone</label><input class="input" name="phone"></div>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
        <div><label class="label">Specialty</label><input class="input" name="specialty"></div>
        <div><label class="label">License No.</label><input class="input" name="license_no"></div>
    </div>
    <div class="flex justify-end gap-2">
        <a class="btn-secondary" href="<?= e(url('/dentists')) ?>">Cancel</a>
        <button class="btn-primary" type="submit">Save</button>
    </div>
</form>
