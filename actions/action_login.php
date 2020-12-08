<?php
    require_once '../includes/session.php';
    require_once '../database/queries/db_user.php';
    require_once '../includes/utils.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

if (checkUserPassword($username, $password)) {
    $_SESSION['username'] = $username;
    setSessionMessage('success', 'Logged in successfully!');
    header('Location: ../pages/list.php');
} else {
    setSessionMessage('error', 'Logged failed!');
    // TODO Make do something when wrong password
    header('Location: ../pages/login.php');
}
?>
