<?php
  require_once '../includes/session.php';
  require_once '../includes/utils.php';
  require_once '../actions/action_upload.php';
  require_once '../database/queries/db_user.php';

  // TODO email taken message

function updateUserFail($msg)
{
  setSessionMessage('updateUserError', $msg);
  die(header("Location: ../pages/edit_profile.php"));
}

function updateSettingsFail($msg)
{
  setSessionMessage('passwordError', $msg);
  die(header("Location: ../pages/settings.php"));
}

// Get user information to update
$user_id = getUserId($_SESSION['username'])['id'];
$username = treatInputNonEmpty($_POST['username']);
$email = treatInputNonEmpty($_POST['email']);
$mobile_number = treatInputNonEmpty($_POST['mobile_number']);
$password = $_POST['password'];
if(!isset($username) && !isset($email) && !isset($mobile_number) && !isset($password))
  updateUserFail("You need to specify at least one field to be changed.");

$user_info = array('id' => $user_id, 'email' => $email,
  'mobile_number' => $mobile_number, 'password' => $password,
  'username' => $username);

if(isset($user_info['username'])) {
  // Check for repeated username
  if(getUserInfo($user_info['username'])) {        
    updateUserFail("Username already exists!");
  }
}
if(isset($user_info['password'])) {
  // when changing pass, current pass is checked
  if(!isset($_POST['current_password'])) {
    updateSettingsFail("Please specify the current password.");
  }
  if(checkUserPassword($_SESSION['username'], $_POST['current_password']) == false) {
    updateSettingsFail("Current password is incorrect.");
  }
  if($password != $_POST['password_r']) {
    updateSettingsFail("Passwords do not match.");
  }
  if(strlen($password) < 5)
    updateSettingsFail("Passwords is too small (needs at least 5 chars).");
}


$type = photoIsValid($_FILES['image']['tmp_name']);
try {
  updateUser($user_info);
  uploadPhoto($user_id, $type, true);
  setSessionMessage('success', 'Successfully updated user.');
} catch (Exception $e) {
  updateUserFail("Changing info failed.");
}

// Update session if username changed
if(isset($user_info['username'])) {
  $_SESSION['username'] = $user_info['username'];
}  // Update username session

// Go back to own profile
header("Location: ../pages/profile.php");
?>
