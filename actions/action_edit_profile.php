<?php
  require_once '../includes/session.php';
  require_once '../includes/utils.php';
  require_once '../actions/action_upload.php';
  require_once '../database/queries/db_user.php';

  // TODO email taken message
  // TODO email, mobile number, etc matching is repeated code with register action

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

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  setSessionMessage('error', 'Request method not supported');
  die('Location: ../pages/home.php');
}

if (!isset($_POST['csrf']) || ($_SESSION['csrf'] !== $_POST['csrf'])) {
  // ERROR: Request does not appear to be legitimate
  setSessionMessage('error', 'Bad request: csrf not defined');
  die(header("Location: ../pages/profile.php"));
}

// Get user information to update
$user_id = getUserId($_SESSION['username'])['id'];
$username = treatInputNonEmpty($_POST['username']);
$email = treatInputNonEmpty($_POST['email']);
$mobile_number = treatInputNonEmpty($_POST['mobile_number']);
$password = $_POST['password'];
$sent_image =  file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name']);

if(!isset($username) && !isset($email) && !isset($mobile_number) && !isset($password) && !$sent_image)
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
if(isset($user_info['email'])) {
  if (!filter_var($user_info['email'], FILTER_VALIDATE_EMAIL)) {
    updateUserFail("The given email address is invalid!");
  }
}
if (isset($user_info['mobile_number'])) {
  if (!isValidMobileNumber($user_info['mobile_number'])) {
    updateUserFail("Mobile number can only contain numbers, spaces, pluses and dashes!");
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

if ($sent_image) {
  $type = photoIsValid($_FILES['image']['tmp_name']);
  if ($type == null)
      updateSettingsFail("Invalid photo format");
}

try {
  if ($type) {
    $user_info['extension'] = typeToString($type);
    uploadPhoto($user_id, $type, true);
  }
  updateUser($user_info);

  setSessionMessage('success', 'Successfully updated user.');
} catch (Exception $e) {
  //die($e->getMessage());
  updateUserFail("Changing info failed.");
}

// Update session if username changed
if(isset($user_info['username'])) {
  $_SESSION['username'] = $user_info['username'];
}  // Update username session

// Go back to own profile
header("Location: ../pages/profile.php");
?>
