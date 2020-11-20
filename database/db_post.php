<?php
include_once('../database/database_instance.php');

  /**
   * Returns all Posts containing the name and photo of the pet
   */
  function getAllPosts() {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT DISTINCT name, photo_path
         FROM PetPost JOIN Photo ON(PetPost.id = post_id)
         GROUP BY PetPost.id' // Select only one from posts
    );
    $stmt->execute();
    return $stmt->fetchAll(); 
  }
?>
