<?php
    include_once('database/connection.php');
    include_once('database/news.php');
    include_once('database/comments.php');
    $article = getArticleById($_GET['id']);
    $comments = getCommentById($_GET['id']);

    include('templates/common/header.php');

    include('templates/news/view_news.php');

    include('templates/common/footer.php');
?>

