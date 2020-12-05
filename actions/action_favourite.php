<?php
  include_once('../pages/session.php');
  include_once('../database/queries/db_user.php');
  
  if (!isset($_SESSION['username']) || !isset($_GET['post_id'])){
    echo 'error';
    die;
  }
  
  $user_id = getUserId($_SESSION['username'])['id'];
  $post_id = $_GET['post_id'];


  try {
    if(isFavourite($user_id, $post_id)) {
        removeFavouritePost($user_id, $post_id);
        echo 'removed';
    } else {
        addFavouritePost($user_id, $post_id);
        echo 'added';
    }
  } catch (PDOException $e) {
    echo 'error';
    die;
  }
?>