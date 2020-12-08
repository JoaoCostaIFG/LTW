<?php
  require 'session.php';
  $title="Home";
  require '../templates/common/tpl_header.php';
?>

  <h2><b>Welcome to our website!</b></h2>
  <p>We are a company that connects pets with owners who'll take good care of
    them.<br>If you're looking to adopt a pet, want to offer a pet for adoption
    or just want to look at all of the cute photos, you've found the right
    place. Every animal and animal lover is welcome here, so come
    <a href="../pages/list.php">meet everyone</a>!
  </p>
  <p>You can also <a href="../pages/register.php">join us</a>, so you can interact
    and have fun with everyone.
  </p>

  <h2><b>About us</b></h2>
  <p>We are a small team of animal lovers who wanted to make a difference. You
    can <a href="../pages/contacts.php">contact us</a> anytime!
  </p>

  <img id="aboutimg" src="../static/bazinga.jpg" alt="Turtle."/>

<?php
  require '../templates/common/tpl_footer.php';
?>
