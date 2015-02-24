<div class="movielistbox">
<a href="movie/<?php echo $id ?>"><img src="<?php echo '/mymvc/public/images/movie' . strtolower($id) . '.png'; ?>"></img></a>

<div class="movielistbox2">
<div class="movielisttitle"><a href="movie/<?php echo $id ?>"><?php echo $title . " (" . $movie->data()->year . ")"; ?></a></div>
<div class="movielistdirector"> <?php echo $movie->data()->director; ?> </div><br>
<div class="movielistgenre"> <?php echo $movie->data()->genre . " "; ?> </div>
<div class="cameraimg"><img src='/mymvc/public/images/camera.png'></img> </div>
<div class="movielisttime"> <?php echo ltrim($movietime[0], "0") . " godz. " . $movietime[1] . " min.";?> </div><br>
<div class="movielistdescription"> <?php echo $desctoperiod; ?> </div>
<img style="margin-top: 2px;"src='/mymvc/public/images/pen.png'> 
<div class="movielistreviewnumb"><a href="review/<?php echo $id ?>">Napisz recenzję!</a> | Przeglądaj recenzje 
</img> </div>
</div>

<div class="clear"></div>

</div>
<div class="block"></div>
<div class="clear"></div>