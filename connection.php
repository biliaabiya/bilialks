<?php
if (!isset($_SESSION)) { 
    session_start(); 
}

// Adjust the path to loadenv.php
$loadenvPath = $_SERVER['DOCUMENT_ROOT'].'/lkscloudbabel2024/services/loadenv.php';
if (file_exists($loadenvPath)) {
    include_once $loadenvPath;
} else {
    die("Error: loadenv.php file not found at path: " . $loadenvPath);
}

// Use getenv to fetch the environment variables
$db_host = getenv('MYSQL_HOST');
$db_user = getenv('MYSQL_USER');
$db_pass = getenv('MYSQL_PASSWORD');
$db_name = getenv('MYSQL_DATABASE');

// Verify if the environment variables are loaded (for debugging purposes)
echo 'MYSQL_HOST: ' . $db_host . PHP_EOL;
echo 'MYSQL_USER: ' . $db_user . PHP_EOL;
echo 'MYSQL_PASSWORD: ' . $db_pass . PHP_EOL;
echo 'MYSQL_DATABASE: ' . $db_name . PHP_EOL;

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>