<?php
    require_once '../includes/session.php';
    require_once '../database/queries/db_user.php';
    require_once '../database/queries/db_post.php';
    require_once '../actions/action_upload.php';
    require_once '../includes/utils.php';

    if(!isset($_SESSION['username'])){
        setSessionMessage('error', 'Not authenticated');
        die(header('Location: ../pages/add_post.php'));
    }

    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        // ERROR: Request does not appear to be legitimate
        setSessionMessage('error', 'This request does not appear to be legitimate');
        die(header('Location: ../pages/add_post.php'));
    }

    if(!isset($_POST['name']) ||
        !isset($_POST['birth_date']) ||
        !isset($_POST['gender']) ||
        !isset($_POST['size']) ||
        !isset($_POST['description']) ||
        !isset($_POST['color']) ||
        !isset($_POST['species']) ||
        !isset($_POST['city'])
    ){
        setSessionMessage('error', 'Failed to add post!');
        die(header('Location: ../pages/add_post.php'));
    }

    // Check if file is not image
    $type = photoIsValid($_FILES['image']['tmp_name']);
    if (!$type) {
        die(header('Location: ../pages/add_post.php'));
    }

    $name = preg_replace("/[^a-zA-Z\s]/", '', $_POST['name']);
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $size = $_POST['size'];
    $description = htmlspecialchars($_POST['description']);
    $color = $_POST['color'];
    $species = $_POST['species'];
    $city = $_POST['city'];
    $user_id = getUserId($_SESSION['username'])['id'];
    $post_info = array($name, $birth_date, $gender, $size, $description, $color,
        $species, $city, $user_id);

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
