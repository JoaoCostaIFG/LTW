<?php
require_once '../includes/utils.php';

function drawSentProposal($proposal)
{
    $post_path = 'post.php?post_id=' . urlencode($proposal['post_id']);
    $photo_path = "../static/images/" . urlencode($proposal['photo_id']) . "." . urlencode($proposal['photo_extension']);

    // Proposal from/to
    $proposal_txt = "You made a proposal to <b>" . htmlspecialchars($proposal['poster_username']) . "</b> ";
    $proposal_txt .= "to adopt <b>" . htmlspecialchars($proposal['pet_name']) . "</b>.";

    // Proposal status
    $status_txt =  "Your proposal ";
    if ($proposal['status'] == -1) { 
        $status_txt .= "<b>is pending";
    } else if ($proposal['status'] == 0) { 
        $status_txt .= "<b class='error'>was refused";
    } else if ($proposal['status'] == 1) { 
        $status_txt .= "<b class='success'>was accepted";
    }
    $status_txt .=  "</b>.";

    // Pet Image
    ?>

  <div class="petpost">
    <a class="nounderline petimage petpost-img" href="<?php echo $post_path; ?>">
      <div style="background: url(<?php echo $photo_path; ?>) no-repeat center /auto 100%"></div>
    </a>
    <ul class="petpost-info nobullets">
      <li><?php echo $proposal_txt; ?></li>
      <li><?php echo $status_txt; ?></li>
    </ul>
  </div>

    <?php
}

function drawSentProposals($proposals)
{
    $found_one = false;
    foreach ($proposals as $proposal) {
        $found_one = true;
        drawSentProposal($proposal);
    }

    if (!$found_one) {
        echo "<p>You've made no adoption proposals yet.</p>";
    }
}

function drawAcceptProposal($user_id, $post_id)
{
    static $id = 0;
    $user_id = htmlspecialchars($user_id);
    $post_id = htmlspecialchars($post_id);

    ?>
        <script src="../js/utils.js" type="text/javascript" defer></script>
        <script src="../js/proposal.js" type="text/javascript" defer></script>
        <div class="proposalButtonsFromPost<?php echo $post_id ?>" id="proposalButtons<?php echo $id ?>">
            <button id="acceptButton"
                onclick="handle_proposal(<?php echo "$id, 'accept_proposal', $post_id, $user_id";?>)">
                Accept Proposal</button>
            <button id="rejectButton" class="rejbutton"
                onclick="handle_proposal(<?php echo "$id, 'reject_proposal', $post_id, $user_id";?>)">
                Reject Proposal</button>
            <p id="processedButtonText"></p>
        </div>
    <?php
    $id++;
}


function drawReceivedProposal($proposal)
{
    $post_path = 'post.php?post_id=' . urlencode($proposal['post_id']);
    $photo_path = "../static/images/" . urlencode($proposal['photo_id']) . "." . urlencode($proposal['photo_extension']);

    // Proposal from/to
    $proposal_txt = "You received a proposal from <b>" . htmlspecialchars($proposal['user_username']) . "</b> ";
    $proposal_txt .= "to adopt <b>" . htmlspecialchars($proposal['pet_name']) . "</b>.";

    // Pet Image
    ?>

    <div class="petpost">
      <a class="nounderline petimage petpost-img" href="<?php echo $post_path; ?>">
        <div style="background: url(<?php echo $photo_path; ?>) no-repeat center /auto 100%"></div>
      </a>
      <ul class="petpost-info nobullets">
        <li><?php echo $proposal_txt; ?></li>
        <li>
          <?php
          // Proposal status

          if ($proposal['status'] == -1) {
              drawAcceptProposal($proposal['user_id'], $proposal['post_id']);
          } else if ($proposal['status'] == 0) {
              echo "You <b>rejected</b> this proposal.";
          } else if ($proposal['status'] == 1) {
              echo "You <b>accepted</b> this proposal.";
          }
          ?>
        </li>
      </ul>
    </div>

    <?php
}

function drawReceivedProposals($proposals)
{
    $found_one = false;
    foreach ($proposals as $proposal) {
        $found_one = true;
        drawReceivedProposal($proposal);
    }

    if (!$found_one) {
        echo "<p>You've received no adoption proposals yet.</p>";
    }
}
?>
