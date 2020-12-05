<?php
  require_once 'session.php';

  if (!isset($_SESSION['username']))
    die(header('Location: 404.php')); 

  include_once('../templates/common/tpl_header_noimg.php');
  include('../database/queries/db_user.php');
  include('../templates/tpl_profile.php');

  $username = $_GET['username'];
  $user = getUserInfo($username);
  $user_posts = getPostsByUser($username);
  
  drawProfile($user, $user_posts);

  include_once('../templates/common/tpl_footer.php');
?>