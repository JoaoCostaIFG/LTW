<?php
include_once('../database/database_instance.php');

    function insertProposal($user_id, $post_id) {
        $db = Database::instance()->db();
        $date = date("Y-m-d");
        $stmt = $db->prepare(
            'INSERT INTO Proposal VALUES(?, ?, 0, ?)'
        );
        $stmt->execute(array($user_id, $post_id, $date));
        return $db->lastInsertId();
    }

    function hasProposal($user_id, $post_id) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'SELECT * FROM Proposal 
             WHERE user_id = ? AND
             post_id = ?'
        );
        $stmt->execute(array($user_id, $post_id));
        $proposal = $stmt->fetch();
        return $proposal != false;
    }
?>
