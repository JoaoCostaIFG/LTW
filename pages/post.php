<?php
  include_once('session.php');
  if (!$_GET['post_id']) // go to 404 if there is no post id
    header('Location: 404.php');

  include('../database/queries/db_post.php');
  include('../templates/common/tpl_header.php');
  include('../templates/tpl_post.php');

  $post = getPost($_GET['post_id']);
  $comments = getComments($_GET['post_id']);
  drawPost($post, $comments);

  if(isset($_SESSION['username'])){
    drawCommentForm($_GET['post_id'], $_SESSION['username']);
  } else {
    drawCommentLoginPrompt();
  }

  include('../templates/common/tpl_footer.php');
?>
