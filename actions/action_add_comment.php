<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');
    include_once('../database/queries/db_post.php');

    if (!isset($_SESSION['username']))
      die(); // TODO CHANGE LATER

    
    $user_id = getUserId($_SESSION['username'])['id'];
    $post_id = $_GET['post_id'];
    $text = $_GET['comment_text'];

    insertComment($user_id, $post_id, htmlspecialchars($text));

?>
