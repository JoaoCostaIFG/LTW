<?php
include_once('connection.php');

function getAllNews() {
  global $db;
  $stmt = $db->prepare('
    SELECT news.*, users.*, COUNT(comments.id) AS comments
    FROM news JOIN
         users USING (username) LEFT JOIN
         comments ON comments.news_id = news.id
    GROUP BY news.id, users.username
    ORDER BY published DESC
  ');
  $stmt->execute();
  return $stmt->fetchAll();
}

function getArticleById($id) {
  global $db;
  $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = :id');
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch();
}

?>
