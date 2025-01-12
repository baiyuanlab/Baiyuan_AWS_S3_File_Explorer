// s3_operations.php
<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

session_start();

$s3Client = new S3Client([
    'version' => 'latest',
    'region'  => 'us-west-2',
    'credentials' => [
        'key'    => $_SESSION['s3_access_key'],
        'secret' => $_SESSION['s3_secret_key'],
    ],
]);

// Example function to list objects in a bucket
function listObjects() {
    global $s3Client;
    $bucket = $_SESSION['s3_bucket_name'];

    try {
        $result = $s3Client->listObjectsV2([
            'Bucket' => $bucket,
        ]);
        foreach ($result['Contents'] as $object) {
            echo $object['Key'] . "<br>";
        }
    } catch (AwsException $e) {
        echo "Error: " . $e->getMessage();
    }
}

listObjects();
?>
