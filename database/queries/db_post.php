<?php
include_once('../database/database_instance.php');

    function insertPost($post) {
        $db = Database::instance()->db();
        $stmt = $db->prepare(
            'INSERT INTO PetPost VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute($post);
    }

  /**
   * Returns all Posts containing the name and photo of the pet
   */
  function getAllPosts() {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT DISTINCT post_id, name, photo_path
         FROM PetPost JOIN Photo ON(PetPost.id = post_id)
         GROUP BY PetPost.id' // Select only one from posts
    );
    $stmt->execute();
    return $stmt->fetchAll(); 
  }

  /**
   * Returns post information
   */
  function getPost($post_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT petpost.name as name, age, gender, size, description, petpost.date as date,
        Color.name as color, Species.name as species,
        City.name as location, User.username as user,
        photo_path
        FROM petpost JOIN Color on(petpost.color_id=color.id)
            JOIN Species on(petpost.species_id=species.id)
            JOIN City on(city.id = petpost.city_id)
            JOIN User on (User.id = petpost.user_id)
            JOIN Photo on (Photo.post_id = petpost.id)
        WHERE petpost.id=?'
    );
    $stmt->execute(array($post_id));
    $posts = $stmt->fetchAll(); 
    if (count($posts) > 0) // TODO
        return $posts[0];
    else return null;
  }
  /**
   * Returns a post comments
   */
  function getComments($post_id) {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT username, text, date
        FROM Comment JOIN User on(Comment.user_id = User.id)
        WHERE Comment.post_id=?'
    );
    $stmt->execute(array($post_id));
    return $stmt->fetchAll();
  }

  function getColors() {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT id, name
        FROM Color'
    );
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getSpecies() {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT Species.id, Species.name as species_name, Animal.name as animal_name
        FROM Species JOIN Animal ON (Species.animal_id = Animal.id)'
    );
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getCities() {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT id, name
        FROM City'
    );
    $stmt->execute();
    return $stmt->fetchAll();
  }
?>
