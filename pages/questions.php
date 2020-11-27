<?php
  if (!$_GET['post_id']) // go to 404 if there is no post id
    header('Location: 404.php');
  include('../templates/common/tpl_header.php');

  include('../database/db_post.php');
  include('../templates/tpl_questions.php');
  $questionsAnswers = getQuestionsAnswers($_GET['post_id']);

  if(count($questionsAnswers) == 0){
    echo '<p> No questions about this pet</p>';
  } else {
    foreach($questionsAnswers as $questionAnswer){
        drawQuestionAnswer($questionAnswer);
    }
  }

  include('../templates/common/tpl_footer.php');
?>