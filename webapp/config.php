<?php

// Railway MySQL
define('DB_HOST', getenv('MYSQL_HOST') ?: getenv('MYSQLHOST') ?: 'localhost');
define('DB_NAME', getenv('MYSQL_DATABASE') ?: getenv('MYSQLDATABASE') ?: 'smashbite');
define('DB_USER', getenv('MYSQL_USER') ?: getenv('MYSQLUSER') ?: 'smashbite_user');
define('DB_PASS', getenv('MYSQL_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: '');
define('DB_PORT', getenv('MYSQL_PORT') ?: getenv('MYSQLPORT') ?: '3306');
define('DB_CHARSET', 'utf8mb4');

define('SESSION_NAME', 'smashbite_session');

define('PAYMENT_MODE', 'manual');
