<?php
require_once '../templates/tpl_petInfo.php';
require_once '../includes/utils.php';
require_once '../database/queries/db_proposal.php';
require_once '../database/queries/db_user.php';
require_once '../database/queries/db_post.php';

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

function stateToString($state, $post_id)
{
    if(isset($_SESSION['username'])) {
        $current_user = getUserId($_SESSION['username'])['id'];
    }
    $accepted_user = hasAcceptedProposal($post_id);
    if (isset($_SESSION['username']) 
        && (($accepted_user != false && $accepted_user['user_id'] == $current_user) || isOwner($current_user, $post_id))
    ) {
        if ($state == 1) {
            $text = "The pet is being prepared for adoption";
        } else if ($state == 2) {
            $text = "The pet ready for adoption";
        } else if ($state == 3) {
            $text = "The pet is being prepared for adoption and is adopted";
        } else if ($state == 4) {
            $text = "The pet is being delivered";
        } else if ($state == 5) {
            $text = "The pet was delivered";
        } else {
            $text = "Unkown status";
        }
    } else { // Normal user
        if ($accepted_user != false && $accepted_user['user_id'] != false) {
            $text = "This pet has already been adopted";
        } else {
            if ($state == 1) {
                $text = "The pet is being prepared for adoption";
            } else if ($state == 2) {
                $text = "The pet ready for adoption";
            } else if ($state > 2 && $state < 6) {
                $text = "This pet has already been adopted";
            } else {
                $text = "Unkown status";
            }
        }
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

    <button id="makeProposalButton" onclick="make_proposal_confirmation(<?php echo htmlspecialchars($post_id) . "," . htmlspecialchars($user_id);?>)">
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

    <p class="error">
    <?php
    $msg = getSessionMessage('editPostError');
    if ($msg) {
        echo $msg; 
    }?>
    </p>
    <button id="editButton" onclick="edit_post()">Edit Post</button>
    <form class="deleteButton" method="post" action="../actions/action_delete_post.php">
      <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
      <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']?>">
      <input class="form-button addpostform-button" type="submit" value="Remove post">
    </form>
<?php }

function drawEditOptions($post)
{
    ?>
    <div class="petpost-edit" style="display: none">
        <form class="verticalform addpostform" method="post" action="../actions/action_edit_post.php"
          enctype="multipart/form-data">
          <div class="form-item addpostform-item" >
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="<?php echo htmlspecialchars($post['name']); ?>" required>
          </div>

          <div class="form-item addpostform-item" >
            <label for="birth_date">Birth Date</label>
            <input id="birth_date" max="<?php echo date('Y-m-d'); ?>" type="date" name="birth_date" value="<?php echo htmlspecialchars($post['birth_date']); ?>" required>
          </div>
          <div class="form-item addpostform-item" >
            <label for="image">Photo</label>
            <input id="image" type="file" name="image" onchange="edit_photo(event)">
          </div>

          <div class="form-item addpostform-item" >
            <?php drawSizes(false, $post['size']); ?>
          </div>

          <div class="form-item addpostform-item" >
            <?php drawStates(hasAcceptedProposal($post['id']) != false, $post['state']); ?>
          </div>

          <div class="form-item addpostform-item" >
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="1" cols="80"
maxlength="2000"><?php echo htmlspecialchars(html_entity_decode($post['description'], ENT_QUOTES)); ?></textarea>
            <script type="text/javascript">
              // see: https://stackoverflow.com/questions/7745741/auto-expanding-textarea/24824750#24824750
              var textarea = document.getElementById("description");
              var limitRows = 5;
              var messageLastScrollHeight = textarea.scrollHeight;

              function resizeTextArea() {
                console.log(textarea);
                let rows = parseInt(textarea.getAttribute("rows"));
                // If we don't decrease the amount of rows, the scrollHeight would show the scrollHeight for all the rows
                // even if there is no text.
                textarea.setAttribute("rows", "1");

                if (rows < limitRows && textarea.scrollHeight > messageLastScrollHeight) {
                    rows++;
                } else if (rows > 1 && textarea.scrollHeight < messageLastScrollHeight) {
                    rows--;
                }

                console.log(rows);
                messageLastScrollHeight = textarea.scrollHeight;
                textarea.setAttribute("rows", rows);
              };
              textarea.oninput = resizeTextArea;
            </script>
          </div>

          <div class="form-item addpostform-item" >
            <?php drawColors(false, $post['color_id']); ?>
          </div>
          <div class="form-item addpostform-item" >
            <?php drawCities(false, $post['city_id']); ?>
          </div>

          <br>
          <input type="hidden" id="post_id" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">
          <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']?>">
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
    $photo_path = "../static/images/" . urlencode($post['photo_id']) . "." . urlencode($post['photo_extension']);
    if(isset($_SESSION['username'])) {
        $current_user = getUserId($_SESSION['username'])['id'];
        $post_id = $post['id'];
        if (isOwner($current_user, $post_id)) {
            drawEditButtons($post_id);
        } else {
            if (hasProposal($current_user, $post_id)) {
                $status = getProposalStatus($current_user, $post_id)['status'];
                drawProposalStatus($status);
            } else if ($post['state'] > 0 && $post['state'] < 3) {
                drawProposalButton($post_id, $current_user);
            }
        }
    }
    ?>

  <h2>
    <b><?php echo htmlspecialchars($post['name']); ?></b> <br>
    for adoption from <b>
      <a href="../pages/profile.php?username=<?php echo urlencode($post['user']); ?>">
        <?php echo htmlspecialchars($post['user']); ?>
      </a>
    </b>
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
      <li>Name: <b><?php echo htmlspecialchars($post['name']); ?></b></li>
      <li>Age: <b><?php echo htmlspecialchars(ageToString($post['age'])); ?></b></li>
      <li>Breed: <b><?php echo htmlspecialchars($post['species']); ?></b></li>
      <li>Genre: <b><?php echo htmlspecialchars(genderToString($post['gender'])); ?></b></li>
      <li>Size: <b><?php echo htmlspecialchars(sizeToString($post['size'])); ?></b></li>
      <li>Status: <b><?php echo htmlspecialchars(stateToString($post['state'], $post['id'])); ?></b></li>
      <li>Location: <b><?php echo htmlspecialchars($post['location']); ?></b></li>
      <li>Posted in: <b><?php echo htmlspecialchars($post['date']); ?></b></li>
    </ul>
  </div>

    <h3>Description</h3>
    <div class="petpost-description">
      <p> <?php echo nl2br(htmlspecialchars(html_entity_decode($post['description'], ENT_QUOTES))); ?> </p>
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

<?php function drawAnswer($questionAnswer)
{
    $user_id = null;
    if (isset($_SESSION['username'])) {
        $user_id = getUserId($_SESSION['username'])['id'];
    }
    ?>
  <br> <!-- Used to make the answers appear below the questions -->
  <section class="petpost-answer">
    <?php if (isAnswerOwner($questionAnswer['id'], $user_id)) { ?>
    <br>
    <button id="<?php echo 'edit-ans-button' . htmlspecialchars($questionAnswer['id']) ?>"
      onclick="toggleAnsEdit(<?php echo htmlspecialchars($questionAnswer['id']) ?>)">Edit</button>
    <button id="<?php echo 'edit-ans-confirm' . htmlspecialchars($questionAnswer['id']) ?>" style="display: none;"
      onclick="edit_ans(<?php echo htmlspecialchars($questionAnswer['id']) ?>)">Confirm</button>
    <?php } ?>

    <p id="<?php echo 'Answer' . htmlspecialchars($questionAnswer['id']) ?>">
      <?php echo 'A: ' . nl2br(htmlspecialchars($questionAnswer['answer'])); ?> </p>
    <p> <?php echo htmlspecialchars($questionAnswer['answer_date']); ?> </p>

    <?php if (isAnswerOwner($questionAnswer['id'], $user_id)) { ?>
    <p class="error" id="<?php echo 'edit-ans-error' . htmlspecialchars($questionAnswer['id']) ?>"
      style="display: none;"></p>
    <textarea id="<?php echo 'edit-ans-field' . htmlspecialchars($questionAnswer['id']) ?>"
      placeholder="Type the new answer here" style="display: none;"></textarea>
    <?php } ?>
  </section>
<?php } ?>

<?php
//user_id is the one currently on the page
function drawQuestionAnswer($post_id, $user_id, $questionAnswer)
{
    ?>
  <section id="<?php echo 'QA' . htmlspecialchars($questionAnswer['id']) ?>" class="QA">
    <section class="petpost-question">
      <p> <?php echo 'Q: ' . nl2br(htmlspecialchars($questionAnswer['question'])); ?> </p>
      <p>
        <?php
          $username=getUsername($questionAnswer['user_id']);
          echo htmlspecialchars($questionAnswer['question_date']) . ', ';
        ?>
        <a href="../pages/profile.php?username=<?php echo urlencode($username) ?>">
          <?php echo htmlspecialchars($username); ?>
        </a>
      </p>
      <?php
        // Checks if the current user is the owner of the post
        if (isset($user_id) && isOwner($user_id, $post_id) && !isset($questionAnswer['answer'])) { ?>
          <script src="../js/add_answer.js" type="text/javascript" defer></script>
          <button id="<?php echo 'answer-button' . htmlspecialchars($questionAnswer['id']) ?>" class="answer-button"
            onclick="toggleAnswerInput(<?php echo htmlspecialchars($questionAnswer['id']) ?>)">Answer</button>
    </section>

    <!-- Used in answer input -->
    <section class="answer-input" id="<?php echo 'answer-input' . htmlspecialchars($questionAnswer['id']); ?>" style="display: none;">
      <textarea class="answer-text-area" name="<?php echo 'answer_text' . htmlspecialchars($questionAnswer['id']) ?>" rows="1" cols="80"
         maxlength="2000" placeholder="Write your answer..." required></textarea>
      <button id="answer-input-button" type="button"
        onclick="addAnswer(<?php echo htmlspecialchars($questionAnswer['id']) ?>)">Post Answer</button>
        <?php } ?> 
    </section>

    <?php if (isset($questionAnswer['answer'])) {
          drawAnswer($questionAnswer);
    } ?>
  </section><br>
<?php } ?>

<?php function drawQuestionsAnswers($post_id, $user_id, $questionsAnswers)
{
    ?>
    <script src="../js/edit_qa.js" type="text/javascript" defer></script>

    <?php
    if(empty($questionsAnswers)) {
        echo "<i id='no-questions'>There are no questions on this post. Make the first question</i>";
    } else {
        foreach ($questionsAnswers as $questionAnswer) {
            drawQuestionAnswer($post_id, $user_id, $questionAnswer);
        }
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
      onclick="addQuestion(<?php echo htmlspecialchars($post_id) ?>)">Post Question</button>
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
    <!-- <form class="verticalform addpostform" method="post" action="../api/post.php" enctype="multipart/form-data"> -->
      <div class="form-item addpostform-item" >
        <label for="name">Name</label>
        <input id="name" type="text" name="name" placeholder="name of the pet" required>
      </div>
      <div class="form-item addpostform-item" >
        <label for="birth_date">Birth Date</label>
        <input id="birth_date" type="date" max="<?php echo date('Y-m-d'); ?>" name="birth_date" required>
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
            <?php drawStates(null, false); ?>
      </div>

      <div class="form-item addpostform-item" >
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="1" cols="80" maxlength="2000"></textarea>
        <script type="text/javascript">
          // see: https://stackoverflow.com/questions/7745741/auto-expanding-textarea/24824750#24824750
          var textarea = document.getElementById("description");
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
      <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']?>">
      <input class="form-button addpostform-button" type="submit" value="Add pet">
    </form>

    <script src="../js/store_session.js" type="text/javascript" defer></script>

    <p class="error">
    <?php
    $msg = getSessionMessage('errorAddPost');
    if ($msg) {
        echo htmlspecialchars($msg); 
    }?>
    </p>

  </section>
<?php } ?>
