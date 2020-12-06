<?php
require_once '../database/database_instance.php';

    /* INSERTS */

function insertPost($post)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO PetPost VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute($post);
    return $db->lastInsertId();
}

function insertPhoto($post_id, $type)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO Photo VALUES(NULL, ?, ?, ?)'
    );
    $date = date("Y-m-d");
    $stmt->execute(array($post_id, $type, $date));
    return $db->lastInsertId();
}

    /* GETTERS */

function conditionsToString($query_conditions_array)
{
    if (count($query_conditions_array) == 0) {
        return '';
    }
    $res = 'WHERE ';
    $i = 0;
    while ($i < (count($query_conditions_array) - 1)) {
        $res .= $query_conditions_array[$i] . ' AND ';
        $i += 1;
    }
    $res .= $query_conditions_array[$i];
    return $res;
}

  /**
   * Returns all Posts containing the name and photo of the pet
   */
function getPosts($search_options, $query_conditions_array)
{
    $query_conditions = conditionsToString($query_conditions_array);
    $db = Database::instance()->db();
    echo '<br>';
    $stmt = $db->prepare(
        'SELECT DISTINCT post_id, name, age, gender, size, city_id, species_id,
         Photo.id as photo_id, Photo.extension as photo_extension
         FROM PetPost JOIN Photo ON(PetPost.id = post_id) ' .
        $query_conditions .
        ' GROUP BY PetPost.id'
    );
    $stmt->execute($search_options);
    return $stmt->fetchAll(); 
}

  /**
   * Returns post information
   */
function getPost($post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT petpost.id, petpost.name, age, gender, size, description, petpost.date,
        Color.name as color, Species.name as species, City.name as location,
        User.username as user, Photo.id as photo_id, Photo.extension as photo_extension
        FROM petpost JOIN Color on(petpost.color_id=color.id)
            JOIN Species on(petpost.species_id=species.id)
            JOIN City on(city.id = petpost.city_id)
            JOIN User on (User.id = petpost.user_id)
            JOIN Photo on (Photo.post_id = petpost.id)
        WHERE petpost.id=?'
    );
    $stmt->execute(array($post_id));
    return $stmt->fetch();
}
  /**
   * Returns a post comments
   */
function getComments($post_id)
{
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

  /**
   * Returns a post comments
   */
function getQuestionsAnswers($post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT Question.text as question, Answer.text as answer, 
        Question.date as question_date, Answer.date as answer_date,
        Question.user_id as user_id,Question.id as id
        FROM Question LEFT JOIN Answer on (Question.id = Answer.question_id)
        WHERE Question.post_id=?');
    $stmt->execute(array($post_id));
    return $stmt->fetchAll();
}

function getColors()
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT id, name
        FROM Color'
    );
    $stmt->execute();
    return $stmt->fetchAll();
}

function getSpecies()
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT Species.id, Species.name as species_name, Animal.name as animal_name
        FROM Species JOIN Animal ON (Species.animal_id = Animal.id)'
    );
    $stmt->execute();
    return $stmt->fetchAll();
}

  // Text input is already validated
function insertComment($user_id, $post_id, $text)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO Comment VALUES(NULL, ?, ?, ?, ?)'
    );
    
    $stmt->execute(array($user_id, $post_id, $text, date("d/m/Y")));
}

function getCities()
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
        SELECT id, name
        FROM City'
    );
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function insertQuestion($user_id, $post_id, $question) {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
      'INSERT INTO Question VALUES(NULL, ?, ?, ?, ?)'
    );
    
    $stmt->execute(array($user_id, $post_id, $question, date("d/m/Y")));
  }

  function insertAnswer($user_id, $question_id, $answer) {
    $db = Database::instance()->db();
    $stmt = $db->prepare(
      'INSERT INTO Answer VALUES(NULL, ?, ?, ?, ?)'
    );
    
    $stmt->execute(array($user_id, $question_id, $answer, date("d/m/Y")));
  }
?>

