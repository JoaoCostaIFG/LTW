<?php
  require_once '../includes/session.php';
  require_once '../includes/utils.php';
  require_once '../actions/action_upload.php';
  require_once '../database/queries/db_user.php';

function registerFail($msg)
{
  setSessionMessage('signUpError', $msg);
  die(header('Location: ../pages/register.php'));
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  registerFail("Request method not supported");
}

// user info
$username = treatInputNonEmpty($_POST['username']);
if (!isset($username)) {
  registerFail("Need a username!");
}
if (!preg_match("/^[0-9a-zA-Z\s_\-]+$/", $username)) {
  registerFail("Username can only contain letters, numbers, spaces, underscores and dashes!");
}

if(getUserInfo($username)) {        
  registerFail("Username already taken.");
}

$email = treatInputNonEmpty($_POST['email']);
if (!isset($email)) {
  registerFail("Need an email address!");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  registerFail("The given email address is invalid!");
}
$mobile_number = treatInputNonEmpty($_POST['mobile_number']);
if (!isset($mobile_number)) {
  registerFail("Need a mobile number!");
}
if (!isValidMobileNumber($mobile_number)) {
  registerFail("Mobile number can only contain numbers, spaces, pluses and dashes!");
}

// password

if(!isset($_POST['password']) || !isset($_POST['password_r'])){
  registerFail("Password fields are required");
}

$password = $_POST['password'];
$password_r = $_POST['password_r'];
if (strlen($password) < 5) {
  registerFail("Passwords need to be at least 5 chars long!");
}
if ($password != $password_r) { // check is passwords are equal
  registerFail("Passwords don't match!");
}

$type = photoIsValid($_FILES['image']['tmp_name']);
if (!$type) { // check if the given image is jpeg/png
  registerFail("The given image is not valid!");
}

try {
  $user_id = insertUser($username, $password, $email, $mobile_number, typeToString($type));
  uploadPhoto($user_id, $type, true);

  $_SESSION['username'] = $username;
  setSessionMessage('success', 'Signed up and logged in!');
  header('Location: ../pages/list.php');
} catch (PDOException $e) {
  registerFail('Failed to signup!');
}
?>
