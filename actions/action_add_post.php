<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');
    include_once('../database/queries/db_post.php');
    include_once('../actions/action_upload.php');

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
        uploadPetPhoto($post_id, $type);

        $_SESSION['messages'][] = array('type' => 'success', 'content' => 'Successfully added post');
        header("Location: ../pages/post.php?post_id=$post_id");
    } catch (PDOException $e) {
        // die($e->getMessage()); // TODO is this ok here?
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add post!');
        die(header('Location: ../pages/add_post.php'));
    }
?>
