<?php
require_once '../includes/session.php';
require_once '../includes/utils.php';
require_once '../database/queries/db_proposal.php';
require_once '../database/queries/db_user.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    setSessionMessage('error', 'This request method in not supported');
    die(header('Location: ../pages/home.php'));
}

$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];
if(!isset($user_id) || !isset($post_id)) {
    setSessionMessage('error', 'Bad Request');
    die('Location: ../pages/home.php');
}

if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
    // ERROR: Request does not appear to be legitimate
    setSessionMessage('error', 'This request does not appear to be legitimate');
    die(header('Location: ../pages/add_post.php'));
}
    
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
