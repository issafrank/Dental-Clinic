<div class="text-center">
    <p class="text-sm font-semibold text-red-600">403</p>
    <h1 class="mt-2 text-3xl font-bold tracking-tight">Forbidden</h1>
    <p class="mt-4 text-slate-500"><?= e($message ?? 'You do not have access to this page.') ?></p>
    <a class="btn-primary mt-6 inline-flex" href="<?= e(url('/dashboard')) ?>">Go to dashboard</a>
</div>
