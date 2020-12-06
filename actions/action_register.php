<?php
require_once '../pages/session.php';
require_once '../database/queries/db_user.php';
require_once '../actions/action_upload.php';

function registerFail($msg)
{
    $_SESSION['messages'] = array('type' => 'signUpError', 'content' => $msg);
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

    $user_id = insertUser($username, $password, $email, $mobile_number, NULL);
    $img = uploadPhoto($user_id, $type, true);
    $user_info = array(
        'id' => $user_id,
        'picture' => $img,
    );
    updateUser($user_info);

    $_SESSION['username'] = $username;
    $_SESSION['messages'] = array('type' => 'success', 'content' => 'Signed up and logged in!');
    header('Location: ../pages/list.php');
} catch (PDOException $e) {
    registerFail('Failed to signup!');
}
?>
