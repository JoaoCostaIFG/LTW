<?php
require_once '../templates/tpl_petInfo.php';
require_once '../templates/tpl_utils.php';
include_once('../database/queries/db_proposal.php');
include_once('../database/queries/db_user.php');

/* GETTERS */

function ageToString($age)
{
    $years=intdiv($age, 12);
    $months=$age % 12;

    $ret="";
    if ($years == 0) {
        if ($months != 0) {
            $ret=$months . " months old";
        } else {
            $ret="0 years old";
        }
    }
    else {
        $ret=$years . " years";
        if ($months != 0) {
            $ret=$ret . " and " . $months . " months old";
        } else {
            $ret=$ret . " old";
        }
    }
    return $ret;
}

function genderToString($gender)
{
    if ($gender == 0) {
        return "Male";
    } else {
        return "Female";
    }
}

function sizeToString($size)
{
    if ($size == 1) {
        return "Small";
    } else if ($size == 2) {
        return "Medium";
    } else {
        return "Big";
    }
}

/* DRAWERS */

function drawPost($post, $comments)
{
    /**
     * Draws given a given post page
     */
    ?>

<div class="petpost-page">
  <?php 
    if(isset($_SESSION['username'])){
      $current_user = getUserId($_SESSION['username'])['id'];
      $post_id = $post['id'];
      if (!hasProposal($current_user, $post_id) && !isOwner($current_user, $post_id)) { ?>
            <script src="../js/utils.js" type="text/javascript" defer></script>
            <script src="../js/proposal.js" type="text/javascript" defer></script>

            <button id="makeProposalButton" onclick="make_proposal(<?php echo "$post_id, $current_user";?>)">
                Make Proposal</button>
            <p id="proposalSentText"></p>
    <?php }
      else if (hasProposal($current_user, $post_id)) {
            $status = getProposalStatus($current_user, $post_id)['status'];

            if ($status == -1)
                $text = "Your Proposal is Pending";
            else if ($status == 0)
                $text = "Your Proposal was Rejected";
            else if ($status == 1)
                $text = "Your Proposal was Accepted";
            ?>
            <p id="proposalSentText"><?php echo $text; ?></p>
    <?php
      }

    }
?>

  <h2>
    <b><?php echo $post['name']; ?></b> </br>
    for adoption from <b><?php echo $post['user']; ?></b>
  </h2>

  <div class="petpost">
    <?php drawPetPhoto($post['photo_id'], $post['photo_extension'], "petpost-img"); ?>
    <ul class="petpost-info">
      <li>Name: <b><?php echo $post['name']; ?></b></li>
      <li>Age: <b><?php echo ageToString($post['age']); ?></b></li>
      <li>Breed: <b><?php echo $post['species']; ?></b></li>
      <li>Genre: <b><?php echo genderToString($post['gender']); ?></b></li>
      <li>Size: <b><?php echo sizeToString($post['size']); ?></b></li>
      <li>Location: <b><?php echo $post['location']; ?></b></li>
      <li>Posted in: <b><?php echo $post['date']; ?></b></li>
    </ul>
  </div>

  <h3>Description</h3>
  <div class="petpost-description">
    <p> <?php echo $post['description']; ?> </p>
  </div>

  <h3>Comments</h3>
  <section id="comments">
<?php
  $cnt=0;
  foreach($comments as $comment) {
    $cnt=$cnt + 1;
    drawComment($comment);
    echo '<br>';
  }
  if ($cnt == 0){
    echo "<i id='no-comments'>There are no comments on this post. Be the first one</i>";
  }

?>
  </section>


</div>
<?php } ?>

<?php function drawComment($comment)
{
    /**
     * Draws given a comment
     */
    ?>
  <div class="petpost-comment" >
    <p><?php echo $comment['text']; ?></p>
    <p><?php echo $comment['date'] . ", " . $comment['username']; ?></p>
  </div>
<?php } ?>


<?php function drawCommentForm($post_id, $username) {
/**
 * Draws given a comment
 */
?>
  <script src="../js/utils.js" type="text/javascript" defer></script>
  <script src="../js/add_comment.js" type="text/javascript" defer></script>
  <section id="comment-input">
    <textarea name="comment_text" rows="2" column="40" placeholder="Write your comment..." required></textarea>
    <button id="comment-input-button" type="button" onclick="addComment(<?php echo $post_id?>)">Comment</button>
  </section>
<?php } ?>

<?php function drawCommentLoginPrompt() { ?>
  <section id="comment-input">
    <p id="comment-login-prompt">Log in to comment</p>
  </section>
<?php }?>

<?php function drawAddPost()
{ 
    /**
 * TODO Meter min e max's
     * Draws a form to add a post
     */
    ?>
    <section id="addPost">
        <header><h2>Create a new Post</h2></header>

        <form method="post" action="../actions/action_add_post.php" enctype="multipart/form-data">
            <p>Name <input type="text" name="name" placeholder="name of the pet" required></p>
            <p>Age<input type="number" name="age" placeholder="age of the pet" required></p>

            <label>Photo
                <input type="file" name="image">
            </label>

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

