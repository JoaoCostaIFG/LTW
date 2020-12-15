<?php
require_once '../includes/session.php';
require_once '../database/queries/db_user.php';
require_once '../database/queries/db_post.php';
require_once '../templates/tpl_post.php';
  
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo '<p id="question-error">An error ocurred.</p>';
    die;
}

if (!isset($_POST['csrf']) || $_SESSION['csrf'] !== $_POST['csrf']) {
    // ERROR: Request does not appear to be legitimate
    echo '<p id="question-error">An error ocurred.</p>';
    die;
}

$question_id = $_POST['question_id'];
$answer_text = treatInputNonEmpty($_POST['answer_text']);
if (!isset($_SESSION['username']) || !isset($question_id) || !isset($answer_text)) {
    echo '<p id="answer-error">An error ocurred.</p>';
    die;
}
    
$user_id = getUserId($_SESSION['username'])['id'];
try {
    insertAnswer($user_id, $question_id, $answer_text);
} catch (PDOException $e) {
    echo '<p id="answer-error">An error ocurred.</p>';
    die;
}

$answer = [
  "answer" => $answer_text,
  "answer_date" => date("d/m/Y")
];

// The response is used by js to draw the answer
drawAnswer($answer);
?>
