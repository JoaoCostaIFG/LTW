<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');
    include_once('../database/queries/db_proposal.php');

    $user_id = $_GET['user_id'];
    $post_id = $_GET['post_id'];
    $poster_id = getUserId($_SESSION['username'])['id'];
    if (!isOwner($poster_id, $post_id)) {
        $_SESSION['messages'] = array('type' => 'error', 'content' => 'You are not the owner of this post!');
        die('Location: ../pages/home.php');
    }

    try {
        rejectProposal($user_id, $post_id);
    } catch (PDOException $e) {
        $_SESSION['messages'] = array('type' => 'error', 'content' => 'Failed to reject proposal!');
        die(header('Location: ../pages/add_post.php'));
    }

?>
