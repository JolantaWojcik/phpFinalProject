<?php
//view
require_once('templates/header.php');

$user = new User;
$order = new Order;
$userid = $user->data()->id;
$url = App::parseUrl();
$movieid = $url[1]; 
$order->addorder($userid, $movieid);

require_once('templates/added.php');
require_once('templates/footer.php');