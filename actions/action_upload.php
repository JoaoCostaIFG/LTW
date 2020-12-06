<?php
    require_once '../pages/session.php';
    require_once '../database/queries/db_post.php';

function photoIsValid($image_path)
{
    // exif_imagetype only works on files bigger than 11 bytes
    if (filesize($image_path) > 11) {
        $type = exif_imagetype($image_path);
    } else {
        $type = false;
    }

    $type = exif_imagetype($image_path);
    if ($type == false || ($type !== IMAGETYPE_PNG && $type !== IMAGETYPE_JPEG)) {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Image is not a jpg or png file!');
        return false;
    }
    return $type;
}

function uploadPetPhoto($post_id, $type)
{
    if ($type === IMAGETYPE_PNG) {
        $img_type = "png";
    } else if ($type === IMAGETYPE_JPEG) {
        $img_type = "jpg";
    } else {
        return;
    }

    $id = insertPhoto($post_id, $img_type);

    // Generate filenames for original, small and medium files
    $originalFileName .= "../static/images/";
    $originalFileName .= "$id.$img_type";
    //$smallFileName = "images/thumbs_small/$id.jpg";

    //$mediumFileName = "images/thumbs_medium/$id.jpg";

    // Move the uploaded file to its final destination
    move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

    // Crete an image representation of the original image
    //$original = imagecreatefromjpeg($originalFileName);

    //$width = imagesx($original);     // width of the original image
    //$height = imagesy($original);    // height of the original image
    //$square = min($width, $height);  // size length of the maximum square
    
    // Create and save a small square thumbnail
    //$small = imagecreatetruecolor(200, 200);
    //imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
    //imagejpeg($small, $smallFileName);

    // Calculate width and height of medium sized image (max width: 400)
    //$mediumwidth = $width;
    //$mediumheight = $height;
    //if ($mediumwidth > 400) {
    //$mediumwidth = 400;
    //$mediumheight = $mediumheight * ( $mediumwidth / $width );
    //}

    // Create and save a medium image
    //$medium = imagecreatetruecolor($mediumwidth, $mediumheight);
    //imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, $mediumheight, $width, $height);
    //imagejpeg($medium, $mediumFileName);
}

function uploadUserPhoto($user_id, $type)
{
    if ($type === IMAGETYPE_PNG) {
        $img_type = "png";
    } else if ($type === IMAGETYPE_JPEG) {
        $img_type = "jpg";
    } else {
        return;
    }

    // Generate filenames for original, small and medium files
    $originalFileName .= "../static/users/";
    $originalFileName .= "$user_id.$img_type";

    move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

    return $originalFileName;
}
?>
