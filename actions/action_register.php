<?php
require_once '../pages/session.php';
require_once '../database/queries/db_user.php';

function registerFail($msg)
{
    $_SESSION['messages'] = array('type' => 'signUpError', 'content' => $msg);
    die(header('Location: ../pages/register.php'));
}

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_r = $_POST['password_r'];
    $picture = $_POST['picture'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];

    // TODO Verify regex password and username here
    // TODO Verify repeated password
if ($password != $password_r) {
    registerFail("Passwords don't match!");
}

try {
    insertUser($username, $password, $picture, $email, $mobile_number);
    $_SESSION['username'] = $username;
    $_SESSION['messages'] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../pages/list.php');
} catch (PDOException $e) {
    registerFail('Failed to signup!');
}
?>
