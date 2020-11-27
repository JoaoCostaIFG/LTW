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
 * using /100% on background favors portait frame (vertical) photos
 * using /auto 100% seems to favor most photos
 */ 
  $photo_path = '../static/images/' . $post['photo_path'];
  $post_path = 'post.php?post_id=' . $post['post_id'];
?>
  <a href="<?=$post_path; ?>" class="list-item">
    <ul class="list-item-content">
      <li class="list-item-img">
        <div style="background: url('<?=$photo_path; ?>') no-repeat center /auto 100%"></div>
      </li>
      <li class="list-item-txt">
        <?=$post['name']; ?>
      </li>
    </ul>
  </a>

<?php } ?>
