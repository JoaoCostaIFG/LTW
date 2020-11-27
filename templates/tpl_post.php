<?php function drawPost($post, $comments) {
/**
 * Draws given a given post page
 */
?>

    <h2>
      <b><?php echo $post['name']; ?></b> </br>
      for adoption from <b><?php echo $post['user']; ?></b>
    </h2>
    <div class="petpost-img" style="background: url(../static/images/<?php echo $post['photo_path']; ?>) no-repeat center /auto 100%"></div>
    <ul class="petpost">
      <li>Name: <b><?php echo $post['name']; ?></b></li>
      <li>Age: <b><?php echo $post['age']; ?></b></li>
      <li>Breed: <b><?php echo $post['species']; ?></b></li>
      <li>Genre: <b><?php echo $post['gender']; ?></b></li>
      <li>Size: <b><?php echo $post['size']; ?></b></li>
      <li>Location: <b><?php echo $post['location']; ?></b></li>
    </ul>

    <br>
    <br>
    <br>

    <?php echo $post['date']; ?> <br>
    
    <?php echo $post['description']; ?>

    <?php
    foreach($comments as $comment) {
        echo '<br>';
        drawComment($comment);
    }
    ?>
<?php } ?>

<?php function drawComment($comment) {
/**
 * Draws given a comment
 */
?>
    <h2> <?php echo $comment['date']; ?> </h2>
    <h2> <?php echo $comment['username']; ?> </h2>
    <p> <?php echo $comment['text']; ?> </p>
<?php } ?>
