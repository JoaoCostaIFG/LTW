<?php
  include_once('../pages/session.php');
  include_once('../database/queries/db_user.php');
  include_once('../database/queries/db_post.php');
  include_once('../templates/tpl_post.php');

  if (!isset($_SESSION['username']) || !isset($_GET['post_id']) || !isset($_GET['question_text'])){
    echo '<p id="question-error">An error ocurred.</p>';
    die;
  }
  
  $text = $_GET['question_text'];
  if ($text == ""){
    echo '<p id="question-error">An error ocurred.</p>';
    die;
  }
  
  $user_id = getUserId($_SESSION['username'])['id'];
  $post_id = $_GET['post_id'];
  $safe_text = htmlspecialchars($text);

  try {
    insertQuestion($user_id, $post_id, $safe_text);
  } catch (PDOException $e) {
    echo '<p id="question-error">An error ocurred.</p>';
    die;
  }

  $question = [
    "question" => $safe_text,
    "question_date" => date("d/m/Y"),
    "user_id" => $user_id
  ];

  //The response is used by js to draw the question
  drawQuestionAnswer($post_id, $_SESSION['username'], $question);
?>
