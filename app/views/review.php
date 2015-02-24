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
echo "view";