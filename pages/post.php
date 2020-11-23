<?php
  include('../templates/common/tpl_header.php');

  include('../database/db_post.php');
  include('../templates/tpl_post.php');
  $post = getPost($_GET['post_id']);
  $comments = getComments($_GET['post_id']);
  drawPost($post, $comments);

  include('../templates/common/tpl_footer.php');
?>
