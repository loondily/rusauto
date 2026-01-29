<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';

$modelId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$brandSlug = isset($_GET['brand']) ? trim((string)$_GET['brand']) : '';
$modelSlug = isset($_GET['slug']) ? trim((string)$_GET['slug']) : '';

$model = null;
$photos = [];
$videos = [];

if ($modelId > 0 || $modelSlug !== '') {
    $pdo = getPdo();
    if ($modelId > 0) {
        $stmt = $pdo->prepare(
            'SELECT m.id, m.name, m.slug, m.description, m.photo_path,
                    b.id AS brand_id, b.name AS brand_name, b.slug AS brand_slug
             FROM models m
             JOIN brands b ON b.id = m.brand_id
             WHERE m.id = :id'
        );
        $stmt->execute(['id' => $modelId]);
    } elseif ($brandSlug !== '') {
        $stmt = $pdo->prepare(
            'SELECT m.id, m.name, m.slug, m.description, m.photo_path,
                    b.id AS brand_id, b.name AS brand_name, b.slug AS brand_slug
             FROM models m
             JOIN brands b ON b.id = m.brand_id
             WHERE m.slug = :model_slug AND b.slug = :brand_slug'
        );
        $stmt->execute(['model_slug' => $modelSlug, 'brand_slug' => $brandSlug]);
    } else {
        $stmt = $pdo->prepare(
            'SELECT m.id, m.name, m.slug, m.description, m.photo_path,
                    b.id AS brand_id, b.name AS brand_name, b.slug AS brand_slug
             FROM models m
             JOIN brands b ON b.id = m.brand_id
             WHERE m.slug = :model_slug'
        );
        $stmt->execute(['model_slug' => $modelSlug]);
    }

    $model = $stmt->fetch();

    if ($model) {
        $photosStmt = $pdo->prepare('SELECT photo_path FROM model_photos WHERE model_id = :id ORDER BY id');
        $photosStmt->execute(['id' => $model['id']]);
        $photos = $photosStmt->fetchAll();

        $videosStmt = $pdo->prepare('SELECT video_path FROM model_videos WHERE model_id = :id ORDER BY id');
        $videosStmt->execute(['id' => $model['id']]);
        $videos = $videosStmt->fetchAll();
    }
}

