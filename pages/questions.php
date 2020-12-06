<?php
if (!$_GET['post_id']) { // go to 404 if there is no post id
    header('Location: 404.php');
}
  $title="Question " . $_GET['post_id'];
  require '../templates/common/tpl_header.php';

  require '../database/db_post.php';
  require '../templates/tpl_questions.php';
  $questionsAnswers = getQuestionsAnswers($_GET['post_id']);

if(count($questionsAnswers) == 0) {
    echo '<p> No questions about this pet</p>';
} else {
    foreach($questionsAnswers as $questionAnswer){
        drawQuestionAnswer(NULL, $questionAnswer);
    }
}

  require '../templates/common/tpl_footer.php';
?>
