<?php function drawPost($post, $comments) {
/**
 * Draws given a given post page
 */
?>
    <h1> <?php echo $post['name']; ?> </h1>
    <?php
    echo $post['age'];
    echo $post['gender'];
    echo $post['size'];
    echo $post['description'];
    echo $post['date'];
    echo $post['color_name'];
    echo $post['species_name'];
    echo $post['city_name'];
    echo $post['owner_name'];
    ?>
    <?php
    foreach($comments as $comment) 
        echo '<br>';
        drawComment($comment);
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
