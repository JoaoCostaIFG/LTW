<?php function drawPostList($posts) {
/**
 * Draws given posts using the draw_post function.
 */
?>

<div class="list">
  <?php 
    foreach($posts as $post)
      drawPostItem($post);
  ?>
</div>

<?php } ?>

<?php function drawPostItem($post) {
/**
 * Draws a given post.
 */ 
  $photo_path = '../static/images/' . $post['photo_path'];
?>
  <a href="<?=$photo_path; ?>" class="list-item">
    <ul class="list-item-content">
      <li class="list-item-img">
        <div style="background: url('<?=$photo_path; ?>')"></div>
      </li>
      <li class="list-item-txt">
        <?=$post['name']; ?>
      </li>
    </ul>
  </a>

<?php } ?>
