<?php
require_once '../includes/session.php';
require_once '../includes/utils.php';
require_once '../actions/action_upload.php';
require_once '../database/queries/db_user.php';
require_once '../database/queries/db_post.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Content-Type: application/json');
    if (!isset($_GET['username'])) {
        $posts = getAllUsers();
        if(!isset($posts)) {
            die(json_encode(array('error' => 'users_not_found')));
        }
        echo json_encode($posts);
    } else {
        $username = $_GET['username'];
        $user = getUserInfo($username);
        if(!isset($user)) {
            die(json_encode(array('error' => 'user_not_found')));
        }
        echo json_encode($user);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = treatInputNonEmpty($_POST['username']);
    if(!isset($username)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: username is not defined/invalid'));
        die;
    }
    $type = photoIsValid($_FILES['image']['tmp_name']);
    if (!isset($type)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: photo is not defined/invalid'));
        die;
    }
    $email = treatInputNonEmpty($_POST['email']);
    if(!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: email is not defined/invalid'));
        die;
    }
    $mobile_number = treatInputNonEmpty($_POST['mobile_number']);
    if(!isset($mobile_number) || !isValidMobileNumber($mobile_number)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: mobile_number is not defined/invalid'));
        die;
    }
    $password = $_POST['password'];
    if (!isset($password)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: password is not defined/invalid'));
        die;
    }
    
    try {
        $user_id = insertUser($username, $password, $email, $mobile_number, typeToString($type));
        uploadPhoto($user_id, $type, true);
        http_response_code(204);
        echo json_encode(array('message' => 'Success: user created.'));
    } catch (Exception $e) {
        http_response_code(503);
        echo json_encode(array('message' => 'Request failed: user could not be created
          (some information might already be in sue by another user).'));
    }
}
?>
