<?php
require_once '../database/database_instance.php';

    /* INSERTS */
function insertPost($post)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO PetPost VALUES(NULL, ?, ?, ?, ?, ?, date("now"), ?, ?, ?, ?)'
    );
    $stmt->execute($post);
    return $db->lastInsertId();
}

function insertPhoto($post_id, $type)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO PetPhoto VALUES(NULL, ?, ?, ?)'
    );
    $date = date("Y-m-d");
    $stmt->execute(array($post_id, $type, $date));
    return $db->lastInsertId();
}

        /* GETTERS */

function ownsPost($user_id, $post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT * FROM PetPost
             WHERE id = ? AND
             user_id = ?'
    );
    $stmt->execute(array($post_id, $user_id));
    $post = $stmt->fetch();
    return $post != false;
}

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
function getPosts($search_options, $query_conditions_array, $from_clause)
{
    $query_conditions = conditionsToString($query_conditions_array);
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'SELECT DISTINCT PetPost.id as post_id, name, birth_date,
               cast(julianday(date("now")) - julianday(birth_date) as int) as age,
               gender, size, city_id, species_id,
             PetPhoto.id as photo_id, PetPhoto.extension as photo_extension
             FROM PetPost JOIN PetPhoto ON(PetPost.id = PetPhoto.post_id) ' .
        $from_clause .
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
            SELECT petpost.id, petpost.name, birth_date,
              cast(julianday(date("now")) - julianday(birth_date) as int) as age,
              gender, size, description, petpost.date, state,
              Color.id as color_id, Color.name as color,
              Species.id as species_id, Species.name as species,
              City.id as city_id, City.name as location,
              User.username as user, PetPhoto.id as photo_id, PetPhoto.extension as photo_extension
            FROM PetPost JOIN Color on(PetPost.color_id=color.id)
                JOIN Species on(PetPost.species_id=species.id)
                JOIN City on(city.id = PetPost.city_id)
                JOIN User on (User.id = PetPost.user_id)
                JOIN PetPhoto on (PetPhoto.post_id = PetPost.id)
            WHERE petpost.id=?'
    );
    $stmt->execute(array($post_id));
    return $stmt->fetch();
}

function getPostPhoto($post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        '
            SELECT PetPhoto.id as photo_id, PetPhoto.extension as photo_extension
            FROM PetPost JOIN PetPhoto on (PetPhoto.post_id = PetPost.id)
            WHERE PetPost.id=?'
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
            WHERE Question.post_id=?'
    );
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

function insertQuestion($user_id, $post_id, $question)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO Question VALUES(NULL, ?, ?, ?, ?)'
    );
      
    $stmt->execute(array($user_id, $post_id, $question, date("d/m/Y")));
    return $db->lastInsertId();
}

function insertAnswer($user_id, $question_id, $answer)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'INSERT INTO Answer VALUES(NULL, ?, ?, ?, ?)'
    );
      
    $stmt->execute(array($user_id, $question_id, $answer, date("d/m/Y")));
}

  /* UPDATES */
function updatePost($post_info)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'UPDATE PetPost
             SET name = ?,
                birth_date = ?,
                size = ?,
                description = ?,
                state = ?,
                color_id = ?,
                city_id = ?
             WHERE id = ?'
    );
    $stmt->execute($post_info);
}

    /* DELETE */
function deletePost($post_id)
{
    $db = Database::instance()->db();
    $stmt = $db->prepare(
        'DELETE FROM Petpost
             WHERE id = ?'
    );
    $stmt->execute(array($post_id));
}
?>
