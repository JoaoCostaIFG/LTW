<?php
  require_once '../includes/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../actions/action_upload.php';
  require_once '../includes/utils.php';

function registerFail($msg)
{
    setSessionMessage('signUpError', $msg);
    die(header('Location: ../pages/register.php'));
}

    $username = htmlspecialchars($_POST['username']);
    if(isset($_POST['password'])){
        if(strlen($_POST['password']) < 5){
            registerFail("Password needs to be at least 5 characters long");
            die(header("Location: ../pages/settings.php"));
        }
    } else {
        $password = $_POST['username'];
    }

    $password_r = $_POST['password_r'];

    if(isset($_POST['email'])) {
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email = $_POST['email'];
        } else {
            updateUserFail("Invalid email");
        }
    } else {
        $email = $_POST['email'];
    }


    if(isset($_POST['mobile_number'])) {
        $mobile_number = preg_replace("/[^0-9+ \-]/",'', $_POST['mobile_number']);
    } else {
        $mobile_number = $_POST['mobile_number'];
    }

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
