<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$brandId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$slug = isset($_GET['slug']) ? trim((string)$_GET['slug']) : '';
$brand = null;
$models = [];

if ($brandId > 0 || $slug !== '') {
    $pdo = getPdo();
    if ($brandId > 0) {
        $stmt = $pdo->prepare('SELECT id, name, slug, logo_path FROM brands WHERE id = :id');
        $stmt->execute(['id' => $brandId]);
    } else {
        $stmt = $pdo->prepare('SELECT id, name, slug, logo_path FROM brands WHERE slug = :slug');
        $stmt->execute(['slug' => $slug]);
    }
    $brand = $stmt->fetch();

    if ($brand) {
        $stmt = $pdo->prepare('SELECT id, name, slug, description, photo_path FROM models WHERE brand_id = :id ORDER BY name');
        $stmt->execute(['id' => $brand['id']]);
        $models = $stmt->fetchAll();

        if ($models) {
            $modelIds = array_column($models, 'id');
            $in = implode(',', array_fill(0, count($modelIds), '?'));

            $photosStmt = $pdo->prepare("SELECT model_id, photo_path FROM model_photos WHERE model_id IN ({$in})");
            $photosStmt->execute($modelIds);
            $photos = $photosStmt->fetchAll();

            $photosByModel = [];
            foreach ($photos as $row) {
                $photosByModel[$row['model_id']][] = $row['photo_path'];
            }

            foreach ($models as &$model) {
                $model['photos'] = $photosByModel[$model['id']] ?? [];
            }
            unset($model);
        }
    }
}

if (!$brand) {
    header("Location: /");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/css/output.css" rel="stylesheet">
    <title>Русификация <?= htmlspecialchars($brand['name']) ?> в Кемерово — RusAutoKMR</title>
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
    
    <?php include '../components/header.php'; ?>

    <main>
        <!-- Brand Hero Section -->
        <section class="relative mx-auto max-w-6xl px-4 pb-32 pt-24">
            <div class="flex items-center justify-between gap-12">
                <div class="max-w-3xl space-y-12 shrink-0 relative z-10 pt-20">
                    <div class="space-y-4">
                    <nav class="flex items-center gap-4 text-[10px] uppercase tracking-[0.4em] font-black mb-12">
            <a href="/#brands" class="text-slate-500 hover:text-white transition-colors">Марки</a>
            <span class="text-slate-800">/</span>
            <span class="text-cyan-500"><?= htmlspecialchars($brand['name']) ?></span>
        </nav>
                        <h1 class="text-7xl font-bold leading-[1.05] tracking-tight text-white sm:text-8xl">
                            Русификация <br/>
                            <span class="text-slate-500"><?= htmlspecialchars($brand['name']) ?></span>
                        </h1>
                    </div>
                    
                    <p class="max-w-xl text-xl leading-relaxed text-slate-400">
                        Адаптация и русификация штатных систем для всех современных моделей <?= htmlspecialchars($brand['name']) ?>. 
                        Перевод меню, навигации и приборной панели в Кузбассе.
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-8 pt-4">
                        <a href="#models" class="group flex items-center gap-4 rounded-full bg-white px-10 py-5 text-xs font-black uppercase tracking-[0.2em] text-slate-950 transition hover:bg-cyan-400">
                            Выбрать модель
                            <i class="ri-arrow-down-line text-lg transition-transform group-hover:translate-y-1"></i>
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block relative">
                    <div class="absolute -inset-20 bg-cyan-500/10 blur-[100px] rounded-full pointer-events-none"></div>
                    <?php if (!empty($brand['logo_path'])): ?>
                        <img src="<?= htmlspecialchars($brand['logo_path']) ?>" alt="<?= htmlspecialchars($brand['name']) ?>" 
                             class="hero-panel-float w-[400px] max-w-none relative z-0 scale-110 select-none pointer-events-none grayscale opacity-40 hover:opacity-100 hover:grayscale-0 transition-all duration-1000">
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Models Section -->
        <section id="models" class="mx-auto max-w-6xl px-4 pb-40">
            <div class="mb-20 flex flex-col gap-6 md:flex-row md:items-end md:justify-between border-b border-white/5 pb-12">
                <div class="space-y-4">
                    <h2 class="text-5xl font-bold text-white tracking-tighter">Модельный ряд</h2>
                </div>
                <div class="flex gap-4">
                    <div class="h-12 w-px bg-white/10 hidden md:block"></div>
                    <p class="max-w-xs text-xs uppercase tracking-widest text-slate-500 font-bold leading-loose">
                        Поддерживаем все актуальные модификации <br/> мультимедийных систем <?= htmlspecialchars($brand['name']) ?>.
                    </p>
                </div>
            </div>

            <?php if (!$models): ?>
                <div class="w-full rounded-2xl border border-white/5 bg-white/[0.02] p-20 text-center text-slate-500 uppercase tracking-[0.3em] text-[10px] font-bold">
                    Модели для этой марки пока не добавлены
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-20">
                    <?php foreach ($models as $model): ?>
                        <?php
                            $modelLink = (!empty($brand['slug']) && !empty($model['slug']))
                                ? '/' . rawurlencode($brand['slug']) . '/' . rawurlencode($model['slug'])
                                : 'model.php?id=' . rawurlencode((string)$model['id']);
                        ?>
                        <a href="<?= htmlspecialchars($modelLink) ?>" class="group block space-y-8">
                            <div class="relative aspect-[16/10] overflow-hidden transition-all duration-500 group-hover:scale-105">
                                <?php if (!empty($model['photo_path'])): ?>
                                    <img src="<?= htmlspecialchars($model['photo_path']) ?>" alt="<?= htmlspecialchars($model['name']) ?>" 
                                         class="h-full w-full object-contain">
                                <?php else: ?>
                                    <div class="flex h-full w-full items-center justify-center rounded-3xl border border-white/5 bg-white/[0.02] text-slate-800 font-black text-6xl italic">
                                        <?= mb_substr($model['name'], 0, 1) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="space-y-2 text-center">
                                <h3 class="text-xl font-bold text-white uppercase tracking-[0.2em] transition-colors group-hover:text-cyan-400">
                                    <?= htmlspecialchars($model['name']) ?>
                                </h3>
                                <div class="h-1 w-0 bg-cyan-500 mx-auto transition-all duration-500 group-hover:w-12"></div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- Services Section: Reused from Index -->
        <section id="services" class="border-y border-white/5 bg-white/[0.01]">
            <div class="mx-auto max-w-6xl px-4 py-32">
                <div class="grid gap-20 lg:grid-cols-2 lg:items-center">
                    <div class="space-y-12">
                        <div class="space-y-4">
                            <h3 class="text-5xl font-bold leading-tight text-white">
                                Профессиональные <br/>
                                <span class="text-slate-500 font-medium italic">услуги для <?= htmlspecialchars($brand['name']) ?></span>
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
                            <span class="text-5xl font-black text-white tracking-tighter">100%</span>
                            <span class="text-[9px] uppercase tracking-[0.4em] text-slate-500 font-bold">Гарантия качества</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews Component -->
        <?php include '../components/reviews.php'; ?>

    <?php include '../components/footer.php'; ?>
    </main>

    <?php include '../components/footer.php'; ?>

    <script>
    </script>
</body>
</html>