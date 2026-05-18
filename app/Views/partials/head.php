<?php
// Shared <head> assets. Uses compiled Tailwind if available, else CDN fallback.
$compiled = BASE_PATH . '/public/assets/css/app.css';
$useCdn = !is_file($compiled);
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?= e(csrf_token()) ?>">
<title><?= e(config('app.name')) ?></title>

<!-- Inline scrollbar + root bg theme override (bypasses any CSS caching).
     Tailwind's `dark:` variant uses :is(.dark *) which doesn't match the
     <html> element itself (it has the .dark class but isn't its own
     descendant). So `dark:bg-slate-950` on <html> never applies — we set
     it explicitly here so the scrollbar gutter doesn't leak the light bg. -->
<style>
    html       { background-color: rgb(248 250 252); color-scheme: light; scrollbar-color: rgb(203 213 225) rgb(241 245 249); }
    html.dark  { background-color: rgb(2 6 23);     color-scheme: dark;  scrollbar-color: rgb(51 65 85) rgb(2 6 23); }
    html::-webkit-scrollbar              { width: 14px; height: 14px; }
    html::-webkit-scrollbar-track        { background: rgb(241 245 249); }
    html::-webkit-scrollbar-thumb        { background: rgb(203 213 225); border-radius: 9999px; }
    html::-webkit-scrollbar-thumb:hover  { background: rgb(148 163 184); }
    html.dark::-webkit-scrollbar-track       { background: rgb(2 6 23); }
    html.dark::-webkit-scrollbar-thumb       { background: rgb(51 65 85); }
    html.dark::-webkit-scrollbar-thumb:hover { background: rgb(71 85 105); }
    html.dark::-webkit-scrollbar-corner      { background: rgb(2 6 23); }
</style>

<!-- Theme + sidebar state: apply BEFORE paint to avoid flash -->
<script>
    (function () {
        try {
            var t = localStorage.getItem('theme');
            var d = t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (d) document.documentElement.classList.add('dark');
        } catch (_) {}
        // Persist sidebar collapsed state across page navigations.
        // We stash a flag on <html> so the sidebar/main-content can read it
        // the moment they appear in the DOM (see inline init below).
        try {
            var collapsed = localStorage.getItem('sidebarCollapsed') === '1';
            if (collapsed) document.documentElement.setAttribute('data-sidebar-collapsed', '1');
        } catch (_) {}
    })();
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<?php if ($useCdn): ?>
    <!-- Hard size cap for icons so they don't blow up if CSS fails to load -->
    <style>
        svg { max-width: 1.5rem; max-height: 1.5rem; }
        body { font-family: 'Inter', system-ui, sans-serif; }
    </style>
    <!-- Tailwind Play CDN (dev only). For production, run `npm run build`. -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        // Visible warning kung blocked ang CDN (Brave Shields, ad-blocker, etc.)
        window.addEventListener('load', function () {
            if (typeof tailwind === 'undefined') {
                const w = document.createElement('div');
                w.style.cssText = 'position:fixed;top:0;left:0;right:0;padding:12px;background:#dc2626;color:#fff;font:14px system-ui;text-align:center;z-index:9999';
                w.textContent = 'Tailwind CDN failed to load. Disable Brave Shields for this site, or run: npm install && npm run build';
                document.body.appendChild(w);
            }
        });
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:'#eff8ff',100:'#dceffd',200:'#b2dffb',300:'#7ec7f8',
                            400:'#42a8f1',500:'#1d8be0',600:'#106ebd',700:'#0f5899',
                            800:'#114a7e',900:'#133e69'
                        }
                    },
                    fontFamily: { sans: ['Inter','ui-sans-serif','system-ui','sans-serif'] }
                }
            }
        };
    </script>
    <style type="text/tailwindcss">
        @layer components {
            .btn        { @apply inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2 text-sm font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50; }
            .btn-primary{ @apply btn bg-slate-900 text-white hover:bg-slate-800 focus:ring-slate-700; }
            .btn-secondary{ @apply btn bg-white text-slate-900 ring-1 ring-slate-200 hover:bg-slate-50 focus:ring-slate-300; }
            .btn-danger { @apply btn bg-red-600 text-white hover:bg-red-700 focus:ring-red-500; }
            .btn-ghost  { @apply btn text-slate-600 hover:bg-slate-100 focus:ring-slate-300; }
            .card       { @apply rounded-xl bg-white shadow-sm ring-1 ring-slate-200; }
            .input      { @apply w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm placeholder:text-slate-400 focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-200; }
            .label      { @apply mb-1.5 block text-sm font-medium text-slate-700; }
            .badge      { @apply inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 ring-inset; }
            .nav-link   { @apply group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white; }
            .nav-link-active { @apply bg-slate-800 text-white; }
        }
    </style>
<?php else: ?>
    <link rel="stylesheet" href="<?= e(asset('css/app.css')) ?>">
<?php endif; ?>
