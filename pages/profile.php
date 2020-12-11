<?php
  require_once '../includes/session.php';

$username="";
if (isset($_GET['username'])) {
  $username=$_GET['username'];
}
else if (isset($_SESSION['username'])) {
  // if no username is given, check current signed in user (if any)
  $username=$_SESSION['username'];
}
else {
  die(header('Location: ../pages/list.php'));
}

  require '../database/queries/db_user.php';
  $user_info = getUserInfo($username);
  if (!isset($user_info['id'])) {
    die(header('Location: ../pages/list.php'));
  }

  require_once '../templates/common/tpl_header_noimg.php';

  require '../templates/tpl_profile.php';
  $user_posts = getPostsByUser($username);
  
  drawProfile($user_info, $user_posts);

  require_once '../templates/common/tpl_footer.php';
?>
