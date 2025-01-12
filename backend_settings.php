// backend_settings.php
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db_name = $_POST['db_name'];
    $db_password = $_POST['db_password'];
    $s3_access_key = $_POST['s3_access_key'];
    $s3_secret_key = $_POST['s3_secret_key'];
    $s3_bucket_name = $_POST['s3_bucket_name'];

    // Validate S3 keys and bucket name using regex
    if (!preg_match('/^[A-Z0-9]{20}$/', $s3_access_key)) {
        die('Invalid S3 Access Key ID.');
    }
    if (!preg_match('/^[A-Za-z0-9\/+=]{40}$/', $s3_secret_key)) {
        die('Invalid S3 Secret Access Key.');
    }
    if (!preg_match('/^[a-z0-9.-]{3,63}$/', $s3_bucket_name)) {
        die('Invalid S3 Bucket Name.');
    }

    // Save settings to session or database
    $_SESSION['db_name'] = $db_name;
    $_SESSION['db_password'] = $db_password;
    $_SESSION['s3_access_key'] = $s3_access_key;
    $_SESSION['s3_secret_key'] = $s3_secret_key;
    $_SESSION['s3_bucket_name'] = $s3_bucket_name;

    echo 'Settings saved successfully.';
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
