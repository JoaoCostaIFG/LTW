<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');
    include_once('../database/queries/db_post.php');

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
        insertPost($post_info);
        $_SESSION['messages'] = array('type' => 'success', 'content' => 'Successfully added post');
        header('Location: ../pages/list.php');
    } catch (PDOException $e) {
        $_SESSION['messages'] = array('type' => 'error', 'content' => 'Failed to add post!');
        die(header('Location: ../pages/add_post.php'));
    }
?>
