<?php
// Role-based sidebar sections. Each role sees only the nav links relevant
// to their permissions. Admin sees everything; doctor/staff/patient see
// scoped subsets.
$role = auth()['role'] ?? 'admin';

$sectionsByRole = [
    'admin' => [
        'Main' => [
            ['/dashboard',    'Dashboard',    'home'],
            ['/appointments', 'Appointments', 'calendar'],
        ],
        'Records' => [
            ['/patients',     'Patients',     'users'],
            ['/dentists',     'Dentists',     'identification'],
            ['/staff',        'Staff',        'briefcase'],
            ['/treatments',   'Treatments',   'tooth'],
        ],
        'Operations' => [
            ['/services',     'Services',     'sparkles'],
            ['/billing',      'Billing',      'banknotes'],
            ['/inventory',    'Inventory',    'archive'],
        ],
        'System' => [
            ['/reports',      'Reports',      'chart-bar'],
            ['/settings',     'Settings',     'cog'],
        ],
    ],
    'dentist' => [
        'Main' => [
            ['/dashboard',    'Dashboard',     'home'],
            ['/appointments', 'My Schedule',   'calendar'],
        ],
        'Clinical' => [
            ['/patients',     'Patients',      'users'],
            ['/treatments',   'Treatments',    'tooth'],
        ],
        'Reference' => [
            ['/services',     'Services',      'sparkles'],
        ],
        'Account' => [
            ['/profile',      'Profile',       'identification'],
        ],
    ],
    'staff' => [
        'Main' => [
            ['/dashboard',    'Dashboard',     'home'],
            ['/appointments', 'Appointments',  'calendar'],
        ],
        'Records' => [
            ['/patients',     'Patients',      'users'],
        ],
        'Operations' => [
            ['/billing',      'Billing',       'banknotes'],
            ['/inventory',    'Inventory',     'archive'],
        ],
        'Account' => [
            ['/profile',      'Profile',       'identification'],
        ],
    ],
    'patient' => [
        'Main' => [
            ['/dashboard',     'Dashboard',          'home'],
            ['/appointments',  'My Appointments',    'calendar'],
        ],
        'My Records' => [
            ['/treatments',    'Treatment History',  'tooth'],
            ['/billing',       'Billing',            'banknotes'],
        ],
        'Account' => [
            ['/profile',       'Profile',            'identification'],
        ],
    ],
];

$sections = $sectionsByRole[$role] ?? $sectionsByRole['admin'];
// Normalize the current request path so it matches the $href values above
// (e.g. strip the APP_URL base path "/dental-clinic/public" and any query string).
$current = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$basePath = parse_url(rtrim($_ENV['APP_URL'] ?? '', '/'), PHP_URL_PATH) ?? '';
if ($basePath !== '' && str_starts_with($current, $basePath)) {
    $current = substr($current, strlen($basePath)) ?: '/';
}
$u = auth();
?>
<aside data-sidebar
       class="sidebar fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full transform flex-col border-r border-slate-800 bg-slate-900 text-slate-100 shadow-xl transition-[transform,width] duration-300 ease-out md:translate-x-0">

    <!-- Header: brand -->
    <a href="<?= e(url('/dashboard')) ?>"
       data-sidebar-row
       class="flex h-16 flex-none items-center gap-2.5 border-b border-slate-800 px-5">
        <span class="inline-flex h-9 w-9 flex-none items-center justify-center rounded-lg bg-gradient-to-br from-blue-500 to-blue-700 shadow-sm">
            <?php icon('tooth', 'h-5 w-5 text-white'); ?>
        </span>
        <span data-sidebar-brand-text class="truncate text-base font-semibold tracking-tight text-white"><?= e(config('app.name')) ?></span>
    </a>

    <!-- Nav -->
    <nav class="flex-1 overflow-hidden px-3 py-4">
        <?php foreach ($sections as $title => $links): ?>
            <div class="mb-4">
                <?php if ($title !== 'Main'): ?>
                    <p data-sidebar-section-title class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-[0.12em] text-slate-500"><?= e($title) ?></p>
                <?php endif; ?>
                <div class="space-y-0.5">
                    <?php foreach ($links as [$href, $label, $ic]):
                        $active = $current === $href || str_starts_with($current, rtrim($href, '/') . '/');
                    ?>
                        <a href="<?= e(url($href)) ?>"
                           data-sidebar-row
                           class="group/nav relative flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                                  <?= $active
                                      ? 'bg-slate-800 text-white'
                                      : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' ?>">
                            <?php if ($active): ?>
                                <span class="absolute inset-y-1.5 left-0 w-0.5 rounded-full bg-blue-500"></span>
                            <?php endif; ?>
                            <?php icon($ic, 'h-5 w-5 flex-none ' . ($active ? 'text-blue-400' : 'text-slate-500')); ?>
                            <span data-sidebar-label class="truncate"><?= e($label) ?></span>

                            <!-- Tooltip (shown only when sidebar is in rail mode) -->
                            <span data-sidebar-tooltip role="tooltip"
                                  class="pointer-events-none absolute left-full top-1/2 z-50 ml-3 -translate-y-1/2 items-center whitespace-nowrap rounded-md bg-slate-800 px-2.5 py-1 text-xs font-medium text-white opacity-0 shadow-lg ring-1 ring-slate-700 transition-opacity duration-150 group-hover/nav:opacity-100">
                                <?= e($label) ?>
                                <span class="absolute -left-1 top-1/2 h-2 w-2 -translate-y-1/2 rotate-45 bg-slate-800 ring-1 ring-slate-700"></span>
                            </span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </nav>

    <!-- User footer -->
    <?php if ($u): ?>
    <div data-sidebar-footer class="flex-none border-t border-slate-800 p-3">
        <div data-sidebar-row data-sidebar-footer-row class="flex items-center gap-3 rounded-lg bg-slate-900/60 p-2.5 ring-1 ring-slate-800">
            <span class="inline-flex h-9 w-9 flex-none items-center justify-center rounded-full bg-gradient-to-br from-slate-600 to-slate-800 text-sm font-semibold text-white ring-1 ring-slate-700">
                <?= e(strtoupper(substr($u['name'] ?? '?', 0, 1))) ?>
            </span>
            <div data-sidebar-footer-details class="min-w-0 flex-1">
                <p class="truncate text-sm font-medium text-white"><?= e($u['name']) ?></p>
                <p class="truncate text-xs text-slate-400 capitalize"><?= e($u['role']) ?></p>
            </div>
            <form data-sidebar-footer-details method="POST" action="<?= e(url('/logout')) ?>">
                <?= csrf_field() ?>
                <button type="submit"
                        class="inline-flex h-8 w-8 flex-none items-center justify-center rounded-md text-slate-400 transition hover:bg-slate-800 hover:text-white"
                        title="Sign out">
                    <?php icon('logout', 'h-4 w-4'); ?>
                </button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</aside>
