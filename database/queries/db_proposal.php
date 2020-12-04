<?php
include_once('../database/database_instance.php');

    function insertProposal($user_id, $post_id) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'INSERT INTO Proposal VALUES(NULL, ?, ?, 0)'
        );
        $stmt->execute(array($user_id, $post_id));
        return $db->lastInsertId();
    }

    function hasProposal($user_id, $post_id) {
        $tmp = $user_id . '-' . $post_id;
        echo "<script> console.log('$tmp')</script>";
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT * FROM Proposal 
             WHERE user_id = ? AND
             post_id = ?'
        );
        $stmt->execute(array($user_id, $post_id));
        $proposal = $stmt->fetch;
        return $proposal != false;
    }
?>
