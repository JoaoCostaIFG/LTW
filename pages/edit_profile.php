<?php
require_once '../includes/session.php';

if (!isset($_SESSION['username'])) {
  die(header('Location: ../pages/list.php'));
}

$title="Edit profile";
require_once '../templates/common/tpl_header.php';

require_once '../database/queries/db_user.php';
$user = getUserInfo($_SESSION['username']);

require_once '../templates/tpl_profile.php';
drawEditProfile($user);

require_once '../templates/common/tpl_footer.php';
?>
