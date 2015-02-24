<?php
//view
require_once('templates/header.php');
require_once('templates/conditions.php');
$user = new User();
$movie = new Movies();
$url = App::parseUrl();
$movie->find($url[1]); 
$title = $movie->data()->title;
$id = $movie->data()->id;
if($user->isLoggedIn()) {
	require_once('templates/orderlogged.php');
} else {
	require_once('templates/ordernotlogged.php');
}
require_once('templates/footer.php');