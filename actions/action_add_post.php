<?php
require_once '../includes/session.php';
require_once '../database/queries/db_user.php';
require_once '../database/queries/db_post.php';
require_once '../actions/action_upload.php';
require_once '../includes/utils.php';

// TODO check valid locations && species

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    setSessionMessage('error', 'Request method not supported');
    die('Location: ../pages/add_post.php');
}

if(!isset($_SESSION['username'])) {
    setSessionMessage('errorAddPost', 'Not authenticated');
    die(header('Location: ../pages/add_post.php'));
}

if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
    // ERROR: Request does not appear to be legitimate
    setSessionMessage('errorAddPost', 'This request does not appear to be legitimate');
    die(header('Location: ../pages/add_post.php'));
}

// used to track any invalid information
$isInvalid = false;

$name = treatInputNonEmpty($_POST['name']);
$name = preg_replace("/[^a-zA-Z\s]/", '', $name);
if (!isset($name)) {
    $isInvalid = true;
}

$birth_date = treatInputNonEmpty($_POST['birth_date']);
if (!isset($birth_date)) {
    $isInvalid = true;
}

$gender = $_POST['gender'];
if (!isset($gender)) {
    $isInvalid = true;
}

$size = $_POST['size'];
if (!isset($size)) {
    $isInvalid = true;
}

$state = treatInputNonEmpty($_POST['state']);
if (!isset($state)) {
    $isInvalid = true;
}

$description = treatInputNonEmpty($_POST['description']);
if (!isset($description)) {
    $isInvalid = true;
}

$color = treatInputNonEmpty($_POST['color']);
if (!isset($color)) {
    $isInvalid = true;
}

$species = treatInputNonEmpty($_POST['species']);
if (!isset($species)) {
    $isInvalid = true;
}

$city = treatInputNonEmpty($_POST['city']);
if (!isset($city)) {
    $isInvalid = true;
}

// Check if file is image
$type = photoIsValid($_FILES['image']['tmp_name']);
if (!$type) {
    $isInvalid = true;
}

if($isInvalid) {
    setSessionMessage('errorAddPost', 'Failed to add post!');
    die(header('Location: ../pages/add_post.php'));
}

$user_id = getUserId($_SESSION['username'])['id'];
$post_info = array($name, $birth_date, $gender, $state, $description, $state, $color,
    $species, $city, $user_id);

try {
    $post_id = insertPost($post_info);
    uploadPhoto($post_id, $type, false);

    setSessionMessage('success', 'Successfully added post');
    header("Location: ../pages/post.php?post_id=$post_id");
} catch (PDOException $e) {
    //die($e->getMessage());
    setSessionMessage('errorAddPost', 'Failed to add post!');
    die(header('Location: ../pages/add_post.php'));
}
?>
