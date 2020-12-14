<?php
    require_once '../includes/session.php';
    require_once '../database/queries/db_user.php';
    require_once '../database/queries/db_post.php';
    require_once '../actions/action_upload.php';
    require_once '../includes/utils.php';

  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Content-Type: application/json');
    if (!isset($_GET['id'])) {
      $posts = getPosts(array(), array(), "");
      if(!isset($posts)){
          die(json_encode(array('error' => 'posts_not_found')));
      }
      echo json_encode($posts);
    } else {
      $post_id = $_GET['id'];
      $post = getPost($post_id);
      if(!isset($post)){
          die(json_encode(array('error' => 'post_not_found')));
      }
      echo json_encode($post);
    }
  } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(!isset($_SESSION['username'])){
        echo 'Request failed: Not authenticated';
        die();
    }

    $type = photoIsValid($_FILES['image']['tmp_name']);
    if (!$type) {
        echo 'Request failed';
        die();
    }
    if(!isset($_POST['name'])){
        echo 'Request failed: name is not defined';
        die();
    }
    if(!isset($_POST['birth_date'])){
        echo 'Request failed: birth_date is not defined';
        die();
    }
    if(!isset($_POST['gender'])){
        echo 'Request failed: gender is not defined';
        die();
    }
    if(!isset($_POST['size'])){
        echo 'Request failed: size is not defined';
        die();
    }
    if(!isset($_POST['description'])){
        echo 'Request failed: description is not defined';
        die();
    }
    if(!isset($_POST['color'])){
        echo 'Request failed: color is not defined';
        die();
    }
    if(!isset($_POST['species'])){
        echo 'Request failed: species is not defined';
        die();
    }
    if(!isset($_POST['city'])){
        echo 'Request failed: city is not defined';
        die();
    }

    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    $color = $_POST['color'];
    $species = $_POST['species'];
    $city = $_POST['city'];
    $user_id = getUserId($_SESSION['username'])['id'];
    $post_info = array($name, $birth_date, $gender, $size, $description, $color,
        $species, $city, $user_id);
    
    try {
        $post_id = insertPost($post_info);
        uploadPhoto($post_id, $type, false);

        echo 'Request successful';
    } catch (Exception $e) {
        echo 'Request failed';
    }
  }

?>
