<?php
require __DIR__ . '/vendor/autoload.php';

if (!defined('DB_TYPE')) {
    define('DB_TYPE', 'sqlite');
}

if (!defined('BASE_URL')) {
    define('BASE_URL', $_SERVER['DOCUMENT_ROOT']);
}

require_once __DIR__ . '/routes/routes.php';