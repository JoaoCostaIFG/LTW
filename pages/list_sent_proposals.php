<?php
  include_once 'session.php';
  $title="Sent Proposals";
  include_once '../templates/common/tpl_header_noimg.php';
  include_once '../database/queries/db_user.php';
  include_once '../database/queries/db_proposal.php';
  include_once '../templates/tpl_proposal.php';
?>

  <h2><b>Your sent proposals</b></h2>

<?php
  $user_id = getUserId($_SESSION['username'])['id'];
  $proposals = getSentProposals($user_id);
  drawSentProposals($proposals);
  require '../templates/common/tpl_footer.php';
?>
