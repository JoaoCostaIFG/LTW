<?php
require_once '../templates/tpl_petInfo.php';
require_once '../templates/tpl_utils.php';
require_once '../database/queries/db_proposal.php';
require_once '../database/queries/db_user.php';

/* GETTERS */

function ageToString($age_days)
{
    $months = intdiv($age_days, 30);
    $age_days = $age_days % 12;
    $years = intdiv($months, 12);
    $months = $months % 12;

    $ret = "";
    if ($years == 0) {
        if ($months != 0) {
            $ret = $months . " month(s) old";
            if ($age_days != 0) {
              $ret .= " and " . $age_days . " day(s) old";
            }
        } else {
            $ret = "$age_days day(s) old";
        }
    } else {
        $ret = $years . " year(s)";
        if ($months != 0) {
            $ret = $ret . " and " . $months . " month(s) old";
        } else {
            $ret = $ret . " old";
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

function proposalStatusToString($status)
{
    if ($status == -1) {
        $text = "Your Proposal is Pending";
    } else if ($status == 0) {
        $text = "Your Proposal was Rejected";
    } else if ($status == 1) {
        $text = "Your Proposal was Accepted";
    }
    return $text;
}

/* DRAWERS */

function drawProposalButton($post_id, $user_id)
{
    ?>
    <script src="../js/confirmation_bar.js" type="text/javascript" defer></script>
    <script src="../js/utils.js" type="text/javascript" defer></script>
    <script src="../js/proposal.js" type="text/javascript" defer></script>

    <button id="makeProposalButton" onclick="make_proposal_confirmation(<?php echo "$post_id, $user_id";?>)">
        Make Proposal</button>
    <p id="proposalSentText"></p>
<?php }

function drawProposalStatus($status)
{
    ?>
    <p id="proposalSentText"><?php echo proposalStatusToString($status); ?></p>
<?php }

function drawEditButtons($post_id)
{
    ?>
    <script src="../js/utils.js" type="text/javascript" defer></script>
    <script src="../js/edit_post.js" type="text/javascript" defer></script>

    <button id="editButton" onclick="edit_post()">
        Edit Post</button>

    <form class="deleteButton" method="post" action="../actions/action_delete_post.php">
      <input type="hidden" id="post_id" name="post_id" value="<?php echo $post_id; ?>">
      <input class="form-button addpostform-button" type="submit" value="Remove post">
    </form>
<?php }

function drawEditOptions($post)
{
    ?>
    <div class="petpost-edit" style="display: none">
        
        <form class="verticalform addpostform" method="post" action="../actions/action_edit_post.php" enctype="multipart/form-data">
          <div class="form-item addpostform-item" >
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="<?php echo $post['name']; ?>" required>
          </div>

          <div class="form-item addpostform-item" >
            <label for="birth_date">Birth Date</label>
            <input id="birth_date" max="<?php echo date('Y-m-d'); ?>" type="date" name="birth_date" value="<?php echo $post['birth_date']; ?>" required>
          </div>
          <div class="form-item addpostform-item" >
            <label for="image">Photo</label>
            <input id="image" type="file" name="image" onchange="edit_photo(event)">
          </div>

          <div class="form-item addpostform-item" >
            <?php drawSizes(false, $post['size']); ?>
          </div>
          <div class="form-item addpostform-item" >
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="1" cols="80" maxlength="2000">
              <?php echo $post['description']; ?>
            </textarea>
          </div>

          <div class="form-item addpostform-item" >
            <?php drawColors(false, $post['color_id']); ?>
          </div>
          <div class="form-item addpostform-item" >
            <?php drawCities(false, $post['city_id']); ?>
          </div>

          <br>
          <input type="hidden" id="post_id" name="post_id" value="<?php echo $post['id']; ?>">
          <input class="form-button addpostform-button" type="submit" value="Update pet">
        </form>
    </div>
<?php }

function drawPost($post, $questionsAnswers)
{
    /**
     * Draws given a given post page
     */
    ?>

<div class="petpost-page">
    <?php 
    $photo_path = "../static/images/" . $post['photo_id'] . "." . $post['photo_extension'];
    if(isset($_SESSION['username'])) {
        $current_user = getUserId($_SESSION['username'])['id'];
        $post_id = $post['id'];
        if (isOwner($current_user, $post_id)) {
            drawEditButtons($post_id);
        } else {
            if (hasProposal($current_user, $post_id)) {
                $status = getProposalStatus($current_user, $post_id)['status'];
                drawProposalStatus($status);
            } else {
                drawProposalButton($post_id, $current_user);
            }
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
        <?php if (!isOwner($current_user, $post['id'])) {
            if (isFavourite($current_user, $post['id'])) {?>
          &bigstar;
            <?php }
            else {?>
          &star;
            <?php } 
        }?>
      </button>
    <?php }?>
      <div id="petphoto" style="background: url(<?php echo $photo_path; ?>) no-repeat center /auto 100%"></div>
    </div>
    <?php drawEditOptions($post); ?>
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

    <h3>Questions & Answers</h3>
    <section id="petpost-questions">
      <?php
        if (isset($_SESSION['username'])) {
            drawQuestionsAnswers($post['id'], $current_user, $questionsAnswers);
        } else {
            drawQuestionsAnswers($post['id'], null, $questionsAnswers);
        }
        ?>
    </section>
  </div>
<?php } ?>

<?php
//user_id is the one currently on the page
function drawQuestionAnswer($post_id, $user_id, $questionAnswer)
{
    ?>
  <section id="<?php echo 'QA' . $questionAnswer['id'] ?>" class="QA">
    <section class="petpost-question">
      <p> <?php echo 'Q: ' . $questionAnswer['question']; ?> </p>
      <p> <?php echo $questionAnswer['question_date'] . ", " . getUsername($questionAnswer['user_id']); ?> </p>
      <?php
        // Checks if the current user is the owner of the post
        if (isset($user_id) && isOwner($user_id, $post_id) && !isset($questionAnswer['answer'])) { ?>
          <script src="../js/add_answer.js" type="text/javascript" defer></script>
          <button id="<?php echo 'answer-button' . $questionAnswer['id'] ?>" class="answer-button"
            onclick="toggleAnswerInput(<?php echo $questionAnswer['id'] ?>)">Answer</button>
    </section>

    <!-- Used in answer input -->
    <section class="answer-input" id="<?php echo 'answer-input' . $questionAnswer['id']; ?>" style="display: none;">
      <textarea class="answer-text-area" name="<?php echo 'answer_text' . $questionAnswer['id'] ?>" rows="1" cols="80"
         maxlength="2000" placeholder="Write your answer..." required></textarea>
      <button id="answer-input-button" type="button"
        onclick="addAnswer(<?php echo $questionAnswer['id'] ?>)">Post Answer</button>
        <?php } ?> 
    </section>

    <?php if (isset($questionAnswer['answer'])) {
          drawAnswer($questionAnswer);
    } ?>
  </section>
<?php } ?>

<?php function drawQuestionsAnswers($post_id, $user_id, $questionsAnswers)
{
    $cnt = 0;
    foreach ($questionsAnswers as $questionAnswer) {
        $cnt = $cnt + 1;
        drawQuestionAnswer($post_id, $user_id, $questionAnswer);
        echo '<br>';
    }
    if ($cnt == 0) {
        echo "<i id='no-questions'>There are no questions on this post. Make the first question</i>";
    }

    if (!isOwner($user_id, $post_id)) {
        if (isset($_SESSION['username'])) {
            // drawCommentForm($_GET['post_id'], $_SESSION['username']);
            drawQuestionForm($post_id);
        } else {
            drawQuestionsLoginPrompt();
        }
    }
} ?>

<?php function drawQuestionForm($post_id)
{
    ?>
  <script src="../js/utils.js" type="text/javascript" defer></script>
  <script src="../js/add_question.js" type="text/javascript" defer></script>
  <section id="question-input">
    <textarea id="question-input-ta" name="question_text" rows="1" cols="80"
       maxlength="2000" placeholder="Write your question..." required></textarea>
    <button id="question-input-button" type="button"
      onclick="addQuestion(<?php echo $post_id ?>)">Post Question</button>
  </section>

  <script type="text/javascript">
    // see: https://stackoverflow.com/questions/7745741/auto-expanding-textarea/24824750#24824750
    var textarea = document.getElementById("question-input-ta");
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

<?php function drawQuestionsLoginPrompt()
{
    ?>
  <section id="question-input">
    <p id="question-login-prompt">Log in to post questions</p>
  </section>
<?php } ?>


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
        <label for="age">Birth Date</label>
        <input id="birth_date" type="date" max="<?php echo date('Y-m-d'); ?>" name="birth_date" placeholder="birth date of the pet" required>
      </div>
      <div class="form-item addpostform-item" >
        <label for="image">Photo</label>
        <input id="image" type="file" name="image" required>
      </div>

      <div class="form-item listfilter-item" >
        <?php drawGendersRadio() ?>
      </div>

      <div class="form-item addpostform-item" >
            <?php drawSizes(false, null); ?>
      </div>

      <div class="form-item addpostform-item" >
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="1" cols="80" maxlength="2000"></textarea>
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

<?php function drawAnswer($questionAnswer)
{
    ?>
  <section class="petpost-answer">
    <p> <?php echo 'A: ' . $questionAnswer['answer']; ?> </p>
    <p> <?php echo $questionAnswer['answer_date'] ?> </p>
  </section>
<?php } ?>
