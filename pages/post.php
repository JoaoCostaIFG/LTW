<?php
  require_once 'session.php';
if (!$_GET['post_id']) { // go to 404 if there is no post id
    header('Location: 404.php');
}
  $title="Post " . $_GET['post_id'];
  require '../templates/common/tpl_header.php';

  require '../database/queries/db_post.php';
  require '../templates/tpl_post.php';
  $post = getPost($_GET['post_id']);
  // $comments = getComments($_GET['post_id']);
  $questionsAnswers = getQuestionsAnswers($_GET['post_id']);
  drawPost($post, $questionsAnswers);

  if(isset($_SESSION['username'])){
    // drawCommentForm($_GET['post_id'], $_SESSION['username']);
    drawQuestionForm($_GET['post_id']);
  } else {
    drawQuestionsLoginPrompt();
  }

  require '../templates/common/tpl_footer.php';
?>
