<?php
require_once 'session.php';
require '../templates/common/tpl_header_noimg.php';
require '../templates/tpl_post.php';

if (!isset($_SESSION['username'])) {
    die(header('Location: list.php'));
}

drawAddPost();

require '../templates/common/tpl_footer.php';
?>
