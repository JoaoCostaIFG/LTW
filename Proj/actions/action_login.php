<?php
require_once '../includes/session.php';
require_once '../includes/utils.php';
require_once '../database/queries/db_user.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  setSessionMessage('error', 'Request method not supported');
  die('Location: ../pages/login.php');
}

if(!isset($_POST['username']) || !isset($_POST['password'])){
  setSessionMessage('error', 'Login failed!');
  die(header('Location: ../pages/login.php'));
}

$username = treatInputNonEmpty($_POST['username']);
$password = $_POST['password'];
if (checkUserPassword($username, $password)) {
    $_SESSION['username'] = $username;
    setSessionMessage('success', 'Logged in successfully!');
    die(header('Location: ../pages/list.php'));
} else {
    setSessionMessage('loginError', 'Login failed! Incorrect user or password.');
    die(header('Location: ../pages/login.php'));
}
?>
