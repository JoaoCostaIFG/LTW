<?php
  // include_once('database/connection.php');
  // include_once('database/news.php');
  // $animals = getAllAnimals();

  include_once('session.php');
  include('../templates/common/tpl_header.php');
?>

<form class="listfilter" action="" method="post">
  <br>
  <input type="text" name="name" placeholder="Name">
  <input type="text" name="sex" placeholder="Sex">
  <input type="text" name="age" placeholder="Age">
  <input type="text" name="size" placeholder="Size">
  <input type="text" name="breed" placeholder="Breed">
  <input type="text" name="location" placeholder="Location">

  <br>
  <input type="submit" value="Search">
</form>

<?php
  include('../templates/tpl_list.php');
  include('../database/queries/db_post.php');
  $posts = getAllPosts();
  drawPostList($posts);
  include('../templates/common/tpl_footer.php');
?>

