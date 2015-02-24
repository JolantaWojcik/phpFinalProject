<?php
//view
require_once('templates/header.php');
$user = new User;
$movie = new Movies;
if($user->isLoggedIn()) {
	require_once('templates/logged.php');
	$order = new Order;
	if($order->findorderbyuser($user->data()->id)) {
	foreach($order->orderlist() as $value) {
	require('templates/order.php');
	}
}
	} else {
	require_once('templates/notlogged.php');
}
require_once('templates/footer.php');