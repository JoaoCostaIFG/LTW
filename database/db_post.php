<?php
include_once('../database/database_instance.php');

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
        SELECT petpost.name as name, age, gender, size, description, date,
        Color.name as color_name, Species.name as species_name,
        City.name as city_name, User.username as user_name
        FROM petpost JOIN Color on(petpost.color_id=color.id)
            JOIN Species on(petpost.species_id=species.id)
            JOIN City on(city.id = petpost.city_id)
            JOIN User on (User.id = petpost.user_id)
        WHERE petpost.id=' . $post_id
    );
    $stmt->execute();
    $posts = $stmt->fetchAll(); 
    if (count($posts) > 0)
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
        WHERE Comment.user_id=' . $post_id
    );
    $stmt->execute();
    return $stmt->fetchAll(); 
  }
?>
