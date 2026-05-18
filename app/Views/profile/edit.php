<?php
/** @var array $user */
$initial = strtoupper(substr($user['name'] ?? '?', 0, 1));
?>

<!-- Page header -->
<div class="mb-6">
    <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">My Profile</h1>
    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage your personal information, security, and preferences.</p>
</div>

<div class="grid gap-6 lg:grid-cols-3">

    <!-- Left: Identity card -->
    <div class="space-y-6 lg:col-span-1">
        <div class="card overflow-hidden">
            <div class="h-24 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700"></div>
            <div class="-mt-12 px-6 pb-6 text-center">

                <!-- Clickable avatar with upload -->
                <button type="button"
                        data-avatar-trigger
                        class="group relative mx-auto inline-flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-slate-700 to-slate-900 text-3xl font-bold text-white shadow-md ring-4 ring-white transition hover:shadow-lg focus:outline-none focus:ring-blue-500"
                        aria-label="Change profile picture">
                    <!-- Initial fallback -->
                    <span data-avatar-initial><?= e($initial) ?></span>
                    <!-- Image preview (hidden until file chosen) -->
                    <img data-avatar-preview alt="" class="absolute inset-0 hidden h-full w-full rounded-full object-cover">
                    <!-- Hover overlay (camera icon) -->
                    <span class="absolute inset-0 flex items-center justify-center rounded-full bg-black/50 opacity-0 transition group-hover:opacity-100">
                        <?php icon('camera', 'h-6 w-6 text-white'); ?>
                    </span>
                </button>

                <input type="file" data-avatar-input accept="image/*" class="hidden">

                <h2 class="mt-3 text-lg font-semibold text-slate-900 dark:text-white"><?= e($user['name'] ?? 'User') ?></h2>
                <p class="text-sm text-slate-500 dark:text-slate-400"><?= e($user['email'] ?? '') ?></p>
                <span class="mt-3 inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1 text-xs font-medium capitalize text-blue-700 ring-1 ring-inset ring-blue-200">
                    <?php icon('check', 'h-3 w-3'); ?>
                    <?= e($user['role'] ?? 'user') ?>
                </span>

                <!-- Upload actions (shown after picking a file) -->
                <div data-avatar-actions class="mt-4 hidden items-center justify-center gap-2">
                    <button type="button" data-avatar-remove
                            class="inline-flex items-center gap-1.5 rounded-md px-3 py-1.5 text-xs font-medium text-slate-600 ring-1 ring-slate-200 transition hover:bg-slate-50">
                        <?php icon('x-mark', 'h-3 w-3'); ?> Remove
                    </button>
                    <button type="button" data-avatar-change
                            class="inline-flex items-center gap-1.5 rounded-md bg-slate-900 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-slate-800">
                        <?php icon('camera', 'h-3 w-3'); ?> Change
                    </button>
                </div>

                <p data-avatar-help class="mt-3 text-xs text-slate-400">Click photo to upload. PNG or JPG, max 2MB.</p>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="mb-4 text-sm font-semibold text-slate-900 dark:text-white">Account Stats</h3>
            <dl class="space-y-3 text-sm">
                <div class="flex items-center justify-between">
                    <dt class="text-slate-500 dark:text-slate-400">Member since</dt>
                    <dd class="font-medium text-slate-900 dark:text-slate-100"><?= e(date('M Y')) ?></dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-slate-500 dark:text-slate-400">Last login</dt>
                    <dd class="font-medium text-slate-900 dark:text-slate-100">Today</dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-slate-500 dark:text-slate-400">Status</dt>
                    <dd>
                        <span class="inline-flex items-center gap-1 text-emerald-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Active
                        </span>
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Right: Forms -->
    <div class="space-y-6 lg:col-span-2">

        <!-- Personal info -->
        <form method="POST" action="<?= e(url('/profile')) ?>" class="card p-6">
            <?= csrf_field() ?>
            <div class="mb-5 flex items-center gap-2.5">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600 ring-1 ring-inset ring-blue-100">
                    <?php icon('user', 'h-5 w-5'); ?>
                </span>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Personal Information</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Update your name and contact details.</p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="label" for="name">Full name</label>
                    <input id="name" class="input" name="name" value="<?= e($user['name'] ?? '') ?>" required>
                </div>
                <div>
                    <label class="label" for="email">Email address</label>
                    <input id="email" class="input" type="email" name="email" value="<?= e($user['email'] ?? '') ?>" required>
                </div>
                <div>
                    <label class="label" for="phone">Phone number</label>
                    <input id="phone" class="input" name="phone" value="<?= e($user['phone'] ?? '') ?>" placeholder="+63 ...">
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4 dark:border-slate-700">
                <button type="reset" class="btn-secondary">Cancel</button>
                <button type="submit" class="btn-primary">
                    <?php icon('check', 'h-4 w-4'); ?>
                    Save changes
                </button>
            </div>
        </form>

        <!-- Security / password -->
        <form method="POST" action="<?= e(url('/profile')) ?>" class="card p-6">
            <?= csrf_field() ?>
            <div class="mb-5 flex items-center gap-2.5">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-50 text-amber-600 ring-1 ring-inset ring-amber-100">
                    <?php icon('cog', 'h-5 w-5'); ?>
                </span>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Security</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Change your password to keep your account secure.</p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="label" for="current_password">Current password</label>
                    <input id="current_password" class="input" type="password" name="current_password" placeholder="••••••••">
                </div>
                <div>
                    <label class="label" for="password">New password</label>
                    <input id="password" class="input" type="password" name="password" minlength="6" placeholder="At least 6 characters">
                </div>
                <div>
                    <label class="label" for="password_confirmation">Confirm new password</label>
                    <input id="password_confirmation" class="input" type="password" name="password_confirmation" minlength="6" placeholder="Repeat password">
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-2 border-t border-slate-100 pt-4 dark:border-slate-700">
                <button type="submit" class="btn-primary">
                    <?php icon('check', 'h-4 w-4'); ?>
                    Update password
                </button>
            </div>
        </form>

        <!-- Danger zone -->
        <div class="card border border-red-200 p-6 dark:border-red-900/50">
            <div class="mb-4 flex items-center gap-2.5">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-600 ring-1 ring-inset ring-red-100">
                    <?php icon('trash', 'h-5 w-5'); ?>
                </span>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Danger Zone</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Irreversible actions. Proceed with caution.</p>
                </div>
            </div>
            <div class="flex flex-col gap-3 rounded-lg bg-red-50/50 p-4 sm:flex-row sm:items-center sm:justify-between dark:bg-red-900/10">
                <div>
                    <p class="text-sm font-medium text-slate-900 dark:text-white">Delete account</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Permanently remove your account and all associated data.</p>
                </div>
                <button type="button" class="btn-danger">
                    <?php icon('trash', 'h-4 w-4'); ?>
                    Delete account
                </button>
            </div>
        </div>
    </div>
</div>
