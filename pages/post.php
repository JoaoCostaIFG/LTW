<?php
require_once '../includes/session.php';
if (!$_GET['post_id']) { // go to 404 if there is no post id
  header('Location: 404.php');
}

require_once '../database/queries/db_post.php';
$post = getPost($_GET['post_id']);
if (!isset($post['id'])) {
  die(header('Location: ../pages/list.php'));
}
$title=$post['name'];
require_once '../templates/common/tpl_header.php';

require_once '../templates/tpl_post.php';
$questionsAnswers = getQuestionsAnswers($_GET['post_id']);
drawPost($post, $questionsAnswers);

require_once '../templates/common/tpl_footer.php';
?>
