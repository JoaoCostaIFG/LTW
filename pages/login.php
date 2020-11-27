<?php
  include_once('session.php');
  include_once('../templates/common/tpl_header_noimg.php');
  include_once('../templates/tpl_auth.php');

  if (isset($_SESSION['username']))
      die(header('Location: list.php')); // N sei o q isto esta a fazer aqui, mas deixei pq copia do rest

  draw_login();

  include_once('../templates/common/tpl_footer.php');
?>
