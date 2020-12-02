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
  <br>
  Name<input type="text" name="name" value="<?php echo $values['name'] ?>">
  <?php drawGenders(true, $values['gender']); ?>
  Age<input type="text" name="age" value="<?php echo $values['age'] ?>">
  Size<input type="text" name="size" value="<?php echo $values['size'] ?>">
  <?php drawSpecies(true, $values['species']); ?>
  <?php drawCities(true, $values['city']); ?>

  <br>
  <input type="submit" value="Search">
</form>

<?php 

  drawPostList($posts);
  include('../templates/common/tpl_footer.php');
?>
