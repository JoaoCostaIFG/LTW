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
      <li>Age: <b>
<?php
  $years=intdiv($post['age'], 12);
  $months=$post['age'] % 12;
  if ($years == 0) {
    if ($months != 0)
      echo $months . " months old";
    else
      echo "0 years old";
  }
  else {
    echo $years . " years";
    if ($months != 0)
      echo " and " . $months . " months old";
    else
      echo " old";
  }
?>
      </b></li>
      <li>Breed: <b><?php echo $post['species']; ?></b></li>
      <li>Genre: <b>
<?php
  if ($post['gender'] == 0)
    echo "Male";
  else
    echo "Female";
?>
      </b></li>
      <li>Size: <b>
<?php
  if ($post['size'] == 1)
    echo "Small";
  else if ($post['size'] == 2)
    echo "Medium";
  else
    echo "Big";
?></b></li>
      <li>Location: <b><?php echo $post['location']; ?></b></li>
    </ul>

    <br>
    <br>

    <?php echo $post['date']; ?>
    
    <div class="petpost-description">
      <?php echo $post['description']; ?>
    </div>

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
