<?php
require_once '../includes/session.php';
require_once '../templates/common/tpl_header.php';
require_once '../templates/tpl_post.php';

if (!isset($_SESSION['username'])) {
  die(header('Location: list.php'));
}

drawAddPost();

require_once '../templates/common/tpl_footer.php';
?>
