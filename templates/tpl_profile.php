<?php 
  require '../templates/tpl_list.php';
  require_once '../includes/utils.php';

function drawProfile($is_owner, $user, $user_posts)
{
    /**
     * Draws an user's profile 
     * note: the image is inside a div so we can center it inside the column.
     */
    $photo_path = "../static/users/" . $user['id'] . "." . $user['extension'];
    ?>

    <h2>
      <?php
        if ($is_owner) echo "<b>Your profile</b>";
        else echo "<b>" . htmlspecialchars($user['username']) . "</b>&#39;s Profile";
      ?></b>
    </h2>

    <div id="profile">
        <div id="profile-pic">
          <img src="<?php echo htmlspecialchars($photo_path); ?>" alt="User Profile Picture">
        </div>
        <ul class="nobullets" id="profile-info">
            <li>Email: <b><?php echo htmlspecialchars($user['email']); ?></b></li>
            <li>Phone number: <b><?php echo htmlspecialchars($user['mobile_number']); ?></b></li>
        </ul>
        <?php if($user['username'] == $_SESSION['username']) { ?>
          <ul class="nobullets" id="profile-options">
            <li><a class="hoverable" href='../pages/edit_profile.php'>Edit Profile </a></li>
            <li><a class="hoverable" href='../pages/settings.php'>Account Settings</a></li>
          </ul>
        <?php  }?>
        <div id="profile-posts">
          <h3 id="profile-posts-title"><b>Posts by <?php echo $user['username']?></b></h3>
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
        <h2><b>Edit Profile (Change only the needed fields)</b></h2>

        <form class="verticalform" id="profileform" method="post" action="../actions/action_edit_profile.php"
          enctype="multipart/form-data">
            <div class="form-item profileform-item">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" maxlength="32"
                  placeholder="<?php echo htmlspecialchars($user['username']); ?>">
                <p class="note">This is the name other users will see when interacting with you.
                  You also use this to sign in.</p>
            </div>
            <div class="form-item profileform-item">
                <label for="email">Email</label>
                <input id="email" type="text" name="email" placeholder="<?php echo htmlspecialchars($user['email']); ?>">
                <p class="note">This is the email that others will use to contact you and where you'll receive notifications.</p>
            </div>
            <div class="form-item profileform-item">
                <label for="mobile_number">Phone Number</label>
                <input id="mobile_number" type="text" name="mobile_number"
                  placeholder="<?php echo htmlspecialchars($user['mobile_number']); ?>" maxlength="20">
                <p class="note">This is the phone number that other users will use to contact you.</p>
            </div>
            <div class="form-item profileform-item">
                <?php if(isset($user['picture'])) { ?>
                  <div id="profile-pic">
                    <img src="<?php echo htmlspecialchars($user['picture']) ?>" alt="User's current profile picture.">
                  </div>
                <?php }?>
  
                <label for="image">Profile picture</label>
                <input id="image" type="file" name="image">
            </div>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <input class="form-button profileform-button" type="submit" value="Submit Changes">
        </form>

        <p class="error">
        <?php
          $msg = getSessionMessage('updateUserError');
        if ($msg) {
            echo htmlspecialchars($msg); 
        }?>
        </p>
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
          <label for="current_password">Current password</label>
          <input id="current_password" type="password" name="current_password" placeholder="Current password" required>
        </div>
        <div class="form-item">
          <label for="password">New Password</label>
          <input id="password" type="password" name="password" placeholder="New password" required>
        </div>
        <div class="form-item" >
          <label for="password_r">Repeat new password</label>
          <input id="password_r" type="password" name="password_r" placeholder="New password (again)" required>
        </div>
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <input class="form-button" type="submit" value="Submit">
      </form>

      <p class="error">
      <?php
        $msg = getSessionMessage('passwordError');
        if ($msg) {
            echo htmlspecialchars($msg); 
        }?>
      </p>
    </section>
    <?php
}?>

