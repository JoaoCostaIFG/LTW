<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title><?php if($title) { echo $title . ' | ';
           } ?>Become my buddy</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet">
  </head>
  <body>
    <nav id="top-bar">
      <ul id="menu">
        <li><a class="nounderline" href="/index.php">Home</a></li>
        <li><a class="nounderline" href="/pages/list.php">Search</a></li>
        <li><a class="nounderline" href="/pages/contacts.php">Contacts</a></li>
      </ul>

      <?php if (!isset($_SESSION['username'])) { ?>
        <div id="signup">
          <a class="nounderline" href="/pages/register.php">Sign Up</a>
          <a class="nounderline" href="/pages/login.php">Log in</a>
        </div>
      <?php } else { ?>
        <ul id="logout">
          <li class="topbar-button">
            <a class="nounderline" href="list_sent_proposals.php"><input type="submit" value="See sent proposals"></a>
          </li>
          <li class="topbar-button">
            <a class="nounderline" href="list_received_proposals.php"><input type="submit" value="See received proposals"></a>
          </li>
          <li class="topbar-button">
            <a class="nounderline" href="add_post.php"><input type="submit" value="+"></a>
          </li>
          <li>
            Logged in as 
            <a href="../pages/profile.php?username=<?php echo $_SESSION['username']; ?>" >
              <b><?php echo $_SESSION['username'] ?></b> 
            </a>
          </li>
          <li id="logout-button">
            <a class="nounderline" href='../actions/action_logout.php'><input type="submit" value="Logout"></a>
          </li>
        </ul>
        
      <?php }?>
    </nav>
