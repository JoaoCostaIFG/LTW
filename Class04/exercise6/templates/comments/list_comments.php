<?php
    echo '<section id="comments">';
    echo '<h1>' . sizeof($comments) . 'Comments</h1>';
    foreach ($comments as $comment) {
      echo '<article class="comment">';
      echo '<span class="user">' . $comment['username'] . '</span>';
      echo '<span class="date">' . gmdate("Y-m-d H:i", $article['published']) . ' ago</span>';
      echo '<p>' . $comment['text'] . '</p>';
      echo '</article>';
    }
?>