if (!$model) {
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
    <title>Русификация <?= htmlspecialchars($model['brand_name'] . ' ' . $model['name']) ?> в Кемерово — RusAutoKMR</title>
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

    <main class="overflow-x-hidden">
        <!-- Model Hero Section -->
        <section class="relative mx-auto max-w-6xl px-4 pb-32 pt-24">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-4 text-[10px] uppercase tracking-[0.4em] font-black mb-12 relative z-10">
                <a href="/#brands" class="text-slate-500 hover:text-white transition-colors">Марки</a>
                <span class="text-slate-800">/</span>
                <a href="/<?= rawurlencode($model['brand_slug']) ?>/" class="text-slate-500 hover:text-white transition-colors"><?= htmlspecialchars($model['brand_name']) ?></a>
                <span class="text-slate-800">/</span>
                <span class="text-cyan-500"><?= htmlspecialchars($model['name']) ?></span>
            </nav>

            <div class="flex items-center justify-between gap-12">
                <div class="max-w-3xl space-y-12 shrink-0 relative z-10">
                    <div class="space-y-4">
                        <h1 class="text-7xl font-bold leading-[1.05] tracking-tight text-white sm:text-8xl">
                            <?= htmlspecialchars($model['brand_name']) ?> <br/>
                            <span class="text-slate-500"><?= htmlspecialchars($model['name']) ?></span>
                        </h1>
                    </div>
                    
                    <p class="max-w-xl text-xl leading-relaxed text-slate-400">
                        Профессиональная русификация штатных систем для <?= htmlspecialchars($model['brand_name'] . ' ' . $model['name']) ?>. 
                        Полная адаптация мультимедиа, приборной панели и навигации под российские условия.
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-8 pt-4">
                        <a href="#details" class="group flex items-center gap-4 rounded-full bg-white px-10 py-5 text-xs font-black uppercase tracking-[0.2em] text-slate-950 transition hover:bg-cyan-400">
                            Подробнее о работе
                            <i class="ri-arrow-down-line text-lg transition-transform group-hover:translate-y-1"></i>
                        </a>
                    </div>
                </div>

                <div class="hidden lg:block relative">
                    <div class="absolute -inset-20 bg-cyan-500/10 blur-[100px] rounded-full pointer-events-none"></div>
                    <?php if (!empty($model['photo_path'])): ?>
                        <img src="<?= htmlspecialchars($model['photo_path']) ?>" alt="<?= htmlspecialchars($model['name']) ?>" 
                             class="hero-panel-float w-[600px] max-w-none relative z-0 scale-110 select-none pointer-events-none object-contain">
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <div id="details" class="mx-auto max-w-6xl px-4 py-24 relative z-10 border-t border-white/5">
            <div class="grid gap-20 lg:grid-cols-[1.2fr_0.8fr]">
                <div class="space-y-20">
                    <!-- Title & Description -->
                    <div class="space-y-10">
                        <div class="prose prose-invert max-w-none">
                            <div class="rounded-[32px] border border-white/5 bg-white/[0.02] p-10 backdrop-blur-sm">
                                <h3 class="text-xs uppercase tracking-[0.4em] text-cyan-500 font-black mb-6">О проделанной работе</h3>
                                <div class="text-lg leading-relaxed text-slate-300 space-y-4">
                                    <?= $model['description']
                                        ? nl2br(htmlspecialchars($model['description']))
                                        : 'Специалисты RusAutoKMR выполнили полную программную адаптацию мультимедийной системы для данной модели. Реализован перевод всех интерфейсов, включая щиток приборов и навигационные карты.' ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Gallery Section -->
                <div class="space-y-12">
                    <div class="flex items-center justify-between border-b border-white/5 pb-8">
                        <h2 class="text-3xl font-bold text-white tracking-tight italic">Результат работы</h2>
                        <span class="text-[10px] uppercase tracking-[0.4em] text-slate-600 font-bold">Фотогалерея (До / После)</span>
                    </div>

                    <?php if ($photos): ?>
                        <div class="grid gap-6 md:grid-cols-2">
                            <?php foreach ($photos as $photo): ?>
                                <div class="group relative overflow-hidden rounded-[32px] border border-white/10 bg-slate-900 transition-all duration-700 hover:border-cyan-500/50">
                                    <img src="<?= htmlspecialchars($photo['photo_path']) ?>" alt="<?= htmlspecialchars($model['name']) ?>" 
                                         class="aspect-video w-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="rounded-[32px] border border-white/5 bg-white/[0.01] p-20 text-center">
                            <i class="ri-image-line text-4xl text-slate-800 mb-4 block"></i>
                            <p class="text-xs uppercase tracking-widest text-slate-600 font-bold">Фотографии процесса в разработке</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-12">
                <!-- Video Section -->
                <?php if ($videos): ?>
                    <div class="space-y-8">
                        <h3 class="text-xs uppercase tracking-[0.4em] text-slate-500 font-black">Видеообзор</h3>
                        <div class="space-y-6">
                            <?php foreach ($videos as $video): ?>
                                <div class="overflow-hidden rounded-[32px] border border-white/10 bg-slate-900 p-2 shadow-2xl">
                                    <video controls class="aspect-video w-full rounded-[24px] object-cover">
                                        <source src="<?= htmlspecialchars($video['video_path']) ?>">
                                    </video>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Contact Card -->
                <div class="sticky top-24 rounded-[40px] border border-cyan-500/20 bg-cyan-500/5 p-12 backdrop-blur-xl space-y-8">
                    <div class="space-y-2">
                        <h4 class="text-2xl font-bold text-white tracking-tight italic">Нужна такая же работа?</h4>
                        <p class="text-sm text-slate-400 leading-relaxed">Оставьте заявку, и мы проконсультируем вас по стоимости и срокам для вашего авто.</p>
                    </div>
                    <a href="#contacts" class="flex items-center justify-center gap-4 rounded-full bg-white px-8 py-5 text-xs font-black uppercase tracking-[0.2em] text-slate-950 transition hover:bg-cyan-400">
                        Связаться с нами
                    </a>
                </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../components/footer.php'; ?>
</body>
</html>