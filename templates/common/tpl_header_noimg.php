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
        <li><a href="/index.php">Home</a></li>
        <li><a href="/pages/list.php">Search</a></li>
        <li><a href="/pages/contacts.php">Contacts</a></li>
      </ul>

      <?php if (!isset($_SESSION['username'])) { ?>
        <div id="signup">
          <a href="/pages/register.php">Sign Up</a>
          <a href="/pages/login.php">Log in</a>
        </div>
      <?php } else { ?>
        <ul id="logout">
          <li><a href="add_post.php">+</a></li>
          <li>Logged in as   <a href="../pages/profile.php?username=<?php echo $_SESSION['username']; ?>" >
          <?php echo $_SESSION['username']; ?> </a></li>
          <li>
            <form method="post" action="../actions/action_logout.php">
              <input type="submit" value="Logout">
            </form>
          <li class="addpost-button"><a href="add_post.php"><input type="submit" value="+"></a></li>
          <li>Logged in as <b><?php echo $_SESSION['username'] ?></b></li>
          <li class="logout-button">
            <a href='../actions/action_logout.php'><input type="submit" value="Logout"></a>
          </li>
        </ul>
        
      <?php }?>
    </nav>
