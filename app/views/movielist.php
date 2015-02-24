<?php
//view
require_once('templates/header.php');
$user = new User();                     //do kontrolera
$movie = new Movies();

if($user->isLoggedIn()) {
	require_once('templates/logged.php');
	} else {
	require_once('templates/notlogged.php');
	}
for($i = 1; $i < 5; $i++) {
	$movie->find($i);
	$title = $movie->data()->title;
	$id = $movie->data()->id;
	$movietime = explode(':', $movie->data()->movietime);
	
	//wyświetlamy tyle zdań z opisu, ile zmieści się w 40 słowach
	$smalldesc = array_slice(explode(' ', $movie->data()->description), 0, 40);  //ucinamy opis do 40 słów
	$lastperiod = strrpos(implode(' ',  $smalldesc), '.');                       //zwracamy pozycję ostatniej kropki
	$desctoperiod = substr(implode(' ',  $smalldesc), 0, $lastperiod + 1);       //ucinamy opis do ostatniej kropki
	
	require('templates/movielist.php');
}
require_once('templates/footer.php');
?>