<!-- Header Component -->
<style>
    html {
        scroll-behavior: smooth;
    }
    #mobile-menu {
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    #mobile-menu.active {
        opacity: 1;
        visibility: visible;
    }
</style>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="fixed inset-0 z-[10000] invisible opacity-0 bg-slate-950/95 backdrop-blur-xl">
    <div class="flex h-full flex-col items-center justify-center gap-8 text-2xl font-bold uppercase tracking-[0.3em]">
        <button id="menu-close" class="absolute right-8 top-8 text-slate-400 hover:text-white transition">
            <i class="ri-close-line text-4xl"></i>
        </button>
        <a href="/" class="hover:text-cyan-400 transition">Главная</a>
        <a href="/#brands" class="hover:text-cyan-400 transition">Марки</a>
        <a href="/#services" class="hover:text-cyan-400 transition">Услуги</a>
        <a href="#contacts" class="hover:text-cyan-400 transition text-sm font-medium border border-cyan-400/40 rounded-full px-8 py-3 bg-cyan-400/10">Контакты</a>
    </div>
</div>

<header class="relative z-10">
    <div class="mx-auto max-w-6xl px-4 pt-12">
        <div class="flex items-center justify-between">
            <a href="/" class="relative transition-transform hover:scale-105">
                <img src="/src/img/logo.png" alt="logo" class="w-[180px] h-auto object-contain">
            </a>
            
            <nav class="hidden md:flex items-center gap-10 text-[11px] uppercase tracking-[0.3em] text-slate-400 font-bold">
                <a class="hover:text-white transition-colors" href="/">Главная</a>
                <a class="hover:text-white transition-colors" href="/#brands">Марки</a>
                <a class="hover:text-white transition-colors" href="/#services">Услуги</a>
            </nav>

            <div class="flex items-center gap-6">
                <div class="hidden lg:flex flex-col items-end">
                    <a href="tel:+79230000000" class="text-sm font-bold text-white tracking-wider">+7 (923) 000-00-00</a>
                    <span class="text-[9px] uppercase tracking-[0.2em] text-slate-500 font-bold">Кемерово, бокс 4</span>
                </div>
                <a href="#contacts" class="rounded-full border border-white/10 bg-white/5 px-6 py-3 text-[10px] font-bold uppercase tracking-[0.2em] text-white backdrop-blur transition hover:bg-white hover:text-slate-950">
                    Связаться
                </a>
                
                <!-- Burger for Mobile -->
                <button type="button" id="header-mini-trigger" class="flex md:hidden w-12 h-12 flex-col items-center justify-center gap-[5px] rounded-xl border border-white/10 bg-white/5 text-slate-200" aria-label="Меню">
                    <span class="w-5 h-0.5 bg-current"></span>
                    <span class="w-5 h-0.5 bg-current"></span>
                    <span class="w-5 h-0.5 bg-current"></span>
                </button>
            </div>
        </div>
    </div>
</header>

<script>
    (function () {
        const mobileMenu = document.getElementById("mobile-menu");
        const menuClose = document.getElementById("menu-close");
        const menuTrigger = document.getElementById("header-mini-trigger");
        
        if (!mobileMenu || !menuTrigger || !menuClose) return;

        function toggleMenu(show) {
            mobileMenu.classList.toggle("active", show);
            document.body.style.overflow = show ? "hidden" : "";
        }

        menuTrigger.addEventListener("click", () => toggleMenu(true));
        menuClose.addEventListener("click", () => toggleMenu(false));
        
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => toggleMenu(false));
        });
    })();
</script>