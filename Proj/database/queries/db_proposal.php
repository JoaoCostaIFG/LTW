<?php
require_once '../includes/database.php';

    /* INSERTS */
function insertProposal($user_id, $post_id)
{
    $db = Database::instance()->db();
    $date = date("Y-m-d");
    $stmt = $db->prepare(
        'INSERT INTO Proposal VALUES(?, ?, -1, ?)'
    );
    $stmt->execute(array($user_id, $post_id, $date));
    return $db->lastInsertId();
}

function hasProposal($user_id, $post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT accepted FROM Proposal 
             WHERE user_id = ? AND
             post_id = ?'
    );
    $stmt->execute(array($user_id, $post_id));
    $proposal = $stmt->fetch();
    return $proposal != false;
}

function hasAcceptedProposal($post_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT user_id FROM Proposal 
             WHERE accepted = 1 AND
             post_id = ?'
    );
    $stmt->execute(array($post_id));
    $proposal = $stmt->fetch();
    return $proposal;
}

    /* GETTERS */
function getSentProposals($user_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT Poster.id as poster_id, Poster.username as poster_username, accepted as status,
                PetPost.id as post_id, PetPost.name as pet_name,
                PetPhoto.id as photo_id, PetPhoto.extension as photo_extension
             FROM Proposal JOIN
                PetPost ON(Proposal.post_id = PetPost.id) JOIN
                PetPhoto ON(PetPhoto.post_id = PetPost.id) JOIN
                User as Poster ON(Poster.id = PetPost.user_id)
             WHERE Proposal.user_id = ?
             GROUP BY PetPost.id'
    );
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}

function getReceivedProposals($user_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT User.id as user_id, User.username as user_username, accepted as status,
                PetPost.id as post_id, PetPost.name as pet_name,
                PetPhoto.id as photo_id, PetPhoto.extension as photo_extension
             FROM Proposal JOIN
                PetPost ON(Proposal.post_id = PetPost.id) JOIN
                User as Poster ON(Poster.id = PetPost.user_id) JOIN
                User ON(User.id = Proposal.user_id) JOIN
                PetPhoto
             WHERE Poster.id = ? AND
                PetPhoto.id IN(
                    SELECT PetPhoto.id
                    FROM PetPhoto
                    WHERE PetPhoto.post_id = PetPost.id
                    GROUP BY PetPhoto.post_id
                )
         ORDER BY Proposal.accepted ASC'
    );
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}

function getReceivedNotAcceptedProposals($user_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT User.id as user_id, User.username as user_username, accepted as status,
                PetPost.id as post_id, PetPost.name as pet_name
             FROM Proposal JOIN
                PetPost ON(Proposal.post_id = PetPost.id) JOIN
                User as Poster ON(Poster.id = PetPost.user_id) JOIN
                User ON(User.id = Proposal.user_id)
             WHERE Poster.id = ? AND Proposal.accepted < 0'
    );
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}

function getProposalStatus($user_id, $post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT accepted as status
             FROM Proposal
             WHERE Proposal.user_id = ? AND Proposal.post_id = ?'
    );
    $stmt->execute(array($user_id, $post_id));
    return $stmt->fetch();
}

    /* UPDATES */
function acceptProposal($user_id, $post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'UPDATE Proposal
             SET accepted = 1
             WHERE user_id = ? AND post_id = ?'
    );
    $stmt->execute(array($user_id, $post_id));
}

function rejectProposal($user_id, $post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'UPDATE Proposal
             SET accepted = 0
             WHERE user_id = ? AND post_id = ?'
    );
    $stmt->execute(array($user_id, $post_id));
}
?>
