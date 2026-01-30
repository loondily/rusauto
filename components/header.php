<!-- Header Component -->
<style>
    html { scroll-behavior: smooth; }

    #mobile-menu {
        transition: opacity .3s ease, visibility .3s ease;
    }
    #mobile-menu.active {
        opacity: 1;
        visibility: visible;
    }

</style>

<!-- Mobile Menu -->
<div id="mobile-menu" class="fixed inset-0 z-[10000] invisible opacity-0 bg-slate-950/95 backdrop-blur-xl">
    <div class="flex h-full flex-col items-center justify-center gap-8 text-2xl font-bold uppercase tracking-[0.3em]">
        <button id="menu-close" class="absolute right-8 top-8 text-slate-400 hover:text-cyan-400">
            <i class="ri-close-line text-4xl"></i>
        </button>
        <a href="/">Главная</a>
        <a href="/#brands">Марки</a>
        <a href="/#services">Услуги</a>
        <a href="#contacts" class="text-sm border border-cyan-400/40 rounded-full px-8 py-3 bg-cyan-400/10 transition-colors duration-200 hover:bg-cyan-400/20 hover:border-cyan-400/60">
            Контакты
        </a>
    </div>
</div>

<header class="relative z-10">
    <div class="mx-auto max-w-6xl px-4 pt-12">
        <div class="flex items-center justify-between">
            <a href="/">
                <img src="/src/img/logo.png" class="w-[180px]" alt="logo">
            </a>

            <nav class="hidden md:flex gap-10 text-[11px] uppercase tracking-[0.3em] text-slate-400 font-bold">
                <a href="/" class="transition-colors duration-200 hover:text-cyan-400">Главная</a>
                <a href="/#brands" class="transition-colors duration-200 hover:text-cyan-400">Марки</a>
                <a href="/#services" class="transition-colors duration-200 hover:text-cyan-400">Услуги</a>
            </nav>

            <div class="flex items-center gap-6">
                <div class="hidden lg:flex flex-col items-end">
                    <a href="tel:+79230000000" class="text-sm font-bold">+7 (923) 000-00-00</a>
                    <span class="text-[9px] text-slate-500">Кемерово, бокс 4</span>
                </div>

                <a href="#contacts"
                   class="rounded-full border border-white/10 bg-white/5 px-6 py-3 text-[10px] uppercase tracking-[0.2em] transition-colors duration-200 hover:bg-cyan-400 hover:border-white/20">
                    Связаться
                </a>

                <button id="header-mini-trigger"
                        class="md:hidden w-12 h-12 flex flex-col items-center justify-center gap-1 rounded-xl border border-white/10 bg-white/5 transition-colors duration-200 hover:bg-white/10 hover:border-white/20">
                    <span class="w-5 h-0.5 bg-white"></span>
                    <span class="w-5 h-0.5 bg-white"></span>
                    <span class="w-5 h-0.5 bg-white"></span>
                </button>
            </div>
        </div>
    </div>
</header>

<?php include __DIR__ . '/contacts-modal.php'; ?>

<script>
(function () {
    /* mobile menu */
    const menu = document.getElementById('mobile-menu');
    document.getElementById('header-mini-trigger')?.addEventListener('click', () => {
        menu.classList.add('active');
        document.body.style.overflow = 'hidden';
    });
    document.getElementById('menu-close')?.addEventListener('click', () => {
        menu.classList.remove('active');
        document.body.style.overflow = '';
    });

    /* modal — контакты */
    (function () {
        const modal = document.getElementById('contacts-modal');
        if (!modal) return;

        function openContactsModal() {
            modal.setAttribute('aria-hidden', 'false');
            modal.classList.add('modal-open');
            document.body.style.overflow = 'hidden';
        }

        function closeContactsModal() {
            modal.setAttribute('aria-hidden', 'true');
            modal.classList.remove('modal-open');
            document.body.style.overflow = '';
        }

        document.querySelectorAll('a[href="#contacts"]').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                openContactsModal();
            });
        });

        modal.querySelectorAll('[data-close]').forEach(function(btn) {
            btn.addEventListener('click', closeContactsModal);
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeContactsModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('modal-open')) closeContactsModal();
        });
    })();
})();
</script>
