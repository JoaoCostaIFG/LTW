<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');
    require_once '../actions/action_upload.php';

    function updateUserFail($msg)
    {
        $_SESSION['messages'] = array('type' => 'updateUserError', 'content' => $msg);
        die(header("Location: ../pages/edit_profile.php"));
    }

    // Check for repeated username
    if(getUserInfo($_POST['username'])){        
        updateUserFail("Username already exists!");
    }

    // Password
    if($_POST['password'] != $_POST['password_r']){
        $_SESSION['messages'] = array('type' => 'passwordError', 'content' => "Passwords do not match.");
        die(header("Location: ../pages/settings.php"));
    }

    // Get user information to update
    $user_id = getUserId($_SESSION['username'])['id'];
    $user_info = array(
        'id' => $user_id,
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email'],
        'mobile_number' => $_POST['mobile_number'],
    );
    $type = photoIsValid($_FILES['image']['tmp_name']);

    try {
        updateUser($user_info);
        uploadUserPhoto($user_id, $type);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Successfully updated user.');
        
    } catch (Exception $e) {
        updateUserFail($e->getMessage());
    }

    // Update session if username changed
    if($user_info['username']){
        $_SESSION['username'] = $user_info['username'];
    }  // Update username session

    // Reload profile
    header("Location: ../pages/profile.php?username=" . $_SESSION['username']);

?>
