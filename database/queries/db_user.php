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

function insertUser($username, $password, $email, $mobile_number, $extension)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO User VALUES(NULL, ?, ?, ?, ?, ?)'
    );

    // Default is bcrypt
    $options = ['cost' => 12]; // Default is 10 but 12 is better
    $stmt->execute(
        array($username, password_hash($password, PASSWORD_DEFAULT, $options),
        $email, $mobile_number, $extension)
    );
    return $db->lastInsertId();
}

/**
 * Retrieves user public info given an username
 */
function getUserInfo($username)
{
    $user_id = getUserId($username)['id'];
    
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT id, username, email, mobile_number, extension
        FROM User 
        WHERE User.id = ?'
    );

    $stmt->execute(array($user_id));
    $users = $stmt->fetchAll();         

    if (count($users) > 0) { return $users[0];
    } else { return null;
    }
}

function getAllUsers() {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT id, username, email, mobile_number, extension
        FROM User'
    );

    $stmt->execute();
    $users = $stmt->fetchAll();         

    return $users;

}

/**
 * Returns all Posts made by an User
 */
function getPostsByUser($username)
{

    $user_id = getUserId($username)['id'];

    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT DISTINCT post_id, name,
    PetPhoto.id as photo_id, PetPhoto.extension as photo_extension
        FROM PetPost 
        JOIN PetPhoto ON(PetPost.id = PetPhoto.post_id)
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

function getUsername($user_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT username FROM User WHERE id LIKE ?'
    );

    // Default is bcrypt
    $stmt->execute(array($user_id));
    return $stmt->fetch()['username'];
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

function updateUser(&$user_info)
{
    /* for some reason, php casts the NULL inside the array to the empty string */
    $db = Database::instance()->db();

    $querry_str = 'UPDATE User SET';
    $querry_array = array();

    if($user_info['username']) {
        $querry_str .= ' username = ?,';
        array_push($querry_array, $user_info['username']);
    }
    if($user_info['email']) {
        $querry_str .= ' email = ?,';
        array_push($querry_array, $user_info['email']);
    }
    if($user_info['mobile_number']) {
        $querry_str .= ' mobile_number = ?,';
        array_push($querry_array, $user_info['mobile_number']);
    }
    if($user_info['picture']) {
        $querry_str .= ' picture = ?,';
        array_push($querry_array, $user_info['picture']);
    }
    if($user_info['password']) {
        $querry_str .= ' password = ?,';
        $options = ['cost' => 12]; // Default is 10 but 12 is better
        array_push($querry_array, password_hash($user_info['password'], PASSWORD_DEFAULT, $options), $user_info['id']);
    }

    // don't do update if there is nothing to update
    if(empty($user_info))
      return false;

    array_push($querry_array, $user_info['id']);
    $querry_str = trim($querry_str, ",");
    $querry_str .= ' WHERE id = ?';

    $stmt = $db->prepare($querry_str);
    $stmt->execute($querry_array);
}
?>
