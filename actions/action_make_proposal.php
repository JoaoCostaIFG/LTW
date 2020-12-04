<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_proposal.php');
    
    insertProposal($_POST['user_id'], $_POST['post_id']);
    header("Location: /pages/post.php?post_id=" . $_POST['post_id']);
?>
