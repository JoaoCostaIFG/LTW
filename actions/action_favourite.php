<?php
  require_once '../includes/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../includes/utils.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo 'error';
    die;
}
  
if (!isset($_SESSION['username']) || !isset($_GET['post_id'])) {
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
