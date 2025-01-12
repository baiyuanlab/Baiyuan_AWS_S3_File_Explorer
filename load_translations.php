<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

// 創建 Dotenv 實例並加載環境變量
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function loadTranslations($lang = 'en') {
    // 根據語言選擇對應的翻譯文件路徑
    $filePath = __DIR__ . "/translations/{$lang}.json";
    // 如果指定語言的翻譯文件不存在，則使用英文作為默認語言
    if (!file_exists($filePath)) {
        $filePath = __DIR__ . "/translations/en.json";
    }
    // 讀取翻譯文件內容並解析為數組
    $jsonContent = file_get_contents($filePath);
    return json_decode($jsonContent, true);
}

// 獲取用戶選擇的語言，如果沒有設置則默認為英文
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
// 加載相應語言的翻譯
$translations = loadTranslations($lang);
?>
