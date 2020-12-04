<?php 
include_once('../database/queries/db_post.php');
?>
<?php function drawPostList($posts) {
/**
 * Draws given posts using the draw_post function.
 */
?>

<div class="list">
  <?php 
    foreach($posts as $post)
      drawPostItem($post);
  ?>
</div>

<?php } ?>

<?php function drawPostItem($post) {
/**
 * Draws a given post.
 * using /100% on background favors portait frame (vertical) photos
 * using /auto 100% seems to favor most photos
 */ 
  $photo_path = '../static/images/' . $post['photo_id'] . '.' . $post['photo_extension'];
  $post_path = 'post.php?post_id=' . $post['post_id'];
?>
  <a href="<?=$post_path; ?>" class="list-item">
    <ul class="list-item-content">
      <li class="list-item-img">
        <div style="background: url('<?=$photo_path; ?>') no-repeat center /auto 100%"></div>
      </li>
      <li class="list-item-txt">
        <?=$post['name']; ?>
      </li>
    </ul>
  </a>

<?php } ?>

<?php function drawSearch($values) {
/** 
 * Draws the search bar
 */
?>
<form class="listfilter" action="../pages/list.php" method="GET">
  <div class="listfilter-item" >
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="<?php echo $values['name'] ?>">
  </div>

  <?php drawGenders(true, $values['gender']); ?>
  <div class="listfilter-item" >
    <label for="age">Age</label>
    <input id="age" type="text" name="age" value="<?php echo $values['age'] ?>">
  </div>
  <div class="listfilter-item" >
    <label for="size">Size</label>
    <input id="age" type="text" name="size" value="<?php echo $values['size'] ?>">
  </div>
  
  <?php drawSpecies(true, $values['species']); ?>
  <?php drawCities(true, $values['city']); ?>

  <br>
  <input class="listfilter-button" type="submit" value="Search">
</form>

<?php }?>


<?php function getFilterOptions() {
  $search_options = array();
  $query_conditions = array();

  $curr_name = '';
  if (isset($_GET['name']) && $_GET['name'] != null) {
    $curr_name = $_GET['name'];
    array_push($search_options, $_GET['name']);
    array_push($query_conditions, 'name LIKE ?');
  }

  $curr_age = '';
  if (isset($_GET['age']) && $_GET['age'] != null) {
    $curr_age = $_GET['age'];
    array_push($search_options, $_GET['age']);
    array_push($query_conditions, 'age = ?');
  }

  $curr_gender = 'any';
  if (isset($_GET['gender']) && $_GET['gender'] != "any") {
    $curr_gender = $_GET['gender'];
    array_push($search_options, $_GET['gender']);
    array_push($query_conditions, 'gender = ?');
  }

  $curr_size = '';
  if (isset($_GET['size']) && $_GET['size'] != null) {
    $curr_size = $_GET['size'];
    array_push($search_options, $_GET['size']);
    array_push($query_conditions, 'size = ?');
  }

  $curr_city = 'any';
  if (isset($_GET['city']) && $_GET['city'] != "any") {
    $curr_city = $_GET['city'];
    array_push($search_options, $_GET['city']);
    array_push($query_conditions, 'city_id = ?');
  }

  $curr_species = 'any';
  if (isset($_GET['species']) && $_GET['species'] != "any") {
    $curr_species = $_GET['species'];
    array_push($search_options, $_GET['species']);
    array_push($query_conditions, 'species_id = ?');
  }

  $current_values = array(
      'name'=> $curr_name,
      'age'=> $curr_age,
      'gender'=> $curr_gender,
      'size'=> $curr_size,
      'city'=> $curr_city,
      'species'=> $curr_species
  );

  $posts = getPosts($search_options, $query_conditions);
  return array(
      'posts'=>$posts,
      'values'=> $current_values);
}?>
