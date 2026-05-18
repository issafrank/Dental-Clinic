<?php /** @var string $content */ ?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50 dark:bg-slate-950">
<head>
    <?php \App\Core\View::partial('head'); ?>
</head>
<body class="min-h-full font-sans text-slate-800 antialiased dark:text-slate-200">
    <?= $content ?>
<script src="<?= e(asset('js/app.js')) ?>"></script>
</body>
</html>
