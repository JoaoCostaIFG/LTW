<?php
require_once '../templates/tpl_petInfo.php';
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

function drawPost($post, $questionsAnswers)
{
    /**
     * Draws given a given post page
     */
    $photo_path = "../static/images/" . $post['photo_id'] . "." . $post['photo_extension'];
    ?>

<div class="petpost-page">
  <?php 
    if(isset($_SESSION['username'])){
      $current_user = getUserId($_SESSION['username'])['id'];
      if (!hasProposal($current_user, $post['id']) && !isOwner($current_user, $post['id'])) { ?>
      
       <form method="post" action="../actions/action_make_proposal.php">
       <input type="hidden" name="user_id" value="<?php echo $current_user; ?>">
       <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
            <input type="submit" value="Make pet proposal">
       </form>
    <?php }?>
<?php
    }
?>

  <h2>
    <b><?php echo $post['name']; ?></b> </br>
    for adoption from <b><?php echo $post['user']; ?></b>
  </h2>

  <div class="petpost">
    <div class="petpost-img" >
      <!--Need to add if -->
<?php if(isset($_SESSION['username'])){ ?>
        <script src="../js/favourite.js" type="text/javascript" defer></script>
        <button id="favourite-star" onclick="favourite(<?php echo $post['id']?>)">
<?php     if(isFavourite($current_user, $post['id'])){?>
            &bigstar;
        <?php } else {?>
            &star;
        <?php }?>
      </button>
<?php }?>
      <div style="background: url(<?php echo $photo_path; ?>) no-repeat center /auto 100%"></div>
    </div>
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

  <h3>Questions & Answers</h3>
  <section id="petpost-questions">
<?php
  if(isset($_SESSION['username'])){
    drawQuestionsAnswers($current_user, $questionsAnswers);
  } else {
    drawQuestionsAnswers(NULL, $questionsAnswers);
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


<?php function drawQuestionForm($post_id) {?>
  <script src="../js/add_question.js" type="text/javascript" defer></script>
  <section id="question-input">
    <textarea name="question_text" rows="2" column="40" placeholder="Write your question..." required></textarea>
    <button id="question-input-button" type="button" onclick="addQuestion(<?php echo $post_id?>)">Post Question</button>
  </section>
<?php } ?>

<?php function drawQuestionsLoginPrompt() { ?>
  <section id="question-input">
    <p id="question-login-prompt">Log in to post questions</p>
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

<?php function drawQuestionAnswer($user_id, $questionAnswer)
{
    ?>
    <section class="QA">
        <section class="petpost-question">
            <p> <?php echo 'Q: ' . $questionAnswer['question']; ?> </p>
            <p> <?php echo $questionAnswer['question_date'] . ", " . getUsername($questionAnswer['id']); ?> </p>
            <?php if(isset($_SESSION['username'])) {
                      if(getUserId($_SESSION['username'])['id'] == $user_id && $questionAnswer['answer'] == NULL){
                        ?> <button>Answer</button>
                <?php }
                    }?>
        </section>

        <?php if(isset($questionAnswer['answer'])) { ?>
          <section class="petpost-answer">
              <p> <?php echo 'A: ' . $questionAnswer['answer']; ?> </p>
              <p> <?php echo $questionAnswer['answer_date'] ?> </p>
          </section>
        <?php } ?>
    </section>
<?php } ?>

<?php function drawQuestionsAnswers($username, $questionsAnswers) {

  if($username != NULL){
    $user_id = getUserId($username);
  } else {
    $user_id = NULL;
  }
  $cnt=0;
  foreach($questionsAnswers as $questionAnswer) {
    $cnt=$cnt + 1;
    drawQuestionAnswer($user_id, $questionAnswer);
    echo '<br>';
  }
  if ($cnt == 0){
    echo "<i id='no-questions'>There are no questions on this post. Make the first question</i>";
  }
}?>

