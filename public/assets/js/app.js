// Sidebar toggle: adds/removes `is-collapsed` on both sidebar and main content.
document.addEventListener('DOMContentLoaded', () => {
    const sidebar    = document.querySelector('[data-sidebar]');
    const main       = document.querySelector('[data-main-content]');
    const toggleBtns = document.querySelectorAll('[data-sidebar-toggle]');

    const isMobile = () => window.innerWidth < 768;
    const html     = document.documentElement;

    // Theme toggle (light/dark). Available on every page, including pages
    // that don't have a sidebar/main (e.g. guest landing, auth screens).
    const themeToggle = document.querySelector('[data-theme-toggle]');
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const isDark = document.documentElement.classList.toggle('dark');
            try { localStorage.setItem('theme', isDark ? 'dark' : 'light'); } catch (_) {}
        });
    }

    // Everything below needs the sidebar/main scaffolding. Bail out gracefully
    // on pages that don't have them so the theme toggle above still works.
    if (!sidebar || !main) return;

    // Sync runtime state (class on sidebar/main) with the persisted
    // pre-paint attribute set in head.php. If the attribute is present
    // on first load, apply `.is-collapsed` so JS state matches visuals.
    if (html.getAttribute('data-sidebar-collapsed') === '1') {
        sidebar.classList.add('is-collapsed');
        main.classList.add('is-collapsed');
    }

    const persist = (collapsed) => {
        try { localStorage.setItem('sidebarCollapsed', collapsed ? '1' : '0'); } catch (_) {}
        if (collapsed) html.setAttribute('data-sidebar-collapsed', '1');
        else           html.removeAttribute('data-sidebar-collapsed');
    };

    const toggle = () => {
        const collapsed = !sidebar.classList.contains('is-collapsed');
        sidebar.classList.toggle('is-collapsed', collapsed);
        main.classList.toggle('is-collapsed', collapsed);
        persist(collapsed);
    };

    const close = () => {
        sidebar.classList.add('is-collapsed');
        main.classList.add('is-collapsed');
        persist(true);
    };

    toggleBtns.forEach((btn) => btn.addEventListener('click', toggle));

    // ESC closes sidebar (mobile only — on desktop, no need)
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isMobile()) close();
    });

    // On mobile, close after clicking a nav link.
    // On desktop: do NOT change the sidebar state — user's collapsed/expanded
    // preference persists across navigations via localStorage.
    document.querySelectorAll('[data-sidebar] a').forEach((link) => {
        link.addEventListener('click', () => {
            if (isMobile()) setTimeout(close, 50);
        });
    });

    // ------------------------------------------------------------------
    // Notifications dropdown
    // ------------------------------------------------------------------
    const notifRoot   = document.querySelector('[data-notif-root]');
    const notifToggle = document.querySelector('[data-notif-toggle]');
    const notifPanel  = document.querySelector('[data-notif-panel]');
    const notifBadge  = document.querySelector('[data-notif-badge]');
    const notifMarkAll= document.querySelector('[data-notif-mark-all]');
    const notifCount  = document.querySelector('[data-notif-unread-count]');

    if (notifRoot && notifToggle && notifPanel) {
        const closeNotif = () => notifPanel.classList.add('hidden');
        const openNotif  = () => notifPanel.classList.remove('hidden');
        const toggleNotif = () =>
            notifPanel.classList.contains('hidden') ? openNotif() : closeNotif();

        notifToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleNotif();
        });

        // Click outside to close
        document.addEventListener('click', (e) => {
            if (!notifRoot.contains(e.target)) closeNotif();
        });

        // ESC to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeNotif();
        });

        const refreshUnreadCount = () => {
            const remaining = document.querySelectorAll('[data-notif-item][data-unread="1"]').length;
            if (notifCount) notifCount.textContent = remaining;
            if (notifBadge) {
                if (remaining > 0) {
                    notifBadge.textContent = remaining;
                    notifBadge.classList.remove('hidden');
                } else {
                    notifBadge.classList.add('hidden');
                }
            }
            if (notifMarkAll) notifMarkAll.disabled = remaining === 0;
        };

        // Click individual item -> mark as read
        document.querySelectorAll('[data-notif-item]').forEach((item) => {
            item.addEventListener('click', () => {
                if (item.dataset.unread === '1') {
                    item.dataset.unread = '0';
                    item.classList.remove('bg-blue-50/30');
                    const dot = item.querySelector('[data-notif-dot]');
                    if (dot) dot.remove();
                    refreshUnreadCount();
                }
            });
        });

        // Mark all as read
        notifMarkAll && notifMarkAll.addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelectorAll('[data-notif-item][data-unread="1"]').forEach((item) => {
                item.dataset.unread = '0';
                item.classList.remove('bg-blue-50/30');
                const dot = item.querySelector('[data-notif-dot]');
                if (dot) dot.remove();
            });
            refreshUnreadCount();
        });

        refreshUnreadCount();
    }

    // Auto-dismiss flash messages
    document.querySelectorAll('[data-flash]').forEach((el) => {
        setTimeout(() => el.classList.add('opacity-0'), 4000);
        setTimeout(() => el.remove(), 4500);
    });

    // ------------------------------------------------------------------
    // Profile avatar upload + preview (client-side)
    // ------------------------------------------------------------------
    const avatarInput   = document.querySelector('[data-avatar-input]');
    const avatarTrigger = document.querySelector('[data-avatar-trigger]');
    const avatarPreview = document.querySelector('[data-avatar-preview]');
    const avatarInitial = document.querySelector('[data-avatar-initial]');
    const avatarActions = document.querySelector('[data-avatar-actions]');
    const avatarHelp    = document.querySelector('[data-avatar-help]');
    const avatarRemove  = document.querySelector('[data-avatar-remove]');
    const avatarChange  = document.querySelector('[data-avatar-change]');

    if (avatarInput && avatarTrigger && avatarPreview) {
        const openPicker = () => avatarInput.click();

        avatarTrigger.addEventListener('click', openPicker);
        avatarChange && avatarChange.addEventListener('click', openPicker);

        avatarInput.addEventListener('change', (e) => {
            const file = e.target.files && e.target.files[0];
            if (!file) return;

            // Validate type + size (2MB)
            if (!file.type.startsWith('image/')) {
                alert('Please choose an image file (PNG/JPG).');
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                alert('Image is larger than 2MB. Please choose a smaller file.');
                return;
            }

            const reader = new FileReader();
            reader.onload = (ev) => {
                avatarPreview.src = ev.target.result;
                avatarPreview.classList.remove('hidden');
                avatarInitial && avatarInitial.classList.add('hidden');
                avatarActions && avatarActions.classList.replace('hidden', 'flex');
                avatarHelp && (avatarHelp.textContent = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB) — preview only.');

                // Persist locally so it survives page reloads (frontend-only demo).
                try { localStorage.setItem('profileAvatar', ev.target.result); } catch (_) {}
            };
            reader.readAsDataURL(file);
        });

        avatarRemove && avatarRemove.addEventListener('click', () => {
            avatarPreview.src = '';
            avatarPreview.classList.add('hidden');
            avatarInitial && avatarInitial.classList.remove('hidden');
            avatarActions && avatarActions.classList.replace('flex', 'hidden');
            avatarInput.value = '';
            avatarHelp && (avatarHelp.textContent = 'Click photo to upload. PNG or JPG, max 2MB.');
            try { localStorage.removeItem('profileAvatar'); } catch (_) {}
        });

        // Restore previously uploaded avatar (frontend-only demo)
        try {
            const saved = localStorage.getItem('profileAvatar');
            if (saved) {
                avatarPreview.src = saved;
                avatarPreview.classList.remove('hidden');
                avatarInitial && avatarInitial.classList.add('hidden');
                avatarActions && avatarActions.classList.replace('hidden', 'flex');
            }
        } catch (_) {}
    }
});
