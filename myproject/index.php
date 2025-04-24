<?php
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// Handle API calls
if (strpos($path, '/api/messages') === 0) {
    include_once __DIR__ . '/api/messages/index.php';
    exit;
}

// Serve static HTML
$staticFile = __DIR__ . '/public' . ($path === '/' ? '/index.html' : $path);

// If the requested file exists in /public, serve it
if (file_exists($staticFile)) {
    include_once $staticFile;
    exit;
}

// Fallback to index.html
include_once __DIR__ . '/public/index.html';

