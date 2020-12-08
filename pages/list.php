<?php
  require_once '../includes/session.php';
  $title="List";
  require '../templates/common/tpl_header.php';
  require_once '../templates/tpl_petInfo.php';
  require_once '../templates/tpl_list.php';
?>

<?php
  $filterOptions = getFilterOptions();
  $posts = $filterOptions['posts'];
  $values = $filterOptions['values'];
  drawSearch($values);
  drawPostList($posts);
  require '../templates/common/tpl_footer.php';
?>

