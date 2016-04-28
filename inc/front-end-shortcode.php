<?php 		

	echo $before_widget;

	echo $before_title . $title . $after_title;	

?>

<div class="container-movie">
	<h3><?php 
		//egf there must be a better way to do this
		echo 'Which Movie: ' . $which_movie;
		if ($which_movie == "1") {
			echo $alte_movie_info1->{'Title'}; 
		}
		if($which_movie == "2") {
			echo $alte_movie_info2->{'Title'}; 
		}
	
	?></h3>
	<br/>
	<?php
		echo "Show Poster: " . $show_poster;
		echo "<br/>Show Trailer: " . $link_trailer;
		echo "<br/>Link IMDb: " . $link_imdb;
	?>
	<?php if($show_poster == "1"): ?>
		<div class="container-movie-poster">
			<?php if($link_imdb == "1"): ?>
				<a href="http://www.imdb.com/title/tt2702724" target="_blank">
			<?php endif; ?> 
			<?php
				//egf if returns false no image is available, handle this error
				//$options['poster_attachment_id']
				if($which_movie == "1") {
					echo "Get movie 1<br/>";
					echo wp_get_attachment_image($options['poster_attachment_id1'], array(214,317) );
				}
			    if($which_movie == "2") {
			    	echo "Get movie 2<br/>";
					echo wp_get_attachment_image($options['poster_attachment_id2'], array(214,317) );
				}
				//egf show the thumbnail in the widget but original size in the shortcode, can I tell if this is a short code or widget?
			    
			?>
			<?php if($link_imdb == "1"): ?>
			</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<p><strong>Rated:</strong> <?php echo $alte_movie_info->{'Rated'}; ?></p>
	<p><strong>Length:</strong> <?php echo $alte_movie_info->{'Runtime'}; ?></p>
	<p><strong>Starring:</strong> <?php echo $alte_movie_info->{'Actors'}; ?></p>

	<?php if($show_plot == "1" ): ?>
		<p>
			<?php echo $alte_movie_info->{'Plot'}; ?>
		</p>

	<?php endif; ?>

	<?php if($link_trailer == "1" ): ?>
		<a class="link-trailer" href="http://www.imdb.com/title/tt2702724/videogallery" target="_blank">View Trailers</a>
	<?php endif; ?>
</div>


<?php

	echo $after_widget; 

?>