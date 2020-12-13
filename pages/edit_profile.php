<?php
require_once '../includes/session.php';

if (!isset($_SESSION['username']))
  die(header('Location: 404.php')); 

require_once '../templates/common/tpl_header.php';
require_once '../database/queries/db_user.php';
require_once '../templates/tpl_profile.php';

$user = getUserInfo($_SESSION['username']);

drawEditProfile($user);

require_once '../templates/common/tpl_footer.php';
?>
