<?php
    require_once '../pages/session.php';
    require_once '../templates/tpl_utils.php';

    session_unset();
    session_destroy();

    setSessionMessage('success', 'Logged out!');
    header('Location: ../index.php');
?>
