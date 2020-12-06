<?php
  require_once '../pages/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../actions/action_upload.php';
  require_once '../templates/tpl_utils.php';

function registerFail($msg)
{
    setSessionMessage('signUpError', $msg);
    die(header('Location: ../pages/register.php'));
}

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_r = $_POST['password_r'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];

    // TODO Verify regex password and username here

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
