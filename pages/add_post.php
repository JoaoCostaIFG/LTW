<?php
    include_once('session.php');
    include('../templates/tpl_post.php');
?>
    
<?php
    if (!isset($_SESSION['username']))
      die(header('Location: list.php'));

    drawAddPost();
?>
