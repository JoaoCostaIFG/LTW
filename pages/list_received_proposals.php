<?php
  require_once '../includes/session.php';
  $title="Received Proposals";
  require_once '../templates/common/tpl_header_noimg.php';

  require_once '../database/queries/db_user.php';
  require_once '../database/queries/db_proposal.php';
  require_once '../templates/tpl_proposal.php';
?>

  <h2><b>Your received proposals</b></h2>

<?php
  $user_id = getUserId($_SESSION['username'])['id'];
  $proposals = getReceivedProposals($user_id);
  drawReceivedProposals($proposals);
  require '../templates/common/tpl_footer.php';
?>
