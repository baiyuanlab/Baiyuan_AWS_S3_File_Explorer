<?php
session_start();
require 'vendor/autoload.php';
include 'load_translations.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$translations = loadTranslations($lang);

// 假設這是您生成和存儲驗證碼的方式
$storedCaptcha = '123456'; // 這應該是您實際生成並存儲的驗證碼

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $captcha = $_POST['captcha'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 檢查驗證碼是否正確
    if ($captcha !== $storedCaptcha) {
        die($translations['invalid_captcha']);
    }

    // 這裡應該是您驗證用戶名和密碼的邏輯，例如從數據庫中查詢
    // 假設這裡是簡單的硬編碼驗證
    $validUsername = 'admin';
    $validPassword = 'password';

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: main.php');
        exit();
    } else {
        die($translations['login_failed']);
    }
} else {
    die($translations['invalid_request']);
}
?>
