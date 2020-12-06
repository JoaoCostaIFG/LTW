<?php 
require '../templates/tpl_list.php';

function drawProfile($user, $user_posts)
{
    /**
     * Draws an user's profile 
     * note: the image is inside a div so we can center it inside the column.
     */
print_r($user);
    $photo_path = "../static/users/" . $user['id'] . "." . $user['extension'];
    ?>

    <h2><b><?php echo $user['username'];?></b>&#39;s Profile</h2>

    <div id="profile">
        <div id="profile-pic">
          <img src="<?php echo $photo_path; ?>" alt="User Profile Picture">
        </div>
        <ul class="nobullets" id="profile-info">
            <li>Email: <b><?php echo $user['email']; ?></b></li>
            <li>Phone number: <b><?php echo $user['mobile_number']; ?></b></li>
        </ul>
        <?php if($user['username'] == $_SESSION['username']) { ?>
          <ul class="nobullets" id="profile-options">
            <li><a class="hoverable" href='../pages/edit_profile.php'>Edit Profile </a></li>
            <li><a class="hoverable" href='../pages/settings.php'>Account Settings</a></li>
          </ul>
        <?php  }?>
        <div id="profile-posts">
          <h3><b>Posts by <?php echo $user['username']?></b></h3>
          <?php drawPostList($user_posts); ?>
        </div>
    </div>

    <?php
} 

function drawEditProfile($user)
{
    /**
     * Draws an user's profile edit page
     */
    ?>

    <section class="profile">
        <h2><b>Edit Profile</b></h2>

        <form class="verticalform" id="profileform" method="post" action="../actions/action_edit_profile.php" enctype="multipart/form-data">
            <div class="form-item profileform-item">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" placeholder="<?php echo $user['username']; ?>">
                <p class="note">This is the name other users will see when intereacting with you.
                  You also use this to sign in.</p>
            </div>
            <div class="form-item profileform-item">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" placeholder="<?php echo $user['email']; ?>">
                <p class="note">This is the email that others will use to contact you and where you'll receive notifications.</p>
            </div>
            <div class="form-item profileform-item">
                <label for="mobile_number">Phone Number</label>
                <input id="mobile_number" type="text" name="mobile_number" placeholder="<?php echo $user['mobile_number']; ?>">
                <p class="note">This is the phone number that other users will use to contact you.</p>
            </div>
            <div class="form-item profileform-item">
                <?php if($user['picture'] != null) { ?>
                  <div id="profile-pic">
                    <img src="<?php echo $user['picture'] ?>" alt="User's current profile picture.">
                  </div>
                <?php }?>
  
                <label for="image">Profile picture</label>
                <input id="image" type="file" name="image">
            </div>

            <input class="form-button profileform-button" type="submit" value="Submit Changes">
        </form>

        <?php
        if ($_SESSION['messages']['type'] == 'updateUserError') { ?>
        <p class="error"><?php     
            echo $_SESSION['messages']['content']; 
            $_SESSION['messages'] = [];?>
        </p>
        <br>
        <?php }?>
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
      <h2><b>Settings</b></h2>

      <h3>Change Password</h3>
      <form id="changePassword" method="post" action="../actions/action_edit_profile.php" enctype="multipart/form-data">
        <div class="form-item">
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="password" required>
        </div>
        <div class="form-item" >
          <label for="password_r">Repeat your password</label>
          <input id="password_r" type="password" name="password_r" placeholder="password (again)" required>
        </div>

        <input class="form-button" type="submit" value="Submit">
      </form>

      <?php
        if ($_SESSION['messages']['type'] == 'passwordError') { ?>
        <br>
        <p class="error"><?php     
          echo $_SESSION['messages']['content']; 
          $_SESSION['messages'] = [];?>
          </p>
        <?php }?>
    </section>
    <?php
}?>

