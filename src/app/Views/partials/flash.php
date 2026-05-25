<?php
$success = \App\Core\Session::flash('success');
$error   = \App\Core\Session::flash('error');
?>
<?php if ($success): ?>
    <div data-flash class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 transition-opacity duration-500 dark:border-green-900/50 dark:bg-green-900/20 dark:text-green-300">
        <?= e($success) ?>
    </div>
<?php endif; ?>
<?php if ($error): ?>
    <div data-flash class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 transition-opacity duration-500 dark:border-red-900/50 dark:bg-red-900/20 dark:text-red-300">
        <?= e($error) ?>
    </div>
<?php endif; ?>
