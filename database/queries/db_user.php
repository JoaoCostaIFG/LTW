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

function getUserId($username) {
       $db = Database::instance()->db();
       $stmt = $db->prepare(
           'SELECT id FROM User WHERE username LIKE ?'
       );
   
       $stmt->execute(array($username));
       return $stmt->fetch();
   }

?>

