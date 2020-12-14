<?php
    require_once '../includes/session.php';
    require_once '../database/queries/db_user.php';
    require_once '../database/queries/db_proposal.php';
    require_once '../includes/utils.php';


    if(!isset($_SESSION['username'])){
        setSessionMessage('error', 'Not authenticated');
        die('Location: ../pages/home.php');
    }

    if (!isset($_SESSION['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
        // ERROR: Request does not appear to be legitimate
        setSessionMessage('error', 'This request does not appear to be legitimate');
        die(header('Location: ../pages/add_post.php'));
    }

    if(!isset($_POST['user_id']) ||
        !isset($_POST['post_id'])
    ){
        setSessionMessage('error', 'Bad request');
        die('Location: ../pages/home.php');
    }

    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $poster_id = getUserId($_SESSION['username'])['id'];
if (!isOwner($poster_id, $post_id)) {
    setSessionMessage('error', 'You are not the owner of this post!');
    die('Location: ../pages/home.php');
}

try {
    rejectProposal($user_id, $post_id);
} catch (PDOException $e) {
    setSessionMessage('error', 'Failed to reject proposal!');
    die(header('Location: ../pages/add_post.php'));
}

?>
