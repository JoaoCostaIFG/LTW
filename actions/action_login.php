<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    echo 'aaa';
    die('asdas');

    if (checkUserPassword($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in successfully!');
        header('Location: ../pages/list.php');
    } else {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Logged failed!');
        // TODO Make do something when wrong password
        header('Location: ../pages/login.php');
    }
?>
