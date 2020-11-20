<?php function draw_posts($posts) {
/**
 * Draws given posts using the draw_post function.
 */ ?>

<div class="list">
  <?php 
    foreach($posts as $post)
      draw_post($post);
  ?>
</div>

<?php } ?>

<?php function draw_post($post) {
/**
 * Draws a given post.
 */ 
  $photo_path = '../static/images/' . $post['photo_path'];
  ?>
 <a href="<?=$photo_path; ?>" class="list-item">
    <ul class="list-item-content">
    <li><img src="<?=$photo_path; ?>" alt="<?=$post['name']; ?>'s photo"/></li>
      <li><?=$post['name']; ?></li>
    </ul>
  </a>

<?php } ?>
