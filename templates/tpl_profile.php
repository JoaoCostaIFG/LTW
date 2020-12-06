<?php 
include('../templates/tpl_list.php');

function drawProfile($user, $user_posts)
{
    /**
     * Draws an user's profile 
     */
?>

    <h2>
        <b><?php echo $user['username'];?>&#39 s Profile</b>
    </h2>

    <div class="profile">
        <img src="<?php echo $user['picture']; ?>" alt="User Profile Picture" width="400">
        <ul class=profile-info>
            <li><b><?php echo $user['username']; ?></b></li>
            <li><?php echo $user['email']; ?></li>
            <li><?php echo $user['mobile_number']; ?></li>
        </ul>
        
        <?php
            if($user['username'] == $_SESSION['username']){ ?>
                <a href='../pages/edit_profile.php'>Edit Profile </a>

        <?php  }?>
        <br>
        <?php
            if($user['username'] == $_SESSION['username']){ ?>
                <a href='../pages/settings.php'>Account Settings</a>

        <?php  }?>



    </div>

    <h3>
        <b>Posts by <?php echo $user['username']?></b>
    </h3>

    <?php drawPostList($user_posts);

} 

function drawEditProfile($user)
{
    /**
     * Draws an user's profile edit page
     */
?>

    <section class="profile">
        <h2>
            <b>Edit Profile</b>
        </h2>

        <?php
        if ($_SESSION['messages']['type'] == 'updateUserError') { ?>
        <p class="error"><?php     
            echo $_SESSION['messages']['content']; 
            $_SESSION['messages'] = [];?>
        </p>
        <br>
        <?php }?>
        <form id="editProfile" method="post" action="../actions/action_edit_profile.php" enctype="multipart/form-data">
            <div class="form-item">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" placeholder="<?php echo $user['username']; ?>">
                <div class="Note">
                    <p>This is the name other users will see when intereacting with you.</p>
                    <br>
                </div>
            </div>

            <div class="form-item">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" placeholder="<?php echo $user['email']; ?>">
                <div class="Note">
                    <p>This is the email you use to login and that others will use to contact you.</p>
                    <br>
                </div>
            </div>

            <div class="form-item">
                <label for="mobile_number">Phone Number</label>
                <input id="mobile_number" type="text" name="mobile_number" placeholder="<?php echo $user['mobile_number']; ?>">
                <div class="Note">
                    <p>This is the phone number that other users will use to contact you.</p>
                    <br>
                </div>
            </div>

            <div class="form-item" >
                <?php if($user['picture'] != null) { ?>
                    <img src="<?php echo $user['picture'] ?>" alt="User Profile Picture" width="400">
                <?php }?>
  
                <label for="image">Picture</label>
                <input id="image" type="file" name="image">
            </div>
            <br>
            <br>
            <input class="form-button" type="submit" value="Submit Changes">

        </form>

    </section>

<?php 
}

function drawSettings()
{
    /**
     * Draws an settings page
     */
?>
    <section class="settings">
        <h2>
            <b>Settings</b>
        </h2>
        <h3>
            Change Password
        </h3>

        <form id="changePassword" method="post" action="../actions/action_edit_profile.php" enctype="multipart/form-data">
            <div class="form-item">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="password" required>
            </div>
            <div class="form-item" >
                <label for="password_r">Repeat your password</label>
                <input id="password_r" type="password" name="password_r" placeholder="password (again)" required>
            </div>

            <?php
            if ($_SESSION['messages']['type'] == 'passwordError') { ?>
            <br>
            <p class="error"><?php     
                echo $_SESSION['messages']['content']; 
                $_SESSION['messages'] = [];?>
            </p>
            <?php }?>

            <input class="form-button" type="submit" value="Submit">
        </form>

    </section>
<?php
}?>

