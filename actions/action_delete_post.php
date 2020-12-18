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
    setSessionMessage('error', "Not authenticated!");
    die(header("Location: ../pages/home.php"));
}

if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
    // ERROR: Request does not appear to be legitimate
    setSessionMessage('error', 'This request does not appear to be legitimate');
    die(header('Location: ../pages/home.php'));
}

$post_id = $_POST['post_id'];
if(!isset($post_id)) {
    setSessionMessage('error', "Failed to delete post!");
    die(header("Location: ../pages/home.php"));
}

// Check if file is not image
$user_id = getUserId($_SESSION['username'])['id'];
if (!ownsPost($user_id, $post_id)) {
    setSessionMessage('error', "User doesn't own this post!");
    die(header("Location: ../pages/post.php?post_id=$post_id"));
}
    
try {
    deletePost($post_id);

    setSessionMessage('success', 'Successfully deleted post');
    header("Location: ../pages/list.php");
} catch (PDOException $e) {
    die($e->getMessage());
    setSessionMessage('error', 'Failed to delete post!');
    die(header("Location: ../pages/post.php?post_id=$post_id"));
}
?>
