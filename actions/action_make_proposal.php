<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_proposal.php');
    insertProposal($current_user, $post);
?>
