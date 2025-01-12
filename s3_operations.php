<?php
// 載入 Composer 的自動加載文件
require 'vendor/autoload.php';

// 載入 AWS SDK for PHP
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// 開啟會話
session_start();

// 創建 S3 客戶端實例
$s3Client = new S3Client([
    'version' => 'latest',
    'region'  => 'us-west-2',
    'credentials' => [
        'key'    => $_SESSION['s3_access_key'],
        'secret' => $_SESSION['s3_secret_key'],
    ],
]);

// 列出存儲桶中的對象的示例函數
function listObjects() {
    global $s3Client;
    $bucket = $_SESSION['s3_bucket_name'];

    try {
        // 列出存儲桶中的對象
        $result = $s3Client->listObjectsV2([
            'Bucket' => $bucket,
        ]);
        // 打印對象的鍵
        foreach ($result['Contents'] as $object) {
            echo $object['Key'] . "<br>";
        }
    } catch (AwsException $e) {
        // 顯示錯誤信息
        echo "Error: " . $e->getMessage();
    }
}

// 調用函數列出對象
listObjects();
?>
