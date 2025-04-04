<?php
$request_uri = $_SERVER['REQUEST_URI'];

$file_path = __DIR__ . parse_url($request_uri, PHP_URL_PATH);
if (file_exists($file_path) && is_file($file_path)) {
    return false; 
}
require 'Public/index.php';
