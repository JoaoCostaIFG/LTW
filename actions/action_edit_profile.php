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
        updateUser($user_info);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Successfully updated profile.');
        
    } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to update profile!');
        header('Location: ../pages/profile.php');
    }

    if($user_info['username']){
        $_SESSION['username'] = $user_info['username'];
    }  // Update username session

    header("Location: ../pages/profile.php?username=" . $_SESSION['username']);

?>
