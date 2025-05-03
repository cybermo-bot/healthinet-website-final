<?php
// Use absolute path with __DIR__
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/auth.php';

// Clear all session data
$_SESSION = array();

// Delete session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy session
session_destroy();

// Redirect to login page
header("Location: index.php");
exit();
?>