<?php
require_once '../includes/session.php';
require_once '../database/queries/db_user.php';
require_once '../database/queries/db_post.php';
require_once '../actions/action_upload.php';
require_once '../includes/utils.php';


if ($_SERVER["REQUEST_METHOD"] != "POST") {
    setSessionMessage('error', 'Request method not supported');
    die('Location: ../pages/home.php');
  }

if(!isset($_SESSION['username'])) {
    setSessionMessage('error', "Invalid photo!");
    die(header("Location: ../pages/home.php"));
}

if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
    // ERROR: Request does not appear to be legitimate
    setSessionMessage('error', 'This request does not appear to be legitimate');
    die(header('Location: ../pages/home.php'));
}

$post_id = $_POST['post_id'];
$name = treatInputNonEmpty($_POST['name']);
$name = preg_replace("/[^a-zA-Z\s]/", '', $_POST['name']);
$birth_date = treatInputNonEmpty($_POST['birth_date']);
$size = $_POST['size'];
$description = treatInputNonEmpty($_POST['description']);
$state = $_POST['state'];
$color = treatInputNonEmpty($_POST['color']);
$city = $_POST['city'];
if(!isset($post_id)
    || !isset($name)
    || !isset($birth_date)
    || !isset($size)
    || !isset($description)
    || !isset($state)
    || !isset($color)
    || !isset($city)
) {
    setSessionMessage('error', "Failed to edit post!");
    die(header("Location: ../pages/post.php?post_id=$post_id"));
}
$post_info = array($name, $birth_date, $size, $description, $state, $color, $city, $post_id);

// Check if file is not image
if (file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
    $has_photo = true;
    $type = photoIsValid($_FILES['image']['tmp_name']);
    if ($type == null) {
        setSessionMessage('error', "Invalid photo!");
        die(header("Location: ../pages/post.php?post_id=$post_id"));
    }
} else {
    $has_photo = false;
}

$user_id = getUserId($_SESSION['username'])['id'];
if (!ownsPost($user_id, $post_id)) {
    setSessionMessage('error', "User doesn't own this post!");
    die(header("Location: ../pages/post.php?post_id=$post_id"));
}
    

try {
    updatePost($post_info);
    if ($has_photo) {
        $photo_id = getPostPhoto($post_id)['photo_id'];
        updatePhoto($photo_id, $type, false);
    }

    setSessionMessage('success', 'Successfully edited post');
    header("Location: ../pages/post.php?post_id=$post_id");
} catch (PDOException $e) {
    //die($e->getMessage());
    setSessionMessage('error', 'Failed to edit post!');
    die(header("Location: ../pages/post.php?post_id=$post_id"));
}
?>
