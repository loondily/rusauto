<?php
require_once __DIR__ . '/backend/config.php';

$brands = [];
$brandsError = null;
try {
    $pdo = getPdo();
    $stmt = $pdo->query('SELECT id, name, slug, logo_path FROM brands ORDER BY name');
    $brands = $stmt->fetchAll();
} catch (Throwable $e) {
    $brandsError = $e->getMessage();
    $brands = [];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/css/output.css" rel="stylesheet">
    <title>Русификация автомобилей в Кемерово</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=LINE+Seed+JP:wght@100;400;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        @keyframes heroFloat {
            0%, 100% { transform: translateY(0) rotate(-1deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }
        .hero-panel-float {
            animation: heroFloat 8s ease-in-out infinite;
            filter: drop-shadow(0 20px 50px rgba(0,0,0,0.5)) drop-shadow(0 0 30px rgba(34, 211, 238, 0.15));
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased font-['LINE_Seed_JP'] overflow-x-hidden">
    <div class="pointer-events-none fixed inset-0 bg-[radial-gradient(600px_circle_at_20%_10%,rgba(56,189,248,0.15),transparent_55%),radial-gradient(600px_circle_at_80%_10%,rgba(168,85,247,0.12),transparent_55%),radial-gradient(900px_circle_at_50%_100%,rgba(14,165,233,0.08),transparent_60%)]"></div>
    
    <?php include 'components/header.php'; ?>
    <main>
        <!-- Hero Section: More Strict & Pro -->
        <section class="relative mx-auto max-w-6xl px-4 pb-32 pt-24">
            <div class="flex items-center justify-between gap-12">
                <div class="max-w-3xl space-y-12 shrink-0 relative z-10 pt-20">
                    <h1 class="text-7xl font-bold leading-[1.05] tracking-tight text-white sm:text-8xl">
                        Новый уровень <br/>
                        <span class="text-slate-500">комфорта вашего авто</span>
                    </h1>
                    
                    <p class="max-w-xl text-xl leading-relaxed text-slate-400">
                        Профессиональная адаптация интерфейсов мультимедиа и навигации. <br class="hidden sm:block"/>
                        Полный перевод систем на русский язык без потери гарантии.
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-8 pt-4">
                        <a href="#brands" class="group flex items-center gap-4 rounded-full bg-white px-10 py-5 text-xs font-black uppercase tracking-[0.2em] text-slate-950 transition hover:bg-cyan-400">
                            Перейти к каталогу
                            <i class="ri-arrow-right-line text-lg transition-transform group-hover:translate-x-1"></i>
                        </a>
                        <div class="flex items-center gap-4 border-l border-white/10 pl-8">
                            <span class="text-2xl font-bold text-white tracking-tighter">5 лет</span>
                            <span class="text-[10px] leading-tight uppercase tracking-widest text-slate-500 font-bold">безупречной <br/>репутации</span>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block relative">
                    <div class="absolute -inset-20 bg-cyan-500/10 blur-[100px] rounded-full pointer-events-none"></div>
                    <img src="/src/img/panel.png" alt="Interface" 
                         class="hero-panel-float w-[700px] max-w-none relative z-0 scale-110 select-none pointer-events-none">
                </div>
            </div>
            
            <!-- Absolute decoration -->
            <div class="pointer-events-none absolute -right-24 top-1/2 -z-10 h-[600px] w-[600px] -translate-y-1/2 rounded-full bg-cyan-500/5 blur-[120px]"></div>
        </section>

        <!-- Brands Section: Clean Grid -->
        <section id="brands" class="mx-auto max-w-6xl px-4 pb-40">
            <div class="mb-20 flex flex-col gap-6 md:flex-row md:items-end md:justify-between border-b border-white/5 pb-12">
                <div class="space-y-4">
                    <h2 class="text-5xl font-bold text-white tracking-tighter">Выберите марку</h2>
                </div>
                <div class="flex gap-4">
                    <div class="h-12 w-px bg-white/10 hidden md:block"></div>
                    <p class="max-w-xs text-xs uppercase tracking-widest text-slate-500 font-bold leading-loose">
                        Работаем с актуальными системами <br/> 2018–2026 годов выпуска.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-wrap gap-6">
                <?php if ($brandsError): ?>
                    <div class="w-full rounded-2xl border border-rose-500/10 bg-rose-500/5 p-12 text-center text-rose-300">
                        Ошибка БД: <?= htmlspecialchars($brandsError) ?>
                    </div>
                <?php elseif (!$brands): ?>
                    <div class="w-full rounded-2xl border border-white/5 bg-white/[0.02] p-20 text-center text-slate-500 uppercase tracking-[0.3em] text-[10px] font-bold">
                        Список марок пуст
                    </div>
                <?php else: ?>
                    <?php foreach ($brands as $brand): ?>
                        <?php
                            $brandLink = !empty($brand['slug'])
                                ? '/' . rawurlencode($brand['slug']) . '/'
                                : 'backend/brand.php?id=' . rawurlencode((string)$brand['id']);
                        ?>
                        <a href="<?= htmlspecialchars($brandLink) ?>" class="group relative flex items-center gap-10 rounded-[28px] border border-white/5 bg-white/[0.02] px-8 py-4 transition-all duration-300 hover:border-white/20 hover:bg-white/[0.05] hover:translate-y-[-2px]">
                            <span class="text-base uppercase tracking-[0.5em] text-slate-500 font-black group-hover:text-white transition-colors"><?= htmlspecialchars($brand['name']) ?></span>
                            
                            <div class="flex h-16 w-auto items-center justify-center">
                                <?php if (!empty($brand['logo_path'])): ?>
                                    <img src="<?= htmlspecialchars($brand['logo_path']) ?>" alt="<?= htmlspecialchars($brand['name']) ?>" class="h-full w-auto object-contain grayscale transition-all duration-500 group-hover:grayscale-0 group-hover:scale-110">
                                <?php else: ?>
                                    <span class="text-4xl font-bold text-slate-800"><?= mb_substr($brand['name'], 0, 1) ?></span>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Services Section: Strict Pro -->
        <section id="services" class="border-y border-white/5 bg-white/[0.01]">
            <div class="mx-auto max-w-6xl px-4 py-32">
                <div class="grid gap-20 lg:grid-cols-2 lg:items-center">
                    <div class="space-y-12">
                        <div class="space-y-4">
                            <h3 class="text-5xl font-bold leading-tight text-white">
                                Комплексные <br/>
                                <span class="text-slate-500 font-medium italic">решения для авто</span>
                            </h3>
                        </div>
                        
                        <div class="grid gap-10">
                            <div class="group flex gap-8">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/[0.03] text-white transition-colors group-hover:bg-cyan-500 group-hover:text-slate-950">
                                    <i class="ri-global-line text-2xl"></i>
                                </div>
                                <div class="space-y-3">
                                    <h4 class="font-bold text-white uppercase tracking-widest text-xs">Локализация систем</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed">Полный перевод интерфейса мультимедиа, щитка приборов и проекционного дисплея.</p>
                                </div>
                            </div>
                            
                            <div class="group flex gap-8">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/[0.03] text-white transition-colors group-hover:bg-cyan-500 group-hover:text-slate-950">
                                    <i class="ri-compass-3-line text-2xl"></i>
                                </div>
                                <div class="space-y-3">
                                    <h4 class="font-bold text-white uppercase tracking-widest text-xs">Навигация и карты</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed">Установка актуальных карт России и СНГ с голосовым поиском и дорожными событиями.</p>
                                </div>
                            </div>
                            
                            <div class="group flex gap-8">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/[0.03] text-white transition-colors group-hover:bg-cyan-500 group-hover:text-slate-950">
                                    <i class="ri-dashboard-3-line text-2xl"></i>
                                </div>
                                <div class="space-y-3">
                                    <h4 class="font-bold text-white uppercase tracking-widest text-xs">Чип-тюнинг и допы</h4>
                                    <p class="text-sm text-slate-500 leading-relaxed">Безопасное увеличение мощности и активация скрытых заводских функций комфорта.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="aspect-square overflow-hidden rounded-[48px] border border-white/5 shadow-2xl">
                            <img src="/src/img/tundra_1.jpg" alt="Пример работы" class="h-full w-full object-cover grayscale-[0.5] transition-all duration-700 hover:grayscale-0">
                        </div>
                        <div class="absolute -bottom-10 -left-10 flex flex-col gap-3 rounded-[32px] border border-white/5 bg-slate-950/90 p-10 backdrop-blur-xl shadow-2xl">
                            <span class="text-5xl font-black text-white tracking-tighter">5+</span>
                            <span class="text-[9px] uppercase tracking-[0.4em] text-slate-500 font-bold">Лет опыта</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews: Professional Slider -->
        <section class="relative mx-auto max-w-6xl px-4 py-40">
            <div class="relative group">
                <!-- Navigation Arrows -->
                <button id="review-prev" class="absolute -left-6 top-1/2 z-10 -translate-y-1/2 rounded-full border border-white/10 bg-slate-900/80 px-4 py-3 text-white shadow-2xl backdrop-blur transition hover:bg-white hover:text-slate-950" aria-label="Предыдущий">
                    <i class="ri-arrow-left-s-line text-2xl"></i>
                </button>
                <button id="review-next" class="absolute -right-6 top-1/2 z-10 -translate-y-1/2 rounded-full border border-white/10 bg-slate-900/80 px-4 py-3 text-white shadow-2xl backdrop-blur transition hover:bg-white hover:text-slate-950" aria-label="Следующий">
                    <i class="ri-arrow-right-s-line text-2xl"></i>
                </button>

                <div class="overflow-hidden">
                    <div id="reviews-track" class="flex gap-8 transition-transform duration-500 ease-out">
                        <article class="w-full md:w-[calc(33.333%-1.35rem)] shrink-0 rounded-[24px] border border-white/5 bg-white/[0.02] p-10 transition-all duration-300 hover:bg-white/[0.04] hover:border-white/10">
                            <p class="text-base leading-relaxed text-slate-200 mb-12 font-medium">
                                «Всё русифицировали за один день. Меню понятное, навигация и подсказки — на русском. Дилер даже не заметил изменений в системе.»
                            </p>
                            <div class="flex items-center gap-4 border-t border-white/5 pt-8">
                                <div class="h-10 w-10 rounded-full bg-slate-900 flex items-center justify-center font-black text-[11px] text-cyan-500 border border-white/10 tracking-tighter">АК</div>
                                <div class="flex flex-col">
                                    <span class="text-[12px] font-bold text-white uppercase tracking-widest">Андрей К.</span>
                                    <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">Toyota Camry</span>
                                </div>
                            </div>
                        </article>
                        
                        <article class="w-full md:w-[calc(33.333%-1.35rem)] shrink-0 rounded-[24px] border border-white/5 bg-white/[0.02] p-10 transition-all duration-300 hover:bg-white/[0.04] hover:border-white/10">
                            <p class="text-base leading-relaxed text-slate-200 mb-12 font-medium">
                                «Сделали аккуратно и быстро. Теперь все системные сообщения читаемы. Голосовое управление работает безупречно на русском языке.»
                            </p>
                            <div class="flex items-center gap-4 border-t border-white/5 pt-8">
                                <div class="h-10 w-10 rounded-full bg-slate-900 flex items-center justify-center font-black text-[11px] text-cyan-500 border border-white/10 tracking-tighter">МС</div>
                                <div class="flex flex-col">
                                    <span class="text-[12px] font-bold text-white uppercase tracking-widest">Марина С.</span>
                                    <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">BMW X5</span>
                                </div>
                            </div>
                        </article>
                        
                        <article class="w-full md:w-[calc(33.333%-1.35rem)] shrink-0 rounded-[24px] border border-white/5 bg-white/[0.02] p-10 transition-all duration-300 hover:bg-white/[0.04] hover:border-white/10">
                            <p class="text-base leading-relaxed text-slate-200 mb-12 font-medium">
                                «Отличная работа. Голосовые подсказки и мультимедиа полностью на русском. Рекомендую всем владельцам современных автомобилей.»
                            </p>
                            <div class="flex items-center gap-4 border-t border-white/5 pt-8">
                                <div class="h-10 w-10 rounded-full bg-slate-900 flex items-center justify-center font-black text-[11px] text-cyan-500 border border-white/10 tracking-tighter">ИП</div>
                                <div class="flex flex-col">
                                    <span class="text-[12px] font-bold text-white uppercase tracking-widest">Игорь П.</span>
                                    <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">Geely Tugella</span>
                                </div>
                            </div>
                        </article>

                        <article class="w-full md:w-[calc(33.333%-1.35rem)] shrink-0 rounded-[24px] border border-white/5 bg-white/[0.02] p-10 transition-all duration-300 hover:bg-white/[0.04] hover:border-white/10">
                            <p class="text-base leading-relaxed text-slate-200 mb-12 font-medium">
                                «Профессиональный подход. Русификация выполнена безупречно, навигация работает корректно. Обязательно обращусь снова.»
                            </p>
                            <div class="flex items-center gap-4 border-t border-white/5 pt-8">
                                <div class="h-10 w-10 rounded-full bg-slate-900 flex items-center justify-center font-black text-[11px] text-cyan-500 border border-white/10 tracking-tighter">ВЛ</div>
                                <div class="flex flex-col">
                                    <span class="text-[12px] font-bold text-white uppercase tracking-widest">Виктор Л.</span>
                                    <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold">Lixiang L7</span>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

    <!-- Footer Component -->
    <?php include 'components/footer.php'; ?>
    </main>
    <script>
        // Reviews functionality
        (function () {
            const track = document.getElementById("reviews-track");
            const prev = document.getElementById("review-prev");
            const next = document.getElementById("review-next");
            if (!track || !prev || !next) return;

            let currentOffset = 0;
            const cardWidth = track.firstElementChild.offsetWidth + 32; // width + gap
            const maxOffset = track.scrollWidth - track.parentElement.offsetWidth;

            next.addEventListener("click", () => {
                if (currentOffset < maxOffset) {
                    currentOffset = Math.min(currentOffset + cardWidth, maxOffset);
                    track.style.transform = `translateX(-${currentOffset}px)`;
                } else {
                    // Цикличность: если в конце, идем в начало
                    currentOffset = 0;
                    track.style.transform = `translateX(0)`;
                }
            });

            prev.addEventListener("click", () => {
                if (currentOffset > 0) {
                    currentOffset = Math.max(currentOffset - cardWidth, 0);
                    track.style.transform = `translateX(-${currentOffset}px)`;
                } else {
                    // Цикличность: если в начале, идем в конец
                    currentOffset = maxOffset;
                    track.style.transform = `translateX(-${currentOffset}px)`;
                }
            });

            // Автоматическая подстройка при ресайзе
            window.addEventListener('resize', () => {
                currentOffset = 0;
                track.style.transform = `translateX(0)`;
            });
        })();
    </script>
</body>
</html>