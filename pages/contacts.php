<?php
  require 'session.php';
  $title="Contacts";
  require '../templates/common/tpl_header.php';
?>

<div id="persons">
    <div class="person">
        <img class="personimg" src="../static/person1.jpg" alt="Person1" >
        <ul class="nobullets">
            <li><b>Joakim das couves</b></li>
            <li>joakim.couves@example.com</li>
        </ul>
    </div>
    <div class="person">
        <img class="personimg" src="../static/person2.jpg" alt="Person2" >
        <ul class="nobullets">
            <li><b>Joakina das couves</b></li>
            <li>joakina.couves@example.com</li>
        </ul>
    </div>
    <div class="person">
        <img class="personimg" src="../static/person3.jpg" alt="Person3" >
        <ul class="nobullets">
            <li><b>Josefina das couves</b></li>
            <li>josefina.couves@example.com</li>
        </ul>
    </div>
</div>

<?php
  require '../templates/common/tpl_footer.php';
?>