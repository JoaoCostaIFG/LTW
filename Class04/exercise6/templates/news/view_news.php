<?php
    echo '<article>';
    echo '<header>';
    echo '<h1>' . $article['title'] . '</h1>';
    echo '</header>';
    echo '<img src="https://source.unsplash.com/random" alt="">';
    echo '<p>' . $article['introduction'] . '</p>';
    echo '<p>' . $article['fulltext'] . '</p>';

    include('templates/comments/list_comments.php');
          
    echo '<form>';
    echo '<h2>Add your voice...</h2>';
    echo '<label>Username';
    echo '<input type="text" name="username">';
    echo '</label>';
    echo '<label>E-mail';
    echo '<input type="email" name="email">';
    echo '</label>';
    echo '<label>Comment';
    echo '<textarea name="comment"></textarea>';
    echo '</label>';
    echo '<input type="submit" value="Reply">';
    echo '</form>';
    echo '</section>';

    echo '<footer>';
    echo '<span class="author">' . $article['name'] . '</span>';
    $tags=explode(',', $article['tags']);
    foreach ($tags as $tag) {
      echo '<span class="tags"> #' . $tag . '<a href="index.html">';
    } 
    echo '<span class="date"> ' . gmdate("Y-m-d H:i", $article['published']) . ' ago</span>';
    echo '<a class="comments" href="news_item.php#comments?id=' . $article['id'] . '">' . sizeof($comments) . '</a>';
    echo '</footer>';
    echo '</article>';
?>
