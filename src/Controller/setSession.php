<?php
$person->setPersonData($username);
session_start();
$_SESSION["Person"] = $person;
?>
