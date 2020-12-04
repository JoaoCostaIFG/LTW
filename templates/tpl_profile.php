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
        <!-- photo like this? -->
        <?php 
            if($user['picture'] != null) $pic = $user['picture'];
            else $pic = "default.png";
        ?>
        <img src="../static/images/usersPics/<?php echo $pic ?>" alt="User Profile Picture" width="400">
        <ul class=profile-info>
            <li><b><?php echo $user['username']; ?></b></li>
            <li><?php echo $user['email']; ?></li>
            <li><?php echo $user['mobile_number']; ?></li>
        </ul>

    </div>

    <h3>
        <b>Posts by <?php echo $user['username']?></b>
    </h3>

    <?php drawPostList($user_posts);

} ?>