<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_proposal.php');
    include_once('../database/queries/db_user.php');


    $curr_user_id = getUserId($_SESSION['username'])['id'];
    if ($curr_user_id != $_GET['user_id']) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'You are not logged in as this user!');
        die('Location: ../pages/home.php');
    }
    
    insertProposal($_GET['user_id'], $_GET['post_id']);
    header("Location: /pages/post.php?post_id=" . $_POST['post_id']);
?>
