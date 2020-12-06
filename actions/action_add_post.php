<?php
  require_once '../pages/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../database/queries/db_post.php';
  require_once '../actions/action_upload.php';
  require_once '../templates/tpl_utils.php';

    // Check if file is not image
    $type = photoIsValid($_FILES['image']['tmp_name']);
if (!$type) {
    die(header('Location: ../pages/add_post.php'));
}

    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $color = $_POST['color'];
    $species = $_POST['species'];
    $city = $_POST['city'];
    $user_id = getUserId($_SESSION['username'])['id'];
    $post_info = array($name, $age, $gender, $size, $description, $date,
        $color, $species, $city, $user_id);

    try {
        $post_id = insertPost($post_info);
        uploadPhoto($post_id, $type, false);

        setSessionMessage('success', 'Successfully added post');
        header("Location: ../pages/post.php?post_id=$post_id");
    } catch (PDOException $e) {
        setSessionMessage('error', 'Failed to add post!');
        die(header('Location: ../pages/add_post.php'));
    }
    ?>
