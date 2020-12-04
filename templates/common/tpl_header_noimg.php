<!DOCTYPE html>
<html lang="en-US">
  <head>
  <title>Become my buddy<?php if($title) echo ' - ' . $title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/layout.css" rel="stylesheet">
    <link href="../css/responsive.css" rel="stylesheet">
  </head>
  <body>
    <nav id="menu">
      <ul>
        <li><a href="/index.php">Home</a></li>
        <li><a href="/index.php">Search</a></li>
        <li><a href="/index.php">Contacts</a></li>
      </ul>

      <?php if (!isset($_SESSION['username'])) { ?>
        <div id="signup">
          <a href="register.php">Sign Up</a>
          <a href="login.php">Log in</a>
        </div>
      <?php } else { ?>
        <ul id="logout">
          <li><a href="add_post.php">+</a></li>
          <li>Logged in as <?php echo $_SESSION['username'] ?></li>
          <li>
            <form method="post" action="../actions/action_logout.php">
              <input type="submit" value="Logout">
            </form>
          </li>
        </ul>
      <?php }?>
    </nav>

