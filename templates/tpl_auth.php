<?php
require_once 'tpl_utils.php';

function draw_login()
{
    /* 
     * Draws the login section
     */
    ?>
  <section id="login">
      <header><h2>Hello Again</h2></header>

      <form method="post" action="../actions/action_login.php">
        <div class="form-item">
          <label for="username">Username</label>
          <input id="username" type="text" name="username" placeholder="username" required>
        </div>
        <div class="form-item">
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="password" required>
        </div>

        <input class="form-button" type="submit" value="Login">
      </form>
  
      <footer>
          <p>Don't have an account? <a href="../pages/register.php">Signup!</a></p>
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

      <form class="verticalform" id="profileform" method="post" action="../actions/action_register.php"
        enctype="multipart/form-data">
        <div class="form-item profileform-item" >
          <label for="username">Username</label>
          <input id="username" type="text" name="username" placeholder="username" maxlength="32" required>
        </div>
        <div class="form-item profileform-item" >
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="password" required>
        </div>
        <div class="form-item profileform-item" >
          <label for="password_r">Repeat your password</label>
          <input id="password_r" type="password" name="password_r" placeholder="password (again)" required>
        </div>
        <div class="form-item profileform-item" >
          <label for="email">Email address</label>
          <input id="email" type="text" name="email" placeholder="email" required>
        </div>
        <div class="form-item profileform-item" >
          <label for="mobile">Mobile phone number</label>
          <input id="mobile" type="text" name="mobile number" placeholder="mobile number" maxlength="20" required>
        </div>
        <div class="form-item profileform-item" >
          <label for="image">Photo</label>
            <input id="image" type="file" name="image" required>
        </div>

        <input class="form-button profileform-button" type="submit" value="Signup">
      </form>

      <p class="error">
    <?php
    $msg = getSessionMessage('signUpError');
    if ($msg) {
        echo $msg; 
    }?>
      </p>
  
      <p><i>Already have an account? <a href="../pages/login.php">Login!</a></i></p>
  </section>
<?php } ?>
