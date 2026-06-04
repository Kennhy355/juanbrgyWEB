<?php
require_once __DIR__ . '/src/utils/helpers.php';
require_once __DIR__ . '/src/routes/web.php';

echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "get_base_path(): " . get_base_path() . "\n";
echo "base_url('dist/css/app.css'): " . base_url('dist/css/app.css') . "\n";
echo "asset_url('dist/css/app.css'): " . asset_url('dist/css/app.css') . "\n";
