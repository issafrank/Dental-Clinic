<?php /** @var string $content */ ?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100 dark:bg-slate-900">
<head>
    <?php \App\Core\View::partial('head'); ?>
</head>
<body class="h-full font-sans text-slate-900 antialiased dark:text-slate-200">
<div class="flex min-h-full items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 px-4 py-10 dark:from-slate-900 dark:to-slate-950">
    <div class="w-full max-w-md">
        <div class="mb-8 text-center">
            <div class="mx-auto mb-3 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-slate-900 text-white shadow-sm">
                <?php icon('tooth', 'h-6 w-6'); ?>
            </div>
            <h1 class="text-2xl font-bold tracking-tight"><?= e(config('app.name')) ?></h1>
            <p class="mt-1 text-sm text-slate-500">Dental Clinic Management System</p>
        </div>
        <?php \App\Core\View::partial('flash'); ?>
        <div class="card p-7">
            <?= $content ?>
        </div>
        <p class="mt-6 text-center text-xs text-slate-400">
            &copy; <?= date('Y') ?> <?= e(config('app.name')) ?>
        </p>
    </div>
</div>
</body>
</html>
