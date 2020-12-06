<?php
    include_once('../pages/session.php');

    session_unset();
    session_destroy();

    $_SESSION['messages'] = array('type' => 'success', 'content' => 'Logged out!');
    header('Location: ../index.php');
?>
