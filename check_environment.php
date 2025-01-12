<?php
// 載入 Composer 的自動加載文件
require 'vendor/autoload.php';
// 載入翻譯文件
include 'load_translations.php';

// 使用 Dotenv 庫來讀取 .env 文件中的環境變量
use Dotenv\Dotenv;

// 創建 Dotenv 實例並加載環境變量
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// 獲取用戶選擇的語言，如果沒有設置則默認為英文
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
// 加載相應語言的翻譯
$translations = loadTranslations($lang);

// 檢查伺服器軟體是否為 NGINX
if (stripos($_SERVER['SERVER_SOFTWARE'], 'nginx') === false) {
    die($translations['nginx_required_error']);
}

// 檢查 PHP 版本是否符合要求
if (version_compare(PHP_VERSION, '8.3.0', '<')) {
    die($translations['php_version_error']);
}

// 檢查 MySQL 版本是否符合要求
$mysqli = new mysqli('localhost', getenv('DB_NAME'), getenv('DB_PASSWORD'));

// 如果數據庫連接失敗，則顯示錯誤信息並退出
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT VERSION() as version");
$row = $result->fetch_assoc();
$mysql_version = $row['version'];

// 檢查 MySQL 版本是否符合要求
if (version_compare($mysql_version, '8.0.0', '<')) {
    die($translations['mysql_version_error']);
}

// 關閉數據庫連接
$mysqli->close();
?>
