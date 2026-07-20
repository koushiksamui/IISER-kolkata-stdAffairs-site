<?php
$file = isset($_GET['file']) ? $_GET['file'] : '';
if (empty($file)) {
    http_response_code(400);
    exit("No file specified");
}

$path = realpath(__DIR__ . '/../' . $file);
$baseDir = realpath(__DIR__ . '/../dist/vid/');

// Security check: ensure the file is inside dist/vid
if ($path === false || strpos($path, $baseDir) !== 0 || !file_exists($path)) {
    http_response_code(404);
    exit("File not found or access denied");
}

$size = filesize($path);
$mime = 'video/mp4';

$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
if ($ext === 'webm') $mime = 'video/webm';
if ($ext === 'ogv') $mime = 'video/ogg';

// Clear out any output buffers
while (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: ' . $mime);
header('Content-Disposition: inline; filename="' . basename($path) . '"');
header('Accept-Ranges: bytes');
header('Cache-Control: public, max-age=86400');

// Handle range requests for video streaming
$start = 0;
$end = $size - 1;

if (isset($_SERVER['HTTP_RANGE'])) {
    $c_start = $start;
    $c_end = $end;
    list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
    if (strpos($range, ',') !== false) {
        http_response_code(416);
        header("Content-Range: bytes $start-$end/$size");
        exit;
    }
    if ($range == '-') {
        $c_start = $size - substr($range, 1);
    } else {
        $range = explode('-', $range);
        $c_start = $range[0];
        $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size - 1;
    }
    $c_end = ($c_end > $end) ? $end : $c_end;
    if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
        http_response_code(416);
        header("Content-Range: bytes $start-$end/$size");
        exit;
    }
    $start = $c_start;
    $end = $c_end;
    $length = $end - $start + 1;
    http_response_code(206);
    header("Content-Length: $length");
    header("Content-Range: bytes $start-$end/$size");
} else {
    $length = $size;
    header("Content-Length: $length");
}

$fp = fopen($path, 'rb');
if (!$fp) {
    http_response_code(500);
    exit("Could not open file");
}
fseek($fp, $start);
$buffer = 1024 * 8;
while (!feof($fp) && ($p = ftell($fp)) <= $end) {
    if ($p + $buffer > $end) {
        $buffer = $end - $p + 1;
    }
    set_time_limit(0);
    echo fread($fp, $buffer);
    flush();
}
fclose($fp);
exit;
