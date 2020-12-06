<?php
require_once '../templates/tpl_petInfo.php';
require_once '../templates/tpl_utils.php';
require_once('../database/queries/db_proposal.php');
require_once('../database/queries/db_user.php');

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
    $photo_path = "../static/images/" . $post['photo_id'] . "." . $post['photo_extension'];
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
    <div class="petimage petpost-img" >
      <!--Need to add if -->
    <?php if(isset($_SESSION['username'])) { ?>
        <script src="../js/favourite.js" type="text/javascript" defer></script>
        <button id="favourite-star" onclick="favourite(<?php echo $post['id']?>)">
        <?php     if(isFavourite($current_user, $post['id'])) {?>
            &bigstar;
        <?php } else {?>
            &star;
        <?php }?>
      </button>
    <?php }?>
      <div style="background: url(<?php echo $photo_path; ?>) no-repeat center /auto 100%"></div>
    </div>
    <ul class="petpost-info nobullets">
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
    if ($cnt == 0) {
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


<?php function drawCommentForm($post_id)
{
    /**
     * Draws given a comment
     */
    ?>
  <script src="../js/utils.js" type="text/javascript" defer></script>
  <script src="../js/add_comment.js" type="text/javascript" defer></script>

  <div id="comment-input">
    <textarea id="comment-input-ta" name="comment_text" rows="1" column="40"
      placeholder="Write your comment..." maxlength="256" required></textarea>
    <button id="comment-input-button" type="button" onclick="addComment(<?php echo $post_id?>)">Comment</button>
  </div>

  <script type="text/javascript">
    // see: https://stackoverflow.com/questions/7745741/auto-expanding-textarea/24824750#24824750
    var textarea = document.getElementById("comment-input-ta");
    var limitRows = 5;
    var messageLastScrollHeight = textarea.scrollHeight;

    textarea.oninput = function() {
      var rows = parseInt(textarea.getAttribute("rows"));
      // If we don't decrease the amount of rows, the scrollHeight would show the scrollHeight for all the rows
      // even if there is no text.
      textarea.setAttribute("rows", "1");

      if (rows < limitRows && textarea.scrollHeight > messageLastScrollHeight) {
          rows++;
      } else if (rows > 1 && textarea.scrollHeight < messageLastScrollHeight) {
          rows--;
      }

      messageLastScrollHeight = textarea.scrollHeight;
      textarea.setAttribute("rows", rows);
    };
  </script>
<?php } ?>

<?php function drawCommentLoginPrompt()
{
    ?>
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

    <form class="verticalform addpostform" method="post" action="../actions/action_add_post.php" enctype="multipart/form-data">
      <div class="form-item addpostform-item" >
        <label for="name">Name</label>
        <input id="name" type="text" name="name" placeholder="name of the pet" required>
      </div>
      <div class="form-item addpostform-item" >
        <label for="age">Age</label>
        <input id="age" type="number" name="age" placeholder="age of the pet" required>
      </div>
      <div class="form-item addpostform-item" >
        <label for="image">Photo</label>
        <input id="image" type="file" name="image" required>
      </div>

      <div class="form-item listfilter-item" >
        <?php drawGendersRadio() ?>
      </div>

      <div class="form-item addpostform-item" >
        <label for="size">Size</label>
        <input id="size" type="number" name="size" placeholder="size" required>
      </div>
      <div class="form-item addpostform-item" >
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="8" cols="86"></textarea>
      </div>
      <div class="form-item addpostform-item" >
        <label for="date">Birth date</label>
        <input id="date" type="date" name="date" placeholder="date of birth of your pet" required>
      </div>

      <div class="form-item addpostform-item" >
        <?php drawColors(false, null); ?>
      </div>
      <div class="form-item addpostform-item" >
        <?php drawSpecies(false, null); ?>
      </div>
      <div class="form-item addpostform-item" >
        <?php drawCities(false, null); ?>
      </div>

      <br>
      <input class="form-button addpostform-button" type="submit" value="Add pet">
    </form>
  </section>
<?php } ?>

