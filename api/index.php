<?php

// Vercel serverless has a read-only filesystem except /tmp
// Redirect Laravel's writable paths to /tmp
$_ENV['APP_STORAGE_PATH'] = '/tmp/storage';

// Create required directories in /tmp
$dirs = [
    '/tmp/storage',
    '/tmp/storage/logs',
    '/tmp/storage/framework',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/bootstrap-cache/cache',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

require __DIR__ . '/../public/index.php';
