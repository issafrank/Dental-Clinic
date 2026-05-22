<div class="mb-6">
    <h2 class="text-xl font-semibold tracking-tight">Welcome back</h2>
    <p class="mt-1 text-sm text-slate-500">Sign in to your account to continue.</p>
</div>

<form method="POST" action="<?= e(url('/login')) ?>" class="space-y-4">
    <?= csrf_field() ?>

    <div class="relative mt-3">
        <input class="peer w-full rounded-lg border border-slate-200 bg-white px-3 py-3 text-sm shadow-sm placeholder:text-transparent focus:placeholder:text-slate-400 dark:focus:placeholder:text-slate-500 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-slate-400 dark:focus:ring-slate-700"
               type="email" name="email" id="email" required autofocus
               placeholder="you@example.com" value="<?= e(old('email')) ?>">
        <label class="pointer-events-none absolute left-2.5 -top-2 bg-white dark:bg-slate-800 px-1 text-xs font-medium text-slate-500 transition-all duration-200 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-slate-400 peer-placeholder-shown:bg-transparent peer-focus:-top-2 peer-focus:text-xs peer-focus:bg-white dark:peer-focus:bg-slate-800 peer-focus:text-slate-700 dark:text-slate-400 dark:peer-focus:text-slate-300"
               for="email">Email</label>
    </div>

    <div class="relative mt-3">
        <input class="peer w-full rounded-lg border border-slate-200 bg-white px-3 py-3 pr-16 text-sm shadow-sm placeholder:text-transparent focus:placeholder:text-slate-400 dark:focus:placeholder:text-slate-500 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-100 dark:focus:border-slate-400 dark:focus:ring-slate-700"
               type="password" name="password" id="password" required placeholder="At least 6 characters">
        <label class="pointer-events-none absolute left-2.5 -top-2 bg-white dark:bg-slate-800 px-1 text-xs font-medium text-slate-500 transition-all duration-200 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-slate-400 peer-placeholder-shown:bg-transparent peer-focus:-top-2 peer-focus:text-xs peer-focus:bg-white dark:peer-focus:bg-slate-800 peer-focus:text-slate-700 dark:text-slate-400 dark:peer-focus:text-slate-300"
               for="password">Password</label>
        <a class="absolute right-3 top-3.5 text-xs font-medium text-slate-400 hover:text-slate-900 dark:hover:text-slate-100"
           href="<?= e(url('/forgot')) ?>">Forgot?</a>
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
