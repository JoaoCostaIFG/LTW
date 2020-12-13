<?php
require_once '../includes/session.php';
require_once '../database/queries/db_proposal.php';
require_once '../database/queries/db_user.php';
require_once '../includes/utils.php';

if(!isset($_SESSION['username'])){
    setSessionMessage('error', 'Not autheticated');
    die('Location: ../pages/home.php');
}

// TODO how to pass csrf here?
// if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
    // // ERROR: Request does not appear to be legitimate
    // setSessionMessage('error', 'This request does not appear to be legitimate');
    // die(header('Location: ../pages/add_post.php'));
// }

if(!isset($_GET['user_id'])){
    setSessionMessage('error', 'Failed to make proposal');
    die('Location: ../pages/home.php');
}

$curr_user_id = getUserId($_SESSION['username'])['id'];
if ($curr_user_id != $_GET['user_id']) {
    setSessionMessage('error', 'You are not logged in as this user!');
    die('Location: ../pages/home.php');
}
    insertProposal($_GET['user_id'], $_GET['post_id']);
    header("Location: /pages/post.php?post_id=" . $_POST['post_id']);
?>
