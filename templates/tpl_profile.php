<?php function drawProfile($user, $user_posts)
{
    /**
     * Draws an user's profile 
     */
?>

    <h2>
        <b>Profile</b>
    </h2>

    <div class="profile">
        <!-- photo like this? -->
        <div class="profile-pic" style="background: url(../static/images/users/Pics<?php echo $user['picture']; ?>) no-repeat center /auto 100%"></div>

        <ul class=profile-info>
            <li><b><?php echo $user['username']; ?></b></li>
            <li><?php echo $user['email']; ?></li>
            <li><?php echo $user['phone']; ?></li>
        </ul>

    </div>

    <?php drawPostList($user_posts);

} ?>