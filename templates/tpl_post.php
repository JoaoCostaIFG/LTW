<?php
include_once('../templates/tpl_petInfo.php');
include_once('../database/queries/db_proposal.php');

/* GETTERS */

function ageToString($age) {
  $years=intdiv($age, 12);
  $months=$age % 12;

  $ret="";
  if ($years == 0) {
    if ($months != 0)
      $ret=$months . " months old";
    else
      $ret="0 years old";
  }
  else {
    $ret=$years . " years";
    if ($months != 0)
      $ret=$ret . " and " . $months . " months old";
    else
      $ret=$ret . " old";
  }
  return $ret;
}

function genderToString($gender) {
  if ($gender == 0)
    return "Male";
  else
    return "Female";
}

function sizeToString($size) {
  if ($size == 1)
    return "Small";
  else if ($size == 2)
    return "Medium";
  else
    return "Big";
}

/* DRAWERS */

function drawPost($post, $comments) {
/**
 * Draws given a given post page
 */
?>
  <div class="petpost-page">

  <?php 
    $current_user = $_SESSION['username'];
    $post = $_POST['post'];
    if (hasProposal($current_user, $post['id']))
        die('asd');

?>
   <form method="post" action="../actions/action_make_proposal.php">
   <input type="hidden" name="current_user" value="<?php echo $_SESSION['username']; ?>">
   <input type="hidden" name="post" value="<?php echo $post['id']; ?>">
        <input type="submit" value="Make pet proposal">
   </form>

  <h2>
    <b><?php echo $post['name']; ?></b> </br>
    for adoption from <b><?php echo $post['user']; ?></b>
  </h2>
  <div class="petpost-img" style="background: url(../static/images/<?php echo $post['photo_path']; ?>) no-repeat center /auto 100%"></div>
  <ul class="petpost">
    <li>Name: <b><?php echo $post['name']; ?></b></li>
    <li>Age: <b><?php echo ageToString($post['age']); ?></b></li>
    <li>Breed: <b><?php echo $post['species']; ?></b></li>
    <li>Genre: <b><?php echo genderToString($post['gender']); ?></b></li>
    <li>Size: <b><?php echo sizeToString($post['size']); ?></b></li>
    <li>Location: <b><?php echo $post['location']; ?></b></li>
    <li>Posted in: <b><?php echo $post['date']; ?></b></li>
  </ul>

  <br>
  <br>
  
  <h3>Description</h3>
  <div class="petpost-description">
    <p> <?php echo $post['description']; ?> </p>
  </div>

  <h3>Comments</h3>
<?php
  $cnt=0;
  foreach($comments as $comment) {
    $cnt=$cnt + 1;
    drawComment($comment);
    echo '<br>';
  }
  if ($cnt == 0)
    echo "<i>There are no comments on this post. Be the first one</i>";
?>

</div>
<?php } ?>

<?php function drawComment($comment) {
/**
 * Draws given a comment
 */
?>
  <div class="petpost-comment" >
    <p><?php echo $comment['text']; ?></p>
    <p><?php echo $comment['date'] . ", " . $comment['username']; ?></p>
  </div>
<?php } ?>

<?php function drawAddPost() { 
/** TODO Meter min e max's
 * Draws a form to add a post
 */
?>
    <section id="addPost">
        <header><h2>Create a new Post</h2></header>

        <form method="post" action="../actions/action_add_post.php">
            <p>Name <input type="text" name="name" placeholder="name of the pet" required></p>
            <p>Age<input type="number" name="age" placeholder="age of the pet" required></p>

            <p> <?php drawGendersRadio() ?> </p>
            <p>Size<input type="number" name="size" placeholder="size" required></p>
            <p>Description<textarea id="description" name="description" rows="4" cols="50"> </textarea></p>
            <p>Date<input type="date" name="date" placeholder="date of birth of your pet" required></p>

            
            <p><?php drawColors(false, null); ?> </p>
            <p><?php drawSpecies(false, null); ?> </p>
            <p><?php drawCities(false, null); ?> </p>
            <p><input type="submit" value="Add pet"></p>
        </form>
    </section>

<?php } ?>

