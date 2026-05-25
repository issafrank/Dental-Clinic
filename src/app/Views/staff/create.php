<h1 class="mb-6 text-2xl font-semibold">Add Staff</h1>

<form method="POST" action="<?= e(url('/staff')) ?>" class="card max-w-2xl space-y-4 p-6">
    <?= csrf_field() ?>
    <div><label class="label">Name</label><input class="input" name="name" required></div>
    <div class="grid gap-4 md:grid-cols-2">
        <div><label class="label">Email</label><input type="email" class="input" name="email"></div>
        <div><label class="label">Phone</label><input class="input" name="phone"></div>
    </div>
    <div><label class="label">Position</label><input class="input" name="position" placeholder="Receptionist, Hygienist..."></div>
    <div class="flex justify-end gap-2">
        <a class="btn-secondary" href="<?= e(url('/staff')) ?>">Cancel</a>
        <button class="btn-primary" type="submit">Save</button>
    </div>
</form>
