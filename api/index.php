<?php

// Vercel serverless environment initialization
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL')) {
    $dirs = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    if (!file_exists('/tmp/database.sqlite')) {
        if (file_exists(__DIR__ . '/../database/seed.sqlite')) {
            @copy(__DIR__ . '/../database/seed.sqlite', '/tmp/database.sqlite');
        } elseif (file_exists(__DIR__ . '/../database/database.sqlite')) {
            @copy(__DIR__ . '/../database/database.sqlite', '/tmp/database.sqlite');
        } else {
            @touch('/tmp/database.sqlite');
        }
    }
    putenv('DB_DATABASE=/tmp/database.sqlite');
    $_ENV['DB_DATABASE'] = '/tmp/database.sqlite';

    // Normalize server variables so Laravel generates clean URLs without /api/index.php
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';
}

require __DIR__ . '/../public/index.php';
