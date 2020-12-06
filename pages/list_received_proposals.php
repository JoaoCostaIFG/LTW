<?php
  include_once 'session.php';
  $title="Received Proposals";
  include_once '../templates/common/tpl_header_noimg.php';

  include_once '../database/queries/db_user.php';
  include_once '../database/queries/db_proposal.php';
  include_once '../templates/tpl_proposal.php';
?>

  <h2><b>Your received proposals</b></h2>

<?php
  $user_id = getUserId($_SESSION['username'])['id'];
  $proposals = getReceivedProposals($user_id);
  drawReceivedProposals($proposals);
  require '../templates/common/tpl_footer.php';
?>
