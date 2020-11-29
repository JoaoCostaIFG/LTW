<?php 
include_once('../database/queries/db_user.php');
include_once('../database/queries/db_post.php');

function drawPost($post, $comments) {
/**
 * Draws given a given post page
 */
?>

    <h2>
      <b><?php echo $post['name']; ?></b> </br>
      for adoption from <b><?php echo $post['user']; ?></b>
    </h2>
    <div class="petpost">
      <ul>
        <li class="list-item-img">
        <?php echo '<div style="background: url( ../static/images/' . $post['photo_path'] . ') no-repeat center /auto 100%"></div>'?>
          <!-- <div style="background: url('<?php echo $post['photo_path']; ?>') no-repeat center /auto 100%"></div> -->
        </li>
        <li>Name: <b><?php echo $post['name']; ?></b></li>
        <li>Age: <b><?php echo $post['age']; ?></b></li>
        <li>Breed: <b><?php echo $post['species']; ?></b></li>
        <li>Genre: <b><?php echo $post['gender']; ?></b></li>
        <li>Size: <b><?php echo $post['size']; ?></b></li>
        <li>Location: <b><?php echo $post['location']; ?></b></li>
      </ul>
      <?php echo $post['date']; ?>
    </div>
    
    <?php echo $post['description']; ?>

    <?php
    foreach($comments as $comment) {
        echo '<br>';
        drawComment($comment);
    }
    ?>
<?php } ?>

<?php function drawComment($comment) {
/**
 * Draws given a comment
 */
?>
    <h2> <?php echo $comment['date']; ?> </h2>
    <h2> <?php echo $comment['username']; ?> </h2>
    <p> <?php echo $comment['text']; ?> </p>
<?php } ?>

<?php function drawAddPost() { 
/** TODO Meter min e max's
 * Draws a form to add a post
 */

    //species_id INTEGER REFERENCES Species(id),
    //city_id INTEGER REFERENCES City(id),
?>
    <section id="addPost">
        <header><h2>Create a new Post</h2></header>

        <form method="post" action="../actions/action_add_post.php">
            <p>Name <input type="text" name="name" placeholder="name of the pet" required></p>
            <p>Age<input type="number" name="age" placeholder="age of the pet" required></p>

            <p>Gender<br><input type="radio" id="male" name="gender" value="0">
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="1">
            <label for="female">Female</label><br></p>

            <p>Size<input type="number" name="size" placeholder="size" required></p>
            <p>Description<textarea id="description" name="description" rows="4" cols="50"> </textarea></p>
            <p>Date<input type="date" name="date" placeholder="date of birth of your pet" required></p>

            <?php drawColors();?>
            <?php drawAllSpecies();?>
            <?php drawCities();?>
            <p><input type="submit" value="Add pet"></p>
        </form>
    </section>

<?php } ?>

<?php function drawColors() {
    /*
    * Draws all colors in the database
    */
    echo '<p>Color<select name="color" id="color">';

    $colors = getColors();
    foreach ($colors as $color)
        drawColor($color);
    echo'</p></select>';
}
?>

<?php function drawColor($color) {
    /*
    * Draws a given color
    */
    $color_id = $color['id'];
    $color_name = $color['name'];
    echo '<option value="' . $color_id . '">' . $color_name . '</option>';
}
?>

<?php function drawAllSpecies() {
    /*
    * Draws all species in the database
    */
    echo '<p>Species<select name="species" id="species">';

    $allSpecies = getSpecies();
    foreach ($allSpecies as $species)
        drawSpecies($species);
    echo'</p></select>';
}
?>

<?php function drawSpecies($species) {
    /*
    * Draws a given species
    */
    $species_id = $species['id'];
    $species_name = $species['species_name'];
    $animal_name = $species['animal_name'];
    $species_animal = $animal_name . ' - ' . $species_name;
    echo '<option value="' . $species_id . '">' . $species_animal . '</option>';
}
?>

<?php function drawCities() {
    /*
    * Draws all Cities in the database
    */
    echo '<p>City<select name="city" id="city">';

    $cities = getCities();
    foreach ($cities as $city)
        drawCity($city);
    echo'</p></select>';
}
?>

<?php function drawCity($city) {
    /*
    * Draws a given city
    */
    $city_id = $city['id'];
    $city_name = $city['name'];
    echo '<option value="' . $city_id . '">' . $city_name . '</option>';
}
?>
