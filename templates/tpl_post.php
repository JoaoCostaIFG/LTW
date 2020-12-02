<?php
include_once('../database/queries/db_user.php');
include_once('../database/queries/db_post.php');

/* GETTERS */

function ageToString($age) {
  $years=intdiv($age, 12);
  $months=$age % 12;

  $ret="";
  if ($years == 0) {
    if ($months != 0)
      $ret=$months . " months old";
    else
      $ret="0 years old";
  }
  else {
    $ret=$years . " years";
    if ($months != 0)
      $ret=$ret . " and " . $months . " months old";
    else
      $ret=$ret . " old";
  }
  return $ret;
}

function genderToString($gender) {
  if ($gender == 0)
    return "Male";
  else
    return "Female";
}

function sizeToString($size) {
  if ($size == 1)
    return "Small";
  else if ($size == 2)
    return "Medium";
  else
    return "Big";
}

/* DRAWERS */

function drawPost($post, $comments) {
/**
 * Draws given a given post page
 */
?>
  <div class="petpost-page">

  <h2>
    <b><?php echo $post['name']; ?></b> </br>
    for adoption from <b><?php echo $post['user']; ?></b>
  </h2>
  <div class="petpost-img" style="background: url(../static/images/<?php echo $post['photo_path']; ?>) no-repeat center /auto 100%"></div>
  <ul class="petpost">
    <li>Name: <b><?php echo $post['name']; ?></b></li>
    <li>Age: <b><?php echo ageToString($post['age']); ?></b></li>
    <li>Breed: <b><?php echo $post['species']; ?></b></li>
    <li>Genre: <b><?php echo genderToString($post['gender']); ?></b></li>
    <li>Size: <b><?php echo sizeToString($post['size']); ?></b></li>
    <li>Location: <b><?php echo $post['location']; ?></b></li>
    <li>Posted in: <b><?php echo $post['date']; ?></b></li>
  </ul>

  <br>
  <br>
  
  <h3>Description</h3>
  <div class="petpost-description">
    <p> <?php echo $post['description']; ?> </p>
  </div>

  <h3>Comments</h3>
<?php
  $cnt=0;
  foreach($comments as $comment) {
    $cnt=$cnt + 1;
    drawComment($comment);
    echo '<br>';
  }
  if ($cnt == 0)
    echo "<i>There are no comments on this post. Be the first one</i>";
?>

</div>
<?php } ?>

<?php function drawComment($comment) {
/**
 * Draws given a comment
 */
?>
  <div class="petpost-comment" >
    <p><?php echo $comment['text']; ?></p>
    <p><?php echo $comment['date'] . ", " . $comment['username']; ?></p>
  </div>
<?php } ?>

<?php function drawAddPost() { 
/** TODO Meter min e max's
 * Draws a form to add a post
 */
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
