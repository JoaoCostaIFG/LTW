<?php
  foreach ($articles as $article) {
    echo '<article>';
    echo '<header>';
    echo '<h1><a href="news_item.php?id=' . $article['id'] . '">' . $article['title'] . '</a></h1>';
    echo '</header>';
    echo '<img src="https://source.unsplash.com/random" alt="">';
    echo '<p>' . $article['introduction'] . '</p>';
    echo '<p>' . $article['fulltext'] . '</p>';

    echo '<footer>';
    echo '<span class="author">' . $article['name'] . '</span>';
    echo '<span class="tags"> ' . $article['tags'] . ' <a href="index.html">';
    echo '<span class="date">' . gmdate("Y-m-d H:i", $article['published']) . ' ago</span>';
    echo '<a class="comments" href="news_item.php#comments?id=' . $article['id'] . '">' . $article['comments'] . '</a>';
    echo '</footer>';

    echo '</article>';
  }
?>
