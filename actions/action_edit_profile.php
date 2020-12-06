<?php
  require_once '../pages/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../actions/action_upload.php';
  require_once '../templates/tpl_utils.php';

function updateUserFail($msg)
{
    setSessionMessage('updateUserError', $msg);
    die(header("Location: ../pages/edit_profile.php"));
}

    // Check for repeated username
if(getUserInfo($_POST['username'])) {        
    updateUserFail("Username already exists!");
}

    // Password
if($_POST['password'] != $_POST['password_r']) {
    setSessionMessage('passwordError', "Passwords do not match.");
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
        uploadPhoto($user_id, $type, true);
        setSessionMessage('success', 'Successfully updated user.');
        
    } catch (Exception $e) {
        updateUserFail($e->getMessage());
    }

    // Update session if username changed
    if($user_info['username']) {
        $_SESSION['username'] = $user_info['username'];
    }  // Update username session

    // Reload profile
    header("Location: ../pages/profile.php?username=" . $_SESSION['username']);

    ?>
