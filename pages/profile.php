<?php
  require_once 'session.php';

if (!isset($_SESSION['username'])) {
    die(header('Location: 404.php'));
} 

  require_once '../templates/common/tpl_header_noimg.php';
  require '../database/queries/db_user.php';
  require '../templates/tpl_profile.php';

  $username = $_GET['username'];
  $user_info = getUserInfo($username);
  $user_posts = getPostsByUser($username);
  
  drawProfile($user_info, $user_posts);

  require_once '../templates/common/tpl_footer.php';
?>
