<?php function draw_login() {
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

<?php function draw_register() {
    /* 
     * Draws the login section
     */
    ?>

    <section id="register">
        <header><h2>Create a new account</h2></header>

        <form method="post" action="../actions/action_register.php">
            <input type="text" name="username" placeholder="username" required>
            <input type="password" name="password" placeholder="password" required>
            <input type="password" name="password_r" placeholder="password repeated" required>
            <input type="text" name="picture" placeholder="picture" required>
            <input type="text" name="email" placeholder="email" required>
            <input type="text" name="mobile number" placeholder="mobile number" required>
            <input type="submit" value="Signup">
        </form>
    
        <footer>
            <p>Already have an account? <a href="login.php">Login!</a></p>
        </footer>
    </section>
<?php } ?>
