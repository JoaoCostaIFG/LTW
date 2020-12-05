<?php
include_once '../templates/tpl_utils.php';

function drawSentProposal($proposal) {
    $post_path = 'post.php?post_id=' . $proposal['post_id'];
?>
    <!-- Proposal from/to -->
    You made a proposal to
    <?php echo " " .$proposal['poster_username'] . " ";?>
    to adopt
    <?php echo " " . $proposal['pet_name'];?>

    <!-- Pet Image -->
    <a href="<?php echo $post_path; ?>" class="list-item">
      <?php drawPetPhoto($proposal['photo_id'], $proposal['photo_extension'], "petpost-img");?>
    </a>
    <br>

    <!-- Proposal status -->
    <p>
        Your proposal
        <?php
        if ($proposal['status'] == -1)
            echo " is pending";
        else if ($proposal['status'] == 0)
            echo " was refused";
        else if ($proposal['status'] == 1)
            echo " was accepted";
        ?>
    </p>
    <br>

<?php
}

function drawSentProposals($proposals) {
    foreach ($proposals as $proposal) {
        drawSentProposal($proposal);
    }
}

function drawAcceptProposal($user_id, $post_id) { ?>
        <script src="../js/utils.js" type="text/javascript" defer></script>
        <script src="../js/proposal.js" type="text/javascript" defer></script>
        <button id="acceptButton" onclick="handle_proposal(<?php echo "'accept_proposal', $post_id, $user_id";?>)">
            Accept Proposal</button>
        <button id="rejectButton" onclick="handle_proposal(<?php echo "'reject_proposal', $post_id, $user_id";?>)">
            Reject Proposal</button>
        <p id="processedButtonText"></p>
<?php }


function  drawReceivedProposal($proposal) {
    $post_path = 'post.php?post_id=' . $proposal['post_id'];
?>
    <!-- Proposal from/to -->
    You received a proposal from
    <?php echo " " .$proposal['user_username'] . " ";?>
    to adopt
    <?php echo " " . $proposal['pet_name'];?>

    <!-- Pet Image -->
    <a href="<?php echo $post_path; ?>" class="list-item">
      <?php drawPetPhoto($proposal['photo_id'], $proposal['photo_extension'], "petpost-img");?>
    </a>
    <br>

    <!-- Proposal status -->
    <?php
    if ($proposal['status'] == -1)
        drawAcceptProposal($proposal['user_id'], $proposal['post_id']);
    else if ($proposal['status'] == 0)
        echo "You refused this proposal";
    else if ($proposal['status'] == 1)
        echo "You accepted this proposal";
    ?>
    <br>

<?php
}

function drawReceivedProposals($proposals) {
    foreach ($proposals as $proposal) {
        drawReceivedProposal($proposal);
    }
}
?>
