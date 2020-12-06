<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');
    require_once '../actions/action_upload.php';

    function registerFail($msg)
    {
        $_SESSION['messages'] = array('type' => 'updateUserError', 'content' => $msg);
        die(header("Location: ../pages/edit_profile.php"));
    }

    if(getUserInfo($_POST['username'])){        // Check for repeated username
        registerFail("Username already exists!");
    }

    $user_id = getUserId($_SESSION['username'])['id'];

    $user_info = array(
        'id' => $user_id,
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'mobile_number' => $_POST['mobile_number'],
    );
  
    $type = photoIsValid($_FILES['image']['tmp_name']);

    try {
        updateUser($user_info);
        uploadUserPhoto($user_id, $type);
        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Successfully updated profile.');
        
    } catch (Exception $e) {
        registerFail($e->getMessage());
    }

    if($user_info['username']){
        $_SESSION['username'] = $user_info['username'];
    }  // Update username session

    header("Location: ../pages/profile.php?username=" . $_SESSION['username']);

?>
