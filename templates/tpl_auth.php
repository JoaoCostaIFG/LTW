<?php function draw_login()
{
    /* 
     * Draws the login section
     */
    ?>
  <section id="login">
      <header><h2>Hello Again</h2></header>

      <form method="post" action="../actions/action_login.php">
          <input type="text" name="username" placeholder="username" required>
          <input type="password" name="password" placeholder="password" required>
          <input type="submit" value="Login">
      </form>
  
      <footer>
          <p>Don't have an account? <a href="register.php">Signup!</a></p>
      </footer>
  </section>
<?php } ?>

<?php function draw_register()
{
    /* 
     * Draws the login section
     */
    ?>
  <section id="register">
      <header><h2>Create a new account</h2></header>

      <form class="verticalform signupform" method="post" action="../actions/action_register.php">
        <div class="form-item signupform-item" >
          <label for="username">Username</label>
          <input id="username" type="text" name="username" placeholder="username" required>
        </div>
        <div class="form-item signupform-item" >
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="password" required>
        </div>
        <div class="form-item signupform-item" >
          <label for="password_r">Repeat your password</label>
          <input id="password_r" type="password" name="password_r" placeholder="password (again)" required>
        </div>
        <div class="form-item signupform-item" >
          <label for="email">Email address</label>
          <input id="email" type="text" name="email" placeholder="email" required>
        </div>
        <div class="form-item signupform-item" >
          <label for="mobile">Mobile phone number</label>
          <input id="mobile" type="text" name="mobile number" placeholder="mobile number" required>
        </div>
        <div class="form-item signupform-item" >
          <label for="picture">Picture</label>
          <input id="picture" type="file" name="picture" required>
        </div>

    <?php
    if ($_SESSION['messages']['type'] == 'signUpError') {
        echo '<p class="error">' . $_SESSION['messages']['content'] . '</p>'; 
        $_SESSION['messages'] = [];
    }
    ?>

        <input class="form-button signupform-button" type="submit" value="Signup">
      </form>
  
      <p><i>Already have an account? <a href="login.php">Login!</a></i></p>
  </section>
<?php } ?>
