<?php
require_once '../includes/session.php';
$title="Sign In";
require_once '../templates/common/tpl_header.php';
require_once '../templates/tpl_auth.php';

if (isset($_SESSION['username'])) {
  die(header('Location: ../pages/list.php'));
}

draw_login();

require_once '../templates/common/tpl_footer.php';
?>
