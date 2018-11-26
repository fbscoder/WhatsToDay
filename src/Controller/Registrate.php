<?php
include 'person.php';
$person = new Person();
$username = "test";
$person->checkIfPersonExists();
include 'setSession.php';
 ?>
