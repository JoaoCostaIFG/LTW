<?php
  include_once('session.php');
  include('../templates/common/tpl_header.php');
  include_once('../templates/tpl_petInfo.php');
  include_once('../templates/tpl_list.php');
?>

<?php
    $filterOptions = getFilterOptions();
    $posts = $filterOptions['posts'];
    $values = $filterOptions['values'];
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

<?php 
  drawPostList($posts);
  include('../templates/common/tpl_footer.php');
?>
