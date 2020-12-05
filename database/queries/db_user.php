<?php
require_once '../database/database_instance.php';

function checkUserPassword($username, $password)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT * FROM User WHERE username = ?'
    );
    $stmt->execute(array($username));
    $user = $stmt->fetch(); 

    return $user !== false && password_verify($password, $user['password']); // Verify hash
}

function insertUser($username, $password, $email, $mobile_number)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO User VALUES(NULL, ?, ?, ?, ?)'
    );

    // Default is bcrypt
    $options = ['cost' => 12]; // Default is 10 but 12 is better
    $stmt->execute(
        array($username, password_hash($password, PASSWORD_DEFAULT, $options),
        $email, $mobile_number)
    );
    return $db->lastInsertId();
}

/**
 * Retrieves user public info given an username
 */
function getUserInfo($username) {
    $user_id = getUserId($username)['id'];
    
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT id, username, email, mobile_number 
        FROM User 
        WHERE User.id = ?'
    );

    $stmt->execute(array($user_id));
    $users = $stmt->fetchAll();         

    if (count($users) > 0) return $users[0];
    else return null;
}

/**
 * Returns all Posts made by an User
 */
function getPostsByUser($username) {

$user_id = getUserId($username)['id'];

$db = Database::instance()->db();
$stmt = $db->prepare(
    'SELECT DISTINCT post_id, name,
    Photo.id as photo_id, Photo.extension as photo_extension
        FROM PetPost 
        JOIN Photo ON(PetPost.id = Photo.post_id)
        JOIN User ON(User.id = PetPost.user_id)
        WHERE User.id = ?
        GROUP BY PetPost.id'
);
$stmt->execute(array($user_id));
return $stmt->fetchAll(); 
}

function getUserId($username)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT id FROM User WHERE username LIKE ?'
    );

    // Default is bcrypt
    $stmt->execute(array($username));
    return $stmt->fetch();
}

function isOwner($user_id, $post_id)
{
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT * FROM PetPost 
             WHERE id = ? AND user_id = ?'
        );
        $stmt->execute(array($post_id, $user_id));
        $post = $stmt->fetch();
        return $post != false;
}

function isFavourite($user_id, $post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT * FROM Favourite 
            WHERE post_id = ? AND user_id = ?'
    );
    $stmt->execute(array($post_id, $user_id));
    $favourite = $stmt->fetch();
    return $favourite != false;
}

function addFavouritePost($user_id, $post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO Favourite VALUES(?, ?)'
    );
    $stmt->execute(array($user_id, $post_id));
}

function removeFavouritePost($user_id, $post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'DELETE FROM Favourite 
      WHERE post_id = ? AND user_id = ?'
    );
    $stmt->execute(array($post_id, $user_id));
}

function updateUser($user_info){
    $db = Database::instance()->db();

    if($user_info['username']){
        $stmt_username = $db->prepare(
            'UPDATE User SET username = ? 
            WHERE id = ?'
        );
    
        $stmt_username->execute(array($user_info['username'], $user_info['id']));
    }

    if($user_info['email']){
        $stmt_email = $db->prepare(
            'UPDATE User SET email = ? 
            WHERE id = ?'
        );
    
        $stmt_email->execute(array($user_info['email'], $user_info['id']));
    }

    if($user_info['mobile_number']){
        $stmt_mobile_number = $db->prepare(
            'UPDATE User SET mobile_number = ? 
            WHERE id = ?'
        );
    
        $stmt_mobile_number->execute(array($user_info['mobile_number'], $user_info['id']));
    }
}

?>

