<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function loadTranslations($lang = 'en') {
    $filePath = __DIR__ . "/translations/{$lang}.json";
    if (!file_exists($filePath)) {
        $filePath = __DIR__ . "/translations/en.json"; // fallback to English
    }
    $jsonContent = file_get_contents($filePath);
    return json_decode($jsonContent, true);
}

// Example of loading translations
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en'; // or use session or user profile to set language
$translations = loadTranslations($lang);
?>
