<?php
include_once('../database/database.php');

  /**
   * Returns all Pets
   */
  function getAllPets() {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Pet');
    $stmt->execute(array());
    return $stmt->fetchAll(); 
  }
?>
