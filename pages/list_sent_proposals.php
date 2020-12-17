<?php
require_once '../includes/session.php';

if (!isset($_SESSION['username'])) {
  die(header('Location: ../pages/list.php'));
}

$title="Sent Proposals";
require_once '../templates/common/tpl_header.php';
require_once '../database/queries/db_user.php';
require_once '../database/queries/db_proposal.php';
require_once '../templates/tpl_proposal.php';
?>

<header><h2><b>Your sent proposals</b></h2></header>

<?php
$user_id = getUserId($_SESSION['username'])['id'];
$proposals = getSentProposals($user_id);
drawSentProposals($proposals);
require '../templates/common/tpl_footer.php';
?>
