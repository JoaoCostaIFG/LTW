<?php
  require_once '../pages/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../database/queries/db_post.php';
  require_once '../actions/action_upload.php';
  require_once '../templates/tpl_utils.php';

    // Check if file is not image
    $post_id = $_POST['post_id'];
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
    setSessionMessage('error', 'Failed to delete post!');
    die(header("Location: ../pages/post.php?post_id=$post_id"));
}
?>
