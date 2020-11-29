<?php
include_once('../database/database_instance.php');

function checkUserPassword($username, $password) {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT * FROM User WHERE username = ?'
    );
    $stmt->execute(array($username));
    $user = $stmt->fetch(); 

    return $user !== false && password_verify($password, $user['password']); // Verify hash
}

function insertUser($username, $password, $picture, $email, $mobile_number) {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO User VALUES(NULL, ?, ?, ?, ?, ?)'
    );

    // Default is bcrypt
    $options = ['cost' => 12]; // Default is 10 but 12 is better
    $stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options),
        $picture, $email, $mobile_number));
}

/**
 * Retrieves user public info given an username
 */
function getUserPublicInfo($user_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT username, picture, email, mobile_number 
        FROM User 
        WHERE User.id = ?'
    );

    $stmt->execute(array($user_id));
    $users = $stmt->fetchAll(); 

    if (count($users) > 0) return $users[0];
    else return null;
}

?>
