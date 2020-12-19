<?php

require_once '../database/queries/db_post.php';
require_once '../database/queries/db_user.php';
require_once '../includes/utils.php';
require_once 'tpl_petInfo.php';

?>
<?php function drawPostList($posts)
{
    /**
     * Draws given posts using the draw_post function.
     */
    ?>
<div class="list">
    <?php 
    if (empty($posts)) {
        echo "There are no posts to show.";
    }
    else {
        foreach($posts as $post) {
            drawPostItem($post);
        }
    }
    ?>
</div>
<?php } ?>

<?php function drawFavouriteStar($post)
{
    if(isset($_SESSION['username']) && isset($post['isFavourite'])) { ?>
  <div class="favourite-star">
        <?php if ($post['isFavourite']) {
            echo '&bigstar;';
        }?>
  </div>
    <?php }
} ?>

<?php function drawPostItem($post)
{
    /**
     * Draws a given post.
     * using /100% on background favors portait frame (vertical) photos
     * using /auto 100% seems to favor most photos
     */ 
    $photo_path = '../static/images/' . urlencode($post['photo_id']) . '.' . urlencode($post['photo_extension']);
    $post_path = 'post.php?post_id=' . urlencode($post['post_id']);
    ?>

  <a class="nounderline list-item" href="<?php echo $post_path; ?>">
    <?php drawFavouriteStar($post); //Draws favourite star if logged in?>
    <div class="petimage">
      <div class="list-item-img" style="background: url('<?php echo $photo_path; ?>') no-repeat center /auto 100%"></div>
    </div>
    <div class="list-item-txt">
      <?php echo htmlspecialchars($post['name']); ?>
    </div>
  </a>
<?php } ?>

<?php function drawSearch($values)
{
    /** 
     * Draws the search bar
     */
    ?>
<header><h1>Pet list</h1></header>

<form class="listfilter" action="../pages/list.php" method="GET">
  <div class="form-item listfilter-item" >
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="<?php echo $values['name'] ?>">
  </div>
  <div class="form-item listfilter-item" >
    <?php drawGenders(true, $values['gender']); ?>
  </div>
  <div class="form-item listfilter-item" >
    <label for="min_age">Min. Age (Years)</label>
    <input id="min_age" min="0" type="number" name="min_age" value="<?php echo htmlspecialchars($values['min_age']) ?>">
  </div>
  <div class="form-item listfilter-item" >
    <label for="max_age">Max. Age (Years)</label>
    <input id="max_age" min="0" type="number" name="max_age" value="<?php echo htmlspecialchars($values['max_age']) ?>">
  </div>
  <br>
  <div class="form-item listfilter-item listfilter-item-bottom" >
    <?php drawSizes(true, $values['size']); ?>
  </div>
  <div class="form-item listfilter-item listfilter-item-bottom" >
    <?php drawStatesSearch($values['state']); ?>
  </div>
  <div class="form-item listfilter-item listfilter-item-bottom" >
    <?php drawSpecies(true, $values['species']); ?>
  </div>
  <div class="form-item listfilter-item listfilter-item-bottom" >
    <?php drawCities(true, $values['city']); ?>
  </div>
  <br>
    <?php if(isset($_SESSION['username'])) { ?>
  <div class="form-item listfilter-item listfilter-item-bottom" >
    <label for="favourite">Favourite</label>
    <input id="favourite" type="checkbox" name="favourite" value="true"
        <?php if($values['favourite'] == "true") {
            echo 'checked';
        } ?> >
  </div>
    <?php } ?>
  <input class="form-button listfilter-button" type="submit" value="Search" onclick="saveForm()">
</form>

<script src="../js/store_session.js" type="text/javascript" defer></script>

<?php }?>


<?php function getFilterOptions()
{
    $search_options = array();
    $query_conditions = array();
    $from_clause = "";

    $curr_favourite = "false";
    if (isset($_GET['favourite']) && $_GET['favourite'] == "true") {
        $curr_favourite = $_GET['favourite'];
        $from_clause .= 'JOIN Favourite ON(Favourite.user_id = ? AND Favourite.post_id = PetPost.id)';
        $user_id = getUserId($_SESSION['username'])['id'];
        array_push($search_options, $user_id);
    }

    $curr_name = '';
    if (isset($_GET['name']) && $_GET['name'] != null) {
        $curr_name = $_GET['name'];
        array_push($search_options, $_GET['name']);
        array_push($query_conditions, 'name LIKE ?');
    }

    $curr_min_age = '';
    if (isset($_GET['min_age']) && $_GET['min_age'] != null) {
        $curr_min_age = $_GET['min_age'];
        /* Minimum Age */
        array_push($search_options, $_GET['min_age'] * 365);
        array_push($query_conditions, 'age >= ?');
    }

    $curr_max_age = '';
    if (isset($_GET['max_age']) && $_GET['max_age'] != null) {
        $curr_max_age = $_GET['max_age'];
        /* Maximum Age */
        array_push($search_options, $_GET['max_age'] * 365);
        array_push($query_conditions, 'age <= ?');
    }

    $curr_state = 'any';
    if (isset($_GET['state']) && $_GET['state'] != "any") {
        $curr_state = $_GET['state'];
        if ($curr_state == -1) {
            array_push($query_conditions, 'state > 2');
        } else {
            array_push($query_conditions, 'state = ?');
            array_push($search_options, $_GET['state']);
        }
    }

    $curr_gender = 'any';
    if (isset($_GET['gender']) && $_GET['gender'] != "any") {
        $curr_gender = $_GET['gender'];
        array_push($search_options, $_GET['gender']);
        array_push($query_conditions, 'gender = ?');
    }

    $curr_size = '';
    if (isset($_GET['size']) && $_GET['size'] != "any") {
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
      'min_age'=> $curr_min_age,
      'max_age'=> $curr_max_age,
      'gender'=> $curr_gender,
      'size'=> $curr_size,
      'state'=> $curr_state,
      'city'=> $curr_city,
      'species'=> $curr_species,
      'favourite' => $curr_favourite
    );

    $posts = getPosts($search_options, $query_conditions, $from_clause);

    //Adds a parameter isFavourite to each post when there are no search options
    if(empty($search_options) && isset($_SESSION['username'])) {
        $posts = tagFavouritesAndSort($posts);
    }

    return array(
      'posts'=>$posts,
      'values'=> $current_values);
}?>


<?php function tagFavouritesAndSort($posts)
{
    $posts = array_map(
        function ($post) {
            $post['isFavourite'] = isFavourite(getUserId($_SESSION['username'])['id'], $post['post_id']);
            return $post;
        },
        $posts
    );

    //Places favourite posts before others
    usort(
        $posts,
        function ($p1, $p2) {
            if ($p1['isFavourite'] == $p2['isFavourite']) {
                return 0;
            }
            return ($p1['isFavourite']) ? -1 : 1;
        }
    );
    return $posts;
} ?>
