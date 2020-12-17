<?php
require_once '../includes/session.php';
$title="Contacts";
require_once '../templates/common/tpl_header.php';
?>

<h2>Contacts</h2>

<div id="persons">
  <figure class="person">
    <img class="personimg" src="../static/person1.jpg" alt="Person1" >
    <ul class="nobullets">
      <li><b>John Doe </b></li>
      <li>john.doe@example.com</li>
    </ul>
  </figure>
  <figure class="person">
    <img class="personimg" src="../static/person2.jpg" alt="Person2" >
    <ul class="nobullets">
      <li><b>Jane Doe</b></li>
      <li>jane.doe@example.com</li>
    </ul>
  </figure>
  <figure class="person">
    <img class="personimg" src="../static/person3.jpg" alt="Person3" >
    <ul class="nobullets">
      <li><b>Mary Doe</b></li>
      <li>mary.doe@example.com</li>
    </ul>
  </figure>
</div>

<?php
require_once '../templates/common/tpl_footer.php';
?>
