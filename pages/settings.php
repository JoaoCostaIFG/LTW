<?php
require_once '../includes/session.php';

if (isset($_SESSION['username'])) {
  die(header('Location: ../pages/list.php'));
}

$title="Settings";
require_once '../templates/common/tpl_header.php';
require_once '../templates/tpl_profile.php';

drawSettings();

require_once '../templates/common/tpl_footer.php';
?>
