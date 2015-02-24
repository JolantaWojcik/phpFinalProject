<?php
//view
require_once('templates/header.php');
$user = new User;
$movie = new Movies;
if($user->isLoggedIn()) {
	require_once('templates/logged.php');
	} else {
	require_once('templates/notlogged.php');
}
$url = App::parseUrl();
$movie->find($url[1]);  
$title = $movie->data()->title;
$id = $movie->data()->id;
$movietime = explode(':', $movie->data()->movietime);
require_once('templates/movie.php');
$actor = new Actor;
$actor->findactorbyfilm($id);
foreach($actor->actorlist() as $value) {
	require('templates/actor.php');
}
require_once('templates/footer.php');