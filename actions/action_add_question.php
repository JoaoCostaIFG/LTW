<?php
  require_once '../includes/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../database/queries/db_post.php';
  require_once '../templates/tpl_post.php';

if (!isset($_SESSION['username']) || !isset($_POST['post_id']) || !isset($_POST['question_text'])) {
  echo '<p id="question-error">An error ocurred.</p>';
  die;
}

if ($_SESSION['csrf'] !== $_POST['csrf']) {
  // ERROR: Request does not appear to be legitimate
  echo '<p id="question-error">An error ocurred.</p>';
  die;
}

  
  $text = $_POST['question_text'];
if ($text == "") {
  echo '<p id="question-error">An error ocurred.</p>';
  die;
}
  
  $user_id = getUserId($_SESSION['username'])['id'];
  $post_id = $_POST['post_id'];
  $safe_text = $text;

try {
    $question_id = insertQuestion($user_id, $post_id, $safe_text);
    
} catch (PDOException $e) {
    echo '<p id="question-error">An error ocurred.</p>';
    die;
}

  $question = [
    "question" => $safe_text,
    "question_date" => date("d/m/Y"),
    "user_id" => $user_id,
    "id" => $question_id
  ];

  //The response is used by js to draw the question
  drawQuestionAnswer($post_id, $user_id, $question);
    ?>
