<?php
require 'vendor/autoload.php';
include 'load_translations.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$translations = loadTranslations($lang);

// Check PHP version
if (version_compare(PHP_VERSION, '8.3.0', '<')) {
    die($translations['php_version_error']);
}

// Check MySQL version
$mysqli = new mysqli('localhost', getenv('DB_NAME'), getenv('DB_PASSWORD'));
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT VERSION() as version");
$row = $result->fetch_assoc();
$mysql_version = $row['version'];

if (version_compare($mysql_version, '8.0.0', '<')) {
    die($translations['mysql_version_error']);
}

$mysqli->close();
?>
