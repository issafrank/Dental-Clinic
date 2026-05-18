<div class="mb-6">
    <h2 class="text-xl font-semibold tracking-tight">Welcome back</h2>
    <p class="mt-1 text-sm text-slate-500">Sign in to your account to continue.</p>
</div>

<form method="POST" action="<?= e(url('/login')) ?>" class="space-y-4">
    <?= csrf_field() ?>

    <div>
        <label class="label" for="email">Email</label>
        <input class="input" type="email" name="email" id="email" required autofocus
               placeholder="you@clinic.local">
    </div>

    <div>
        <div class="flex items-center justify-between">
            <label class="label mb-0" for="password">Password</label>
            <a class="text-xs font-medium text-slate-500 hover:text-slate-900" href="<?= e(url('/forgot')) ?>">Forgot?</a>
        </div>
        <input class="input mt-1.5" type="password" name="password" id="password" required placeholder="••••••••">
    </div>

    <button class="btn-primary w-full" type="submit">
        Sign in
        <?php icon('check', 'h-4 w-4'); ?>
    </button>

    <p class="pt-2 text-center text-sm text-slate-500">
        Don't have an account?
        <a class="font-medium text-slate-900 hover:underline" href="<?= e(url('/register')) ?>">Create one</a>
    </p>
</form>
