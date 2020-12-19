<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title><?php if(isset($title)) { echo $title . ' | ';
           } ?>Become my buddy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if(isset($_SESSION['csrf'])){ ?>
      <meta name="csrf-token" content="<?=$_SESSION['csrf']?>">
    <?php } ?>
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet">
  </head>
  <body>
    <nav id="top-bar">
      <ul id="menu" class="nobullets">
        <li><a class="nounderline" href="../index.php">Home</a></li>
        <li><a class="nounderline" href="../pages/list.php">Search</a></li>
        <li><a class="nounderline" href="../pages/contacts.php">Contacts</a></li>
      </ul>

      <label id="top-bar-toggle-label" for="top-bar-toggle">🐶</label>
      <input type="checkbox" id="top-bar-toggle">

<?php if (!isset($_SESSION['username'])) { ?>
      <div id="auth">
        <a class="nounderline" href="../pages/register.php">Sign Up</a>
        <a class="nounderline" href="../pages/login.php">Log in</a>
      </div>
<?php } else { 
      require_once '../database/queries/db_proposal.php';
      require_once '../database/queries/db_user.php';
      $proposals_count = sizeof(getReceivedNotAcceptedProposals(getUserId($_SESSION['username'])['id']));?>
      <ul id="authlogin" class="nobullets">
        <li class="topbar-button">
          <a class="nounderline" href="list_sent_proposals.php"><button type="button">See sent proposals</button></a>
        </li>
        <li class="topbar-button">
          <a class="nounderline" href="list_received_proposals.php">
            <button type="button">See received proposals</button>
<?php if($proposals_count > 0){ ?>
            <span class="notification"><?=$proposals_count?></span>
<?php } ?>
          </a>
        </li>
        <li class="topbar-button">
          <a class="nounderline" href="add_post.php"><button type="button">+</button></a>
        </li>
        <li id="topbar-username">
          Logged in as 
          <a href="../pages/profile.php" >
            <b><?php echo htmlspecialchars($_SESSION['username']) ?></b>
          </a>
        </li>
        <li id="logout-button">
          <a class="nounderline" href='../actions/action_logout.php'><button type="button">Logout</button></a>
        </li>
      </ul> 
<?php } ?>
    </nav>
