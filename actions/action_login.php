<?php
require_once '../includes/session.php';
require_once '../includes/utils.php';
require_once '../database/queries/db_user.php';

$username = treatInputNonEmpty($_POST['username']);
$password = $_POST['password'];
if(!isset($username) || !isset($password)){
  setSessionMessage('error', 'Logged failed!');
  die(header('Location: ../pages/login.php'));
}

if (checkUserPassword($username, $password)) {
    $_SESSION['username'] = $username;
    setSessionMessage('success', 'Logged in successfully!');
    die(header('Location: ../pages/list.php'));
} else {
    setSessionMessage('loginError', 'Logged failed! Incorrect user or password.');
    die(header('Location: ../pages/login.php'));
}
?>
