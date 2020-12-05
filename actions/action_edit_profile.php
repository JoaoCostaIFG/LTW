<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');

    $user_id = getUserId($_SESSION['username'])['id'];

    $user_info = array(
        'id' => $user_id,
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'mobile_phone' => $_POST['mobile_number'],
    );
  
    try {
        /* updateUser($post_info); */
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Successfully updated profile.');
        header('Location: ../pages/profile.php');
        
    } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update profile!');
        header('Location: ../pages/profile.php');
    }
?>
