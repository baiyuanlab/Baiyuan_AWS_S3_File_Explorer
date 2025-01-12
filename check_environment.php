// check_environment.php
<?php
// Check PHP version
if (version_compare(PHP_VERSION, '8.3.0', '<')) {
    die('PHP 8.3.0 or higher is required. Please update your PHP version.');
}

// Check MySQL version
$mysqli = new mysqli('localhost', 'username', 'password');
if ($mysqli->connect_error) {
    die('Database connection failed: ' . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT VERSION() as version");
$row = $result->fetch_assoc();
$mysql_version = $row['version'];

if (version_compare($mysql_version, '8.0.0', '<')) {
    die('MySQL 8.0 or higher is required. Please update your MySQL version.');
}

$mysqli->close();
?>

// Include this file at the start of your backend scripts
include 'check_environment.php';
