<?php
require_once '../includes/session.php';
require_once '../database/queries/db_user.php';
require_once '../database/queries/db_post.php';
require_once '../templates/tpl_post.php';

// TODO check if user is owner for safety
  
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo '<p id="question-error">An error ocurred.</p>';
    die;
}

if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
    // ERROR: Request does not appear to be legitimate
    echo '<p id="question-error">An error ocurred.</p>';
    die;
}

$answer_id = $_POST['answer_id'];
$answer_text = treatInputNonEmpty($_POST['answer_text']);
if (!isset($_SESSION['username']) || !isset($answer_id) || !isset($answer_text)) {
    echo '<p id="answer-error">An error ocurred.</p>';
    die;
}

$user_id = getUserId($_SESSION['username'])['id'];
if (!isAnswerOwner($answer_id, $user_id)) {
    echo '<p id="answer-error">You are not the owner of this question.</p>';
    die;
}

try {
    updateAnswer($answer_id, $answer_text);
} catch (PDOException $e) {
    echo '<p id="answer-error">An error ocurred.</p>';
    die;
}

// The response is used by js to draw the updated answer
echo ('A: ' . nl2br(htmlspecialchars($answer_text)));
?>

