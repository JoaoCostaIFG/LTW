<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');
    include_once('../database/queries/db_post.php');

    if (!isset($_SESSION['username']))
      die(header('Location: list.php')); // CHANGE LATER

    $user_id = getUserId($_SESSION['username'])['id'];

    $post_id = $_GET['post_id'];
    $text = $_GET['comment_text'];
    print_r($post_id);
    print_r($text);
    insertComment($user_id, $post_id, $text);

    // $username = $_POST['username'];
    // $password = $_POST['password'];

    // if (checkUserPassword($username, $password)) {
    //     $_SESSION['username'] = $username;
    //     $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Logged in successfully!');
    //     header('Location: ../pages/list.php');
    // } else {
    //     $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Logged failed!');
    //     // TODO Make do something when wrong password
    //     header('Location: ../pages/login.php');
    // }
?>
