<?php


$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (strpos($path, '/api/messages') === 0) {
    include_once __DIR__ . '/api/messages/index.php';
    exit;
}

if (strpos($path, '/api/projects') === 0) {
    include_once __DIR__ . '/api/projects/index.php';
    exit;
}

if (strpos($path, '/public/css/') === 0 || strpos($path, '/public/js/') === 0) {
    $filePath = __DIR__ . $path;
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    
    if (file_exists($filePath)) {
        if ($extension === 'css') {
            header('Content-Type: text/css');
        } else if ($extension === 'js') {
            header('Content-Type: application/javascript');
        }
        readfile($filePath);
        exit;
    }
}

$staticFile = __DIR__ . '/public' . ($path === '/' ? '/index.html' : $path);

if (file_exists($staticFile)) {
    $extension = pathinfo($staticFile, PATHINFO_EXTENSION);
    
    if ($extension === 'html') {
        header('Content-Type: text/html');
    }
    
    include_once $staticFile;
    exit;
}

include_once __DIR__ . '/public/index.html';
?>