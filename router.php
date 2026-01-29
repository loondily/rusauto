<?php
declare(strict_types=1);

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$path = rtrim($path, '/');
if ($path === '') {
    $path = '/';
}

$fullPath = __DIR__ . $path;
if ($path !== '/' && file_exists($fullPath)) {
    return false;
}

if (preg_match('#^/([a-z0-9_-]+)$#i', $path, $m)) {
    $_GET['slug'] = $m[1];
    require __DIR__ . '/backend/brand.php';
    exit;
}

if (preg_match('#^/([a-z0-9_-]+)/([a-z0-9_-]+)$#i', $path, $m)) {
    $_GET['brand'] = $m[1];
    $_GET['slug'] = $m[2];
    require __DIR__ . '/backend/model.php';
    exit;
}

require __DIR__ . '/index.php';
