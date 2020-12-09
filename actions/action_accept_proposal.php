<?php
  require_once '../includes/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../database/queries/db_proposal.php';
  require_once '../includes/utils.php';


  if(!isset($_GET['user_id']) || !isset($_GET['post_id'])){
    setSessionMessage('error', 'Bad Request');
    die('Location: ../pages/home.php');
  }

    $user_id = $_GET['user_id'];
    $post_id = $_GET['post_id'];
    
try {
    $poster_id = getUserId($_SESSION['username'])['id'];
    if (!isOwner($poster_id, $post_id)) {
        setSessionMessage('error', 'You are not the owner of this post!');
        die('Location: ../pages/home.php');
    }
    acceptProposal($user_id, $post_id);
} catch (PDOException $e) {
    die($e->getMessage());
    setSessionMessage('error', 'Failed to accept proposal!');
    header('Location: ../pages/add_post.php');
}

?>
