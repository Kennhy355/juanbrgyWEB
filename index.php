<?php
/**
 * Application Entry Point
 * 
 * All requests are routed through this file.
 */

// Load utilities
require_once __DIR__ . '/src/utils/helpers.php';

// Load router and dispatch
require_once __DIR__ . '/src/routes/web.php';
dispatch();
