<?php
    include_once('../pages/session.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    session_destroy();
    session_start();

    $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged out!');

    header('Location: ../pages/list.php');
?>
