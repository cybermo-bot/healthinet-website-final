<?php
// MUST be first - no whitespace/HTML before!
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__.'/php-errors.log');

// Session handling
if (session_status() === PHP_SESSION_NONE) {
    session_name('MEDICAL_SYS');
    session_start();
}

// Database connection
$host = 'localhost';
$dbname = 'fiche_patient';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    error_log("DB Error: ".$e->getMessage());
    die("System maintenance in progress");
}
?>