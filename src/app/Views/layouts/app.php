<?php /** @var string $content */ ?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50 dark:bg-slate-950">
<head>
    <?php \App\Core\View::partial('head'); ?>
</head>
<body class="h-full font-sans text-slate-800 antialiased dark:bg-slate-950 dark:text-slate-200">
<?php \App\Core\View::partial('sidebar'); ?>

<div data-main-content class="main-content flex min-h-full flex-col transition-[margin-left] duration-300 ease-out md:ml-64">
    <?php \App\Core\View::partial('topbar'); ?>

    <main class="flex-1 p-6">
        <?php \App\Core\View::partial('flash'); ?>
        <?= $content ?>
    </main>

    <?php \App\Core\View::partial('footer'); ?>
</div>
<script src="<?= e(asset('js/app.js')) ?>"></script>
</body>
</html>
