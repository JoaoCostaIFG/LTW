<?php
  require_once '../includes/session.php';
  require_once '../database/queries/db_user.php';

  if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $user_info = getUserInfo($username);
    $is_owner = false;
  }
  else if (isset($_SESSION['username'])) {
    // if no username is given, check current signed in user (if any)
    $username = $_SESSION['username'];
    $user_info = getUserInfo($_SESSION['username']);
    $is_owner = true;
  }
  else {
    die(header('Location: ../pages/list.php'));
  }

  if (!isset($user_info['id']))
    die(header('Location: ../pages/list.php'));

  if ($is_owner) $title = "Your profile";
  else $title = $username . " profile";
  require_once '../templates/common/tpl_header_noimg.php';

  $user_posts = getPostsByUser($username);
  require_once '../templates/tpl_profile.php';
  drawProfile($is_owner, $user_info, $user_posts);

  require_once '../templates/common/tpl_footer.php';
?>
