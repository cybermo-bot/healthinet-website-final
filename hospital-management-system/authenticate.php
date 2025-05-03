<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (loginUser($_POST['username'], $_POST['password'])) {
        header("Location: http://localhost/fiche-patient/pages/dashboard.php");
    } else {
        header("Location: index.php?error=1");
    }
    exit();
}
?>