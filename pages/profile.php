<?php
  
  if (!$_GET['username']){    
    die(header('Location: 404.php')); // Cannot load user profile
  }

  include_once('../templates/common/tpl_header_noimg.php');
  include('../database/queries/db_user.php');
  include('../templates/tpl_profile.php');

  $user = getUserPublicInfo($_GET['username']);
  $user_posts = getPostsByUser($_GET['username']);
  
  drawProfile($user, $user_posts);

  include_once('../templates/common/tpl_footer.php');
?>