<?php
    include_once('../session.php');
    include_once('../database/queries/db_user.php');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $picture = $_POST['picture'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];

    //TODO Verify regex password and username here
    // TODO Verify repeated password

    try {
        insertUser($username, $password, $picture, $email, $mobile_number);
        $_SESSION['username'] = $username;
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Signed up and logged in!');
        header('Location: ../pages/list.php');
    } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to signup!');
        header('Location: ../pages/register.php');
    }
?>
