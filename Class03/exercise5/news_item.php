<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Super Legit News</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
    <link href="responsive.css" rel="stylesheet">
    <link href="comments.css" rel="stylesheet">
    <link href="forms.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <h1><a href="index.html">Super Legit News</a></h1>
      <h2><a href="index.html">Where fake news are born!</a></h2>
      <div id="signup">
        <a href="register.html">Register</a>
        <a href="login.html">Login</a>
      </div>
    </header>
    <nav id="menu">
      <!-- just for the hamburguer menu in responsive layout -->
      <input type="checkbox" id="hamburger"> 
      <label class="hamburger" for="hamburger"></label>

      <ul>
        <li><a href="index.html">Local</a></li>
        <li><a href="index.html">World</a></li>
        <li><a href="index.html">Politics</a></li>
        <li><a href="index.html">Sports</a></li>
        <li><a href="index.html">Science</a></li>
        <li><a href="index.html">Weather</a></li>
      </ul>
    </nav>
    <aside id="related">
      <article>
        <h1><a href="#">Duis arcu purus</a></h1>
        <p>Etiam mattis convallis orci eu malesuada. Donec odio ex, facilisis ac blandit vel, placerat ut lorem. Ut id sodales purus. Sed ut ex sit amet nisi ultricies malesuada. Phasellus magna diam, molestie nec quam a, suscipit finibus dui. Phasellus a.</p>
      </article>        
      <article>
        <h1><a href="#">Sed efficitur interdum</a></h1>
        <p>Integer massa enim, porttitor vitae iaculis id, consequat a tellus. Aliquam sed nibh fringilla, pulvinar neque eu, varius erat. Nam id ornare nunc. Pellentesque varius ipsum vitae lacus ultricies, a dapibus turpis tristique. Sed vehicula tincidunt justo, vitae varius arcu.</p>
      </article>
      <article>
        <h1><a href="#">Vestibulum congue blandit</a></h1>
        <p>Proin lectus felis, fringilla nec magna ut, vestibulum volutpat elit. Suspendisse in quam sed tellus fringilla luctus quis non sem. Aenean varius molestie justo, nec tincidunt massa congue vel. Sed tincidunt interdum laoreet. Vivamus vel odio bibendum, tempus metus vel.</p>
      </article>
    </aside>
    <section id="news">
      <article>

<?php
    $db = new PDO('sqlite:news.db');

    $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = :id');
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $article = $stmt->fetch();

    $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
    $stmt->execute(array($_GET['id']));
    $comments = $stmt->fetchAll();

    echo '<header>';
    echo '<h1>' . $article['title'] . '</h1>';
    echo '</header>';
    echo '<img src="http://lorempixel.com/600/300/business/" alt="">';
    echo '<p>' . $article['introduction'] . '</p>';
    echo '<p>' . $article['fulltext'] . '</p>';

    echo '<section id="comments">';
    echo '<h1>' . sizeof($comments) . 'Comments</h1>';
    foreach ($comments as $comment) {
      echo '<article class="comment">';
      echo '<span class="user">' . $comment['username'] . '</span>';
      echo '<span class="date">' . gmdate("Y-m-d H:i", $article['published']) . ' ago</span>';
      echo '<p>' . $comment['text'] . '</p>';
      echo '</article>';
    }
          
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
    echo '<span class="tags"> ' . $article['tags'] . '<a href="index.html">';
    echo '<span class="date"> ' . gmdate("Y-m-d H:i", $article['published']) . ' ago</span>';
    echo '<a class="comments" href="news_item.php#comments?id=' . $article['id'] . '">' . sizeof($comments) . '</a>';
    echo '</footer>';
?>

      </article>
    </section>
    <footer>
      <p>&copy; Fake News, 2017</p>
    </footer>
  </body>
</html>
