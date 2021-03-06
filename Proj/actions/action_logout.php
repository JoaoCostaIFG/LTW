<?php
require_once '../includes/session.php';
require_once '../includes/utils.php';

// TAKEN FROM: https://www.php.net/session_destroy

// IMP don't use this line (duplicated from session.php include)
// session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

setSessionMessage('success', 'Logged out!');
header('Location: ../index.php');
?>
