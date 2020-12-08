<?php
  require_once '../includes/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../actions/action_upload.php';
  require_once '../includes/utils.php';

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
if(isset($_POST['current_password'])) {
    if(checkUserPassword($_SESSION['username'], $_POST['current_password']) == false) {
        setSessionMessage('passwordError', "Current password is incorrect.");
        die(header("Location: ../pages/settings.php"));
    }
    if($_POST['password'] != $_POST['password_r']) {
        setSessionMessage('passwordError', "Passwords do not match.");
        die(header("Location: ../pages/settings.php"));
    }
}

// Get user information to update
$user_id = getUserId($_SESSION['username'])['id'];

$user_info = array('id' => $user_id, 'email' => null, 'mobile_number' => null,
  'password' => null, 'username' => null);
if(isset($_POST['email'])) {
    $user_info['email'] = $_POST['email'];
}
if(isset($_POST['mobile_number'])) {
    $user_info['mobile_number'] = $_POST['mobile_number'];
}
if(isset($_POST['password'])) {
    $user_info['password'] =  $_POST['password'];
}
if(isset($_POST['username'])) {
    $user_info['username'] = $_POST['username'];
}

$type = photoIsValid($_FILES['image']['tmp_name']);
try {
    updateUser($user_info);
    uploadPhoto($user_id, $type, true);
    setSessionMessage('success', 'Successfully updated user.');
} catch (Exception $e) {
    updateUserFail($e->getMessage());
}

// Update session if username changed
if(isset($user_info['username'])) {
    $_SESSION['username'] = $user_info['username'];
}  // Update username session

// Reload profile
header("Location: ../pages/profile.php?username=" . $_SESSION['username']);
?>
