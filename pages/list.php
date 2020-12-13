<?php
require_once '../includes/session.php';
$title="List";
require_once '../templates/common/tpl_header.php';

require_once '../templates/tpl_list.php';
$filterOptions = getFilterOptions();
$posts = $filterOptions['posts'];
$values = $filterOptions['values'];
drawSearch($values);
drawPostList($posts);

require_once '../templates/common/tpl_footer.php';
?>

