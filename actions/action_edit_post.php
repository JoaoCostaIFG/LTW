<<<<<<< HEAD
<?php
    include_once('../pages/session.php');
    include_once('../database/queries/db_user.php');
    include_once('../database/queries/db_post.php');
    include_once('../actions/action_upload.php');

    // Check if file is not image
    $post_id = $_POST['post_id'];
    if (file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        $has_photo = true;
        $type = photoIsValid($_FILES['image']['tmp_name']);
        if ($type == null) {
            $_SESSION['messages'] = array('type' => 'error', 'content' => "Invalid photo!");
            die(header("Location: ../pages/post.php?post_id=$post_id"));
        }

    } else $has_photo = false;

    $user_id = getUserId($_SESSION['username'])['id'];
    if (!ownsPost($user_id, $post_id)) {
        $_SESSION['messages'] = array('type' => 'error', 'content' => "User doesn't own this post!");
        die(header("Location: ../pages/post.php?post_id=$post_id"));
    }
    
    $name = $_POST['name'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $color = $_POST['color'];
    $city = $_POST['city'];
    $post_info = array($name, $age, $size, $description, $date, $color, $city, $post_id);

    try {
        updatePost($post_info);
        if ($has_photo) {
            $photo_id = getPostPhoto($post_id)['photo_id'];
            updatePhoto($photo_id, $type, false);
        }

        $_SESSION['messages'] = array('type' => 'success', 'content' => 'Successfully edited post');
        header("Location: ../pages/post.php?post_id=$post_id");
    } catch (PDOException $e) {
        $_SESSION['messages'] = array('type' => 'error', 'content' => 'Failed to edit post!');
        die(header("Location: ../pages/post.php?post_id=$post_id"));
    }
?>
=======
<?php
  require_once '../pages/session.php';
  require_once '../database/queries/db_user.php';
  require_once '../database/queries/db_post.php';
  require_once '../actions/action_upload.php';
  require_once '../templates/tpl_utils.php';

    // Check if file is not image
    $post_id = $_POST['post_id'];
if (file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
    $has_photo = true;
    $type = photoIsValid($_FILES['image']['tmp_name']);
    if ($type == null) {
        setSessionMessage('error', "Invalid photo!");
        die(header("Location: ../pages/post.php?post_id=$post_id"));
    }

} else { $has_photo = false;
}

    $user_id = getUserId($_SESSION['username'])['id'];
if (!ownsPost($user_id, $post_id)) {
    setSessionMessage('error', "User doesn't own this post!");
    die(header("Location: ../pages/post.php?post_id=$post_id"));
}
    
    $name = $_POST['name'];
    $age = $_POST['age'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $color = $_POST['color'];
    $city = $_POST['city'];
    $post_info = array($name, $age, $size, $description, $date, $color, $city, $post_id);

try {
    updatePost($post_info);
    if ($has_photo) {
        $photo_id = getPostPhoto($post_id)['photo_id'];
        updatePhoto($photo_id, $type, false);
    }

    setSessionMessage('success', 'Successfully edited post');
    header("Location: ../pages/post.php?post_id=$post_id");
} catch (PDOException $e) {
    setSessionMessage('error', 'Failed to edit post!');
    die(header("Location: ../pages/post.php?post_id=$post_id"));
}
?>
>>>>>>> development
