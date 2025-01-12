<?php
// 開啟會話
session_start();
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

// 處理表單提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db_name = $_POST['db_name'];
    $db_password = $_POST['db_password'];
    $s3_access_key = $_POST['s3_access_key'];
    $s3_secret_key = $_POST['s3_secret_key'];
    $s3_bucket_name = $_POST['s3_bucket_name'];

    // 使用正則表達式驗證 S3 金鑰和桶名稱
    if (!preg_match('/^[A-Z0-9]{20}$/', $s3_access_key)) {
        die($translations['invalid_s3_access_key']);
    }
    if (!preg_match('/^[A-Za-z0-9\/+=]{40}$/', $s3_secret_key)) {
        die($translations['invalid_s3_secret_key']);
    }
    if (!preg_match('/^[a-z0-9.-]{3,63}$/', $s3_bucket_name)) {
        die($translations['invalid_s3_bucket_name']);
    }

    // 將設置保存到會話或數據庫
    $_SESSION['db_name'] = $db_name;
    $_SESSION['db_password'] = $db_password;
    $_SESSION['s3_access_key'] = $s3_access_key;
    $_SESSION['s3_secret_key'] = $s3_secret_key;
    $_SESSION['s3_bucket_name'] = $s3_bucket_name;

    // 顯示設置保存成功的消息
    echo $translations['settings_saved'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Backend Settings</title>
</head>
<body>
    <form method="post" action="">
        <label for="db_name">Database Name:</label>
        <input type="text" id="db_name" name="db_name" required><br>

        <label for="db_password">Database Password:</label>
        <input type="password" id="db_password" name="db_password" required><br>

        <label for="s3_access_key">S3 Access Key ID:</label>
        <input type="text" id="s3_access_key" name="s3_access_key" required><br>

        <label for="s3_secret_key">S3 Secret Access Key:</label>
        <input type="password" id="s3_secret_key" name="s3_secret_key" required><br>

        <label for="s3_bucket_name">S3 Bucket Name:</label>
        <input type="text" id="s3_bucket_name" name="s3_bucket_name" required><br>

        <input type="submit" value="Save Settings">
    </form>
</body>
</html>
