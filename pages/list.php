<?php
  include_once('session.php');
  include('../templates/common/tpl_header.php');
  include_once('../templates/tpl_petInfo.php');
  include_once('../templates/tpl_list.php');
?>

<?php
  $filterOptions = getFilterOptions();
  $posts = $filterOptions['posts'];
  $values = $filterOptions['values'];
  drawSearch($values);
  drawPostList($posts);
  include('../templates/common/tpl_footer.php');
?>
