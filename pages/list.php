<?php
  include_once('session.php');
  include('../templates/common/tpl_header.php');
  include_once('../templates/tpl_petInfo.php');
?>

<?php
  include('../templates/tpl_list.php');
  $name_placeholder = 'Name';
  $age_placeholder = 'Age';
  $size_placeholder = 'Size';
  $city_placeholder = 'City';
  $species_placeholder = 'Species';

  $search_options = array();
  $query_conditions = array();
  echo("\n---");
  print_r($_POST['species']);
  echo("--\n");
  if (isset($_POST['name']) && $_POST['name'] != null) {
    array_push($search_options, $_POST['name']);
    array_push($query_conditions, 'name LIKE ?');
    $name_placeholder = $_POST['name'];
  }

  if (isset($_POST['age']) && $_POST['age'] != null) {
    array_push($search_options, $_POST['age']);
    array_push($query_conditions, 'age = ?');
    $age_placeholder = $_POST['age'];
  }

  if (isset($_POST['gender']) && $_POST['gender'] != 'any') {
    array_push($search_options, $_POST['gender']);
    array_push($query_conditions, 'gender = ?');
    $gender_placeholder = $_POST['gender'];
  }

  if (isset($_POST['size']) && $_POST['size'] != null) {
    array_push($search_options, $_POST['size']);
    array_push($query_conditions, 'size = ?');
    $size_placeholder = $_POST['size'];
  }

  if (isset($_POST['city']) && $_POST['city'] != 'any') {
    array_push($search_options, $_POST['city']);
    array_push($query_conditions, 'city_id = ?');
    $city_placeholder = $_POST['city'];
  }

  if (isset($_POST['species']) && $_POST['species'] != 'any') {
    array_push($search_options, $_POST['species']);
    array_push($query_conditions, 'species_id = ?');
    $species_placeholder = $_POST['species'];
  }

  $posts = getAllPosts($search_options, $query_conditions);
?>

<form class="listfilter" action="../pages/list.php" method="post">
  <br>
  <input type="text" name="name" placeholder="<?php echo $name_placeholder ?>">
  <?php drawGenders(true); ?>
  <input type="text" name="age" placeholder="<?php echo $age_placeholder ?>">
  <input type="text" name="size" placeholder="<?php echo $size_placeholder ?>">
  <?php drawSpecies(true); ?>
  <?php drawCities(true); ?>

  <br>
  <input type="submit" value="Search">
</form>

<?php 

  drawPostList($posts);
  include('../templates/common/tpl_footer.php');
?>
