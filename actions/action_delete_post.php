<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');
    include_once('../database/queries/db_post.php');
    include_once('../actions/action_upload.php');

    // Check if file is not image
    $post_id = $_POST['post_id'];
    $user_id = getUserId($_SESSION['username'])['id'];
    if (!ownsPost($user_id, $post_id)) {
        $_SESSION['messages'] = array('type' => 'error', 'content' => "User doesn't own this post!");
        die(header("Location: ../pages/post.php?post_id=$post_id"));
    }
    
    try {
        deletePost($post_id);

        $_SESSION['messages'] = array('type' => 'success', 'content' => 'Successfully deleted post');
        header("Location: ../pages/list.php");
    } catch (PDOException $e) {
        die($e->getMessage());
        $_SESSION['messages'] = array('type' => 'error', 'content' => 'Failed to delete post!');
        die(header("Location: ../pages/post.php?post_id=$post_id"));
    }
?>
