<?php
include_once('connection.php');

function getCommentById($id) {
  global $db;
  $stmt = $db->prepare('SELECT * FROM comments JOIN users USING (username) WHERE news_id = ?');
  $stmt->execute(array($id));
  return $stmt->fetchAll();
}

?>
