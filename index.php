<?php
// Version
define('VERSION', '2.3.0.2');

// Configuration
if (is_file('config.php')) {
	require_once('config.php');
}

// Install
if (!defined('DIR_APPLICATION')) {
	header('Location: install/index.php');
	exit;
}
// Redirect
if (preg_match('/\/{2,}/i', $_SERVER['REQUEST_URI'])){
    $newRequestUri = preg_replace('/\/+/i', '/', $_SERVER['REQUEST_URI']);
    header('Location: ' . $newRequestUri, null, 301);
    exit;
}

// Startup
require_once(DIR_SYSTEM . 'startup.php');

start('catalog');