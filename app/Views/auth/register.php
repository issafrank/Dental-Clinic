<h2 class="mb-6 text-xl font-semibold">Create account</h2>

<form method="POST" action="<?= e(url('/register')) ?>" class="space-y-4">
    <?= csrf_field() ?>

    <div>
        <label class="label" for="name">Full name</label>
        <input class="input" type="text" name="name" id="name" required>
    </div>

    <div>
        <label class="label" for="email">Email</label>
        <input class="input" type="email" name="email" id="email" required>
    </div>

    <div>
        <label class="label" for="password">Password</label>
        <input class="input" type="password" name="password" id="password" required minlength="6">
    </div>

    <button class="btn-primary w-full" type="submit">Create account</button>

    <p class="text-center text-sm text-slate-500">
        Already registered?
        <a class="text-brand-600 hover:underline" href="<?= e(url('/login')) ?>">Sign in</a>
    </p>
</form>
