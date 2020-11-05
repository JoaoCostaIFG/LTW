<?php
  // include_once('database/connection.php');
  // include_once('database/news.php');
  // $animals = getAllAnimals();

  include('../templates/common/tpl_header.php');
?>

<form class="listfilter" action="" method="post">
  <br>
  <input type="text" name="name" placeholder="Name">
  <input type="text" name="sex" placeholder="Sex">
  <input type="text" name="age" placeholder="Age">
  <input type="text" name="size" placeholder="Size">
  <input type="text" name="breed" placeholder="Breed">
  <input type="text" name="location" placeholder="Location">

  <br>
  <input type="submit" value="Search">
</form>

<div class="list">
  <a href="/static/tmp/a.png" class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/a.png" alt="a."/></li>
      <li>uwu</li>
    </ul>
  </a>
  <a href="/static/tmp/b.png" class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/b.png" alt="b."/></li>
      <li>Mia</li>
    </ul>
  </a>
  <a href="/static/tmp/c.png" class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/c.png" alt="c."/></li>
      <li>Gatoplank</li>
    </ul>
  </a>
  <a href="/static/tmp/d.png" class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/d.png" alt="d."/></li>
      <li>Chico</li>
    </ul>
  </a>
  <a href="/static/tmp/e.png" class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/e.png" alt="e."/></li>
      <li>Lucas</li>
    </ul>
  </a>
  <a href="/static/tmp/f.png" class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/f.png" alt="f."/></li>
      <li>Bazinga</li>
    </ul>
  </a>
  <a href="/static/tmp/g.png" class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/g.png" alt="g."/></li>
      <li>Golden</li>
    </ul>
  </a>
  <a href="/static/tmp/h.png" class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/h.png" alt="h."/></li>
      <li>Daisy</li>
    </ul>
  </a>
  <a href="/static/tmp/a.png" class="list-item">
    <ul class="list-item-content">
      <li><img src="/static/tmp/a.png" alt="a."/></li>
      <li>uwu</li>
    </ul>
  </a>
</div>

<center>
  <button type="button" id="showmoreButton">Load More</button>
</center>

<?php
  include('../templates/common/tpl_footer.php');
?>

