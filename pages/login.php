<?php
require_once '../includes/session.php';
$title="Sign In";
require_once '../templates/common/tpl_header_noimg.php';
require_once '../templates/tpl_auth.php';

if (isset($_SESSION['username'])) {
  // N sei o q isto esta a fazer aqui, mas deixei pq copia do rest
  die(header('Location: list.php'));
}

draw_login();

require_once '../templates/common/tpl_footer.php';
?>
