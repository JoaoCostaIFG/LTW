<?php
include_once('../database/database.php');

  /**
   * Returns all Posts containing the name and photo of the pet
   */
  function getAllPosts() {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT name, photo_path
         FROM PetPost JOIN Photo ON(PetPost.id = post_id)'
    );
    $stmt->execute();
    return $stmt->fetchAll(); 
  }
?>
