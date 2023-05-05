<?php

    require "../classes/User.php";

    $user = new User;

    $user->login($_POST);

?>