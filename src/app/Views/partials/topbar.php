<?php
$u = auth();

// Normalize the current request path so we can flag the active topbar item.
$current = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$basePath = parse_url(rtrim($_ENV['APP_URL'] ?? '', '/'), PHP_URL_PATH) ?? '';
if ($basePath !== '' && str_starts_with($current, $basePath)) {
    $current = substr($current, strlen($basePath)) ?: '/';
}
$isOn = fn(string $p): bool => $current === $p || str_starts_with($current, rtrim($p, '/') . '/');
$notifActive   = $isOn('/notifications');
$profileActive = $isOn('/profile');

$notifications = [
    ['id' => 1, 'type' => 'appointment', 'icon' => 'calendar',  'tint' => 'bg-blue-100 text-blue-600',
     'title' => 'New appointment booked', 'body' => 'Maria Santos booked Dental Cleaning for tomorrow 9:00 AM.',
     'time' => '5 minutes ago', 'unread' => true],
    ['id' => 2, 'type' => 'payment',     'icon' => 'banknotes', 'tint' => 'bg-emerald-100 text-emerald-600',
     'title' => 'Payment received',      'body' => '₱6,500.00 received from Anna Reyes for Teeth Whitening.',
     'time' => '1 hour ago', 'unread' => true],
    ['id' => 3, 'type' => 'inventory',   'icon' => 'archive',   'tint' => 'bg-amber-100 text-amber-600',
     'title' => 'Low stock alert',       'body' => 'Composite Resin is below reorder threshold (8 of 10).',
     'time' => '3 hours ago', 'unread' => true],
    ['id' => 4, 'type' => 'patient',     'icon' => 'user',      'tint' => 'bg-fuchsia-100 text-fuchsia-600',
     'title' => 'New patient registered','body' => 'Pedro Garcia completed registration.',
     'time' => 'Yesterday', 'unread' => false],
    ['id' => 5, 'type' => 'system',      'icon' => 'cog',       'tint' => 'bg-slate-100 text-slate-600',
     'title' => 'Backup completed',      'body' => 'Daily database backup completed successfully.',
     'time' => '2 days ago', 'unread' => false],
];
$unreadCount = count(array_filter($notifications, fn($n) => $n['unread']));
?>
<header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-slate-200 bg-white/80 px-6 backdrop-blur dark:border-slate-700 dark:bg-slate-900/80">
    <div class="flex items-center gap-3">
        <div class="group relative">
            <button data-sidebar-toggle
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-700 transition hover:bg-slate-100 active:bg-slate-200 dark:text-slate-200 dark:hover:bg-slate-800"
                    aria-label="Toggle sidebar">
                <?php icon('menu', 'h-6 w-6'); ?>
            </button>
            <span role="tooltip"
                  class="pointer-events-none absolute left-1/2 top-full z-50 mt-2 -translate-x-1/2 whitespace-nowrap rounded-md bg-slate-900 px-2.5 py-1 text-xs font-medium text-white opacity-0 shadow-lg transition-opacity duration-150 group-hover:opacity-100 dark:bg-slate-700">
                Toggle sidebar
                <span class="absolute -top-1 left-1/2 h-2 w-2 -translate-x-1/2 rotate-45 bg-slate-900 dark:bg-slate-700"></span>
            </span>
        </div>
        <div class="relative hidden md:block">
            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                <?php icon('search', 'h-4 w-4'); ?>
            </span>
            <input type="search" placeholder="Search..."
                   class="input w-72 pl-9">
        </div>
    </div>

    <div class="flex items-center gap-2">

        <!-- Theme toggle -->
        <button data-theme-toggle
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-700 transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800"
                aria-label="Toggle theme" title="Toggle theme">
            <span data-theme-icon-light class="dark:hidden"><?php icon('moon', 'h-5 w-5'); ?></span>
            <span data-theme-icon-dark class="hidden dark:inline-flex"><?php icon('sun', 'h-5 w-5 text-amber-400'); ?></span>
        </button>

        <!-- Notifications dropdown -->
        <div class="relative" data-notif-root>
            <button data-notif-toggle
                    class="relative inline-flex h-10 w-10 items-center justify-center rounded-lg transition <?= $notifActive
                        ? 'bg-slate-100 text-blue-600 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-blue-400 dark:ring-slate-700'
                        : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' ?>"
                    aria-label="Notifications">
                <?php icon('bell', 'h-5 w-5'); ?>
                <?php if ($unreadCount > 0): ?>
                    <span data-notif-badge
                          class="absolute -right-0.5 -top-0.5 inline-flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white ring-2 ring-white dark:ring-slate-900">
                        <?= $unreadCount ?>
                    </span>
                <?php endif; ?>
            </button>

            <!-- Dropdown panel -->
            <div data-notif-panel
                 class="absolute right-0 top-full z-50 mt-2 hidden w-80 origin-top-right overflow-hidden rounded-xl bg-white shadow-xl ring-1 ring-slate-200 sm:w-96 dark:bg-slate-800 dark:ring-slate-700">
                <!-- Header -->
                <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3 dark:border-slate-700">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Notifications</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            <span data-notif-unread-count><?= $unreadCount ?></span> unread
                        </p>
                    </div>
                    <button data-notif-mark-all
                            class="text-xs font-medium text-blue-600 transition hover:text-blue-700 disabled:opacity-40 dark:text-blue-400 dark:hover:text-blue-300">
                        Mark all as read
                    </button>
                </div>

                <!-- List -->
                <div data-notif-list class="max-h-96 overflow-y-auto">
                    <?php if (!$notifications): ?>
                        <div data-notif-empty class="flex flex-col items-center justify-center px-6 py-12 text-center">
                            <span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                <?php icon('bell', 'h-6 w-6'); ?>
                            </span>
                            <p class="mt-3 text-sm font-medium text-slate-900">No notifications</p>
                            <p class="text-xs text-slate-500">You're all caught up!</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($notifications as $n): ?>
                            <div data-notif-item data-unread="<?= $n['unread'] ? '1' : '0' ?>"
                                 class="group flex cursor-pointer items-start gap-3 border-b border-slate-50 px-4 py-3 transition hover:bg-slate-50 dark:border-slate-700/50 dark:hover:bg-slate-700/40 <?= $n['unread'] ? 'bg-blue-50/30 dark:bg-blue-900/20' : '' ?>">
                                <span class="mt-0.5 inline-flex h-9 w-9 flex-none items-center justify-center rounded-full <?= e($n['tint']) ?>">
                                    <?php icon($n['icon'], 'h-4 w-4'); ?>
                                </span>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="truncate text-sm font-medium text-slate-900 dark:text-slate-100"><?= e($n['title']) ?></p>
                                        <?php if ($n['unread']): ?>
                                            <span data-notif-dot class="mt-1.5 h-2 w-2 flex-none rounded-full bg-blue-500"></span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="mt-0.5 line-clamp-2 text-xs text-slate-600 dark:text-slate-400"><?= e($n['body']) ?></p>
                                    <p class="mt-1 text-[11px] font-medium text-slate-400 dark:text-slate-500"><?= e($n['time']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Footer -->
                <a href="<?= e(url('/notifications')) ?>"
                   class="block border-t border-slate-100 bg-slate-50/50 px-4 py-3 text-center text-xs font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-700/50">
                    View all notifications &rarr;
                </a>
            </div>
        </div>

        <a href="<?= e(url('/profile')) ?>"
           class="inline-flex h-10 w-10 items-center justify-center rounded-lg transition <?= $profileActive
               ? 'bg-slate-100 text-blue-600 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-blue-400 dark:ring-slate-700'
               : 'text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800' ?>"
           title="Profile">
            <?php icon('user', 'h-5 w-5'); ?>
        </a>
        <form method="POST" action="<?= e(url('/logout')) ?>">
            <?= csrf_field() ?>
            <button class="btn-secondary" type="submit">
                <?php icon('logout', 'h-4 w-4'); ?>
                <span class="hidden sm:inline">Sign out</span>
            </button>
        </form>
    </div>
</header>
