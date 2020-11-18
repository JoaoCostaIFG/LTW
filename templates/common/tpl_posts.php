<?php function draw_lists($lists) {
/**
 * Draws a section (#lists) containing several lists
 * as articles. Uses the draw_list function to draw
 * each list.
 */ ?>
  <section id="lists">

  <?php 
    foreach($lists as $list)
      draw_list($list);
  ?>

  <article class="new-list">
    <form action="../actions/action_add_list.php" method="post">
      <input type="text" name="list_name" placeholder="Add list">
    </form>
  </article>

  </section>
<?php } ?>

<?php function draw_pet($pet) {
/**
 * Draws a given pet
 */ ?>

 <a href=<?$pet['']?> class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/a.png" alt="a."/></li>
      <li>uwu</li>
    </ul>
  </a>

  <article class="list">
    <header><h2><?=$list['list_name']?></h2></header>

    <ol>
      <?php 
        foreach ($list['list_items'] as $item)
          draw_item($item);
      ?>
    </ol>

    <form action="../actions/action_add_item.php" method="post">
      <input type="hidden" name="list_id" value="<?=$list['list_id']?>">
      <input type="text" name="item_text" placeholder="Add item">
    </form>

  </article>
<?php } ?>
