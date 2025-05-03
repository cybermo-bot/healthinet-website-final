<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function loginUser($username, $password) {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([trim($username)]);
    $user = $stmt->fetch();

    if ($user && password_verify(trim($password), $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        return true;
    }
    return false;
}
?>