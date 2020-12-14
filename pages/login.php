<?php
require_once '../includes/session.php';

if (isset($_SESSION['username'])) {
  die(header('Location: ../pages/list.php'));
}

$title="Sign In";
require_once '../templates/common/tpl_header.php';
require_once '../templates/tpl_auth.php';

draw_login();

require_once '../templates/common/tpl_footer.php';
?>
