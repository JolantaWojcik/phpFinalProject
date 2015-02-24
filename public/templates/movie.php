<div class="moviebox">
<img src="<?php echo '/mymvc/public/images/movie' . strtolower($id) . '.png'; ?>"></img>
<div class="moviebox2">
<div class="movietitle"><?php echo $title;?></div>
<div class="movieyear">Rok produkcji: <?php echo $movie->data()->year;?></div>
<div class="moviedescription"><?php echo $movie->data()->description;?></div></br>
<div class="movietime">Czas trwania: <?php echo ltrim($movietime[0], "0") . " godz. " . $movietime[1] . " min.";?></div>
<div class="moviedirector"><?php echo $movie->data()->director; ?></div>
<div class="moviegenre"><?php echo $movie->data()->genre . " "; ?></div>
<div class="borrowbutton"><a href="/mymvc/public/order/<?php echo $id?>">Wypożycz teraz!</a></div>
</div>
<div class="clear"></div>
<div class="actors">Lista aktorów:</div>
</div>