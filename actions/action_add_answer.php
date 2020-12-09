<?php
  require_once '../includes/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../database/queries/db_post.php';
  require_once '../templates/tpl_post.php';

  if (!isset($_SESSION['username']) || !isset($_GET['question_id']) || !isset($_GET['answer_text'])) {
      echo '<p id="answer-error">An error ocurred.</p>';
      die;
  }
    
    $text = $_GET['answer_text'];
  if ($text == "") {
      echo '<p id="answer-error">An error ocurred.</p>';
      die;
  }
    
  $user_id = getUserId($_SESSION['username'])['id'];
  $question_id = $_GET['question_id'];
  $safe_text = $text;

  try {
      insertAnswer($user_id, $question_id, $safe_text);
  } catch (PDOException $e) {
      echo '<p id="answer-error">An error ocurred.</p>';
      die;
  }

  $answer = [
    "answer" => $safe_text,
    "answer_date" => date("d/m/Y")
  ];

  //The response is used by js to draw the answer
  drawAnswer($answer);
?>
