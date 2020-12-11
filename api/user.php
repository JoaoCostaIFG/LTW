<?php
    require_once '../includes/session.php';
    require_once '../database/queries/db_user.php';
    require_once '../database/queries/db_post.php';
    require_once '../actions/action_upload.php';
    require_once '../includes/utils.php';

  function verify_session() {
    if (!isset($_SESSION['username']))
        die(json_encode(array('error' => 'user not logged in')));
  }

  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Content-Type: application/json');
    if (!isset($_GET['username'])) {
      $posts = getAllUsers();
      if(!isset($posts)){
          die(json_encode(array('error' => 'users_not_found')));
      }
      echo json_encode($posts);
    } else {
      $username = $_GET['username'];
      $user = getUserInfo($username);
      if(!isset($user)){
          die(json_encode(array('error' => 'user_not_found')));
      }
      echo json_encode($user);
    }
  } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $type = photoIsValid($_FILES['image']['tmp_name']);
    if (!$type) {
        echo 'Request failed';
        die();
    }
    if(!isset($_POST['username'])){
        echo 'Request failed: username is not defined';
        die();
    }
    if(!isset($_POST['password'])){
        echo 'Request failed: password is not defined';
        die();
    }
    if(!isset($_POST['email'])){
        echo 'Request failed: email is not defined';
        die();
    }
    if(!isset($_POST['mobile_number'])){
        echo 'Request failed: mobile_number is not defined';
        die();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    
    try {
      $user_id = insertUser($username, $password, $email, $mobile_number, typeToString($type));
      uploadPhoto($user_id, $type, true);

        echo 'Request successful';
    } catch (Exception $e) {
        echo 'Request failed';
        die($e->getMessage());
    }
  }

?>
