<?php
    require_once '../includes/session.php';
    require_once '../database/queries/db_user.php';
    require_once '../database/queries/db_post.php';
    require_once '../includes/utils.php';

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
        setSessionMessage('success', 'Successfully added post');
        header('Location: ../pages/list.php');
    } catch (PDOException $e) {
        setSessionMessage('error', 'Failed to add post!');
        die(header('Location: ../pages/add_post.php'));
    }
    ?>
