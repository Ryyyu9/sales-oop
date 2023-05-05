<?php

require "../classes/User.php";

$product = new User;

$product->deleteProduct($_GET['product']);


?>