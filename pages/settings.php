<?php
  require_once 'session.php';

  if (!isset($_SESSION['username']))
    die(header('Location: 404.php')); 

  include_once('../templates/common/tpl_header_noimg.php');
  include('../templates/tpl_profile.php');
  
  drawSettings();

  include_once('../templates/common/tpl_footer.php');
?>