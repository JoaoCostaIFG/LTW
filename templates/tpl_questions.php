<?php function drawQuestionAnswer($questionAnswer)
{
    /**
     * Draws given a comment
     */
    ?>
    <section class="question">
        <h2> <?php echo 'Q: ' . $questionAnswer['question']; ?> </h2>
        <p> <?php echo 'Date: ' . $questionAnswer['question_date']; ?> </p>
    </section>
    <section class="answer">
        <h3> <?php echo 'A: ' . $questionAnswer['answer']; ?> </h3>
        <p> <?php echo 'Date: ' . $questionAnswer['answer_date']; ?> </p>
    </section>
<?php } ?>
