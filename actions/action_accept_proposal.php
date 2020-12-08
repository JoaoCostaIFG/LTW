<?php
  require_once '../includes/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../database/queries/db_proposal.php';
  require_once '../includes/utils.php';

    $user_id = $_GET['user_id'];
    $post_id = $_GET['post_id'];
    $poster_id = getUserId($_SESSION['username'])['id'];
if (!isOwner($poster_id, $post_id)) {
    setSessionMessage('error', 'You are not the owner of this post!');
    die('Location: ../pages/home.php');
}

try {
    acceptProposal($user_id, $post_id);
} catch (PDOException $e) {
    die($e->getMessage());
    setSessionMessage('error', 'Failed to accept proposal!');
    header('Location: ../pages/add_post.php');
}

?>
