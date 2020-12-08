<?php
    require_once '../includes/session.php';
    require_once '../includes/utils.php';

    session_unset();
    session_destroy();

    setSessionMessage('success', 'Logged out!');
    header('Location: ../index.php');
?>
