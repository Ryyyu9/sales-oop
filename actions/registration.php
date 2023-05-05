<?php
require "../classes/User.php";

$user = new User;

$user->register($_POST);

?>