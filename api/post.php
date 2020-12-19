<?php
require_once '../includes/session.php';
require_once '../includes/utils.php';
require_once '../actions/action_upload.php';
require_once '../database/queries/db_user.php';
require_once '../database/queries/db_post.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Content-Type: application/json');
    if (!isset($_GET['id'])) {
        $posts = getPosts(array(), array(), "");
        if(!isset($posts)) {
            http_response_code(204);
            echo json_encode(array('message' => 'No content'));
        }
        else {
            http_response_code(200);
            echo json_encode($posts);
        }
    } else {
        $post_id = $_GET['id'];
        $post = getPost($post_id);
        if(!isset($post)) {
            http_response_code(404);
            echo json_encode(array('message' => 'Post not found'));
        }
        http_response_code(200);
        echo json_encode($post);
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_SESSION['username'])) {
        http_response_code(401);
        echo json_encode(array('message' => 'Request failed: Not authenticated'));
        die;
    }

    if (!isset($_FILES['image']['tmp_name'])) {
      $isInvalid = true;
    }
    else {
      $type = photoIsValid($_FILES['image']['tmp_name']);
      if (!$type) {
          http_response_code(400);
          echo json_encode(array('message' => 'Request failed: photo is not defined/invalid'));
          die;
      }
    }
    $name = treatInputNonEmpty($_POST['name']);
    if(!isset($name)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: name is not defined/invalid'));
        die;
    }
    $birth_date = treatInputNonEmpty($_POST['birth_date']);
    if(!isset($birth_date)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: birth_date is not defined/invalid'));
        die;
    }
    $gender = $_POST['gender'];
    if(!isset($gender)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: gender is not defined/invalid'));
        die;
    }
    $size = $_POST['size'];
    if(!isset($size)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: size is not defined/invalid'));
        die;
    }
    $description = treatInputNonEmpty($_POST['description']);
    if(!isset($description)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: description is not defined/invalid'));
        die;
    }
    $description = htmlentities($description, ENT_QUOTES);
    $color = treatInputNonEmpty($_POST['color']);
    if(!isset($color)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: color is not defined/invalid'));
        die;
    }
    $species = treatInputNonEmpty($_POST['species'];)
    if(!isset($species)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: species is not defined/invalid'));
        die;
    }
    $city = treatInputNonEmpty($_POST['city']);
    if(!isset($city)) {
        http_response_code(400);
        echo json_encode(array('message' => 'Request failed: city is not defined/invalid'));
        die;
    }

    $user_id = getUserId($_SESSION['username'])['id'];
    $post_info = array($name, $birth_date, $gender, $size, $description, $color,
      $species, $city, $user_id);
    
    try {
        $post_id = insertPost($post_info);
        uploadPhoto($post_id, $type, false);
        http_response_code(204);
        echo json_encode(array('message' => 'Success: post created.'));
    } catch (Exception $e) {
        http_response_code(503);
        echo json_encode(array('message' => 'Request failed: Request was OK but server failed.'));
    }
}
else {
    http_response_code(501);
    echo json_encode(array('message' => 'Request failed: request method not recognized/implemented'));
    die;
}
?>
