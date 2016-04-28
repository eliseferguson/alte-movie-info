<?php 		

	echo $before_widget;

	echo $before_title . $title . $after_title;	

?>

<div class="container-movie1">
	<h3><?php echo $alte_movie_info1->{'Title'}; ?></h3>
	<br/>
	<?php if($show_poster == "1"): ?>
		<div class="container-movie-poster">
			<?php if($link_imdb == "1"): ?>
				<a href="http://www.imdb.com/title/tt2702724" target="_blank">
			<?php endif; ?> 
			<?php
				//egf if returns false no image is available, handle this error
			    echo wp_get_attachment_image($options['poster_attachment_id1'], array(214,317) );

				//egf show the thumbnail in the widget but original size in the shortcode, can I tell if this is a short code or widget?
			    
			?>
			<?php if($link_imdb == "1"): ?>
			</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<p><strong>Rated:</strong> <?php echo $alte_movie_info1->{'Rated'}; ?></p>
	<p><strong>Length:</strong> <?php echo $alte_movie_info1->{'Runtime'}; ?></p>
	<p><strong>Starring:</strong> <?php echo $alte_movie_info1->{'Actors'}; ?></p>

	<?php if($show_plot == "1" ): ?>
		<p>
			<?php echo $alte_movie_info1->{'Plot'}; ?>
		</p>

	<?php endif; ?>

	<?php if($link_trailer == "1" ): ?>
		<a class="link-trailer" href="http://www.imdb.com/title/tt2702724/videogallery" target="_blank">View Trailers</a>
	<?php endif; ?>
</div>

<div class="container-movie2">
	<h3><?php echo $alte_movie_info2->{'Title'}; ?></h3>
	<br/>
	<?php if($show_poster == "1"): ?>
		<div class="container-movie-poster">
			<?php if($link_imdb == "1"): ?>
				<a href="http://www.imdb.com/title/tt2702724" target="_blank">
			<?php endif; ?> 
			<?php
				//egf if returns false no image is available, handle this error
			    echo wp_get_attachment_image($options['poster_attachment_id2'], array(214,317) );

				//egf show the thumbnail in the widget but original size in the shortcode, can I tell if this is a short code or widget?
			    
			?>
			<?php if($link_imdb == "1"): ?>
			</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<p><strong>Rated:</strong> <?php echo $alte_movie_info2->{'Rated'}; ?></p>
	<p><strong>Length:</strong> <?php echo $alte_movie_info2->{'Runtime'}; ?></p>
	<p><strong>Starring:</strong> <?php echo $alte_movie_info2->{'Actors'}; ?></p>

	<?php if($show_plot == "1" ): ?>
		<p>
			<?php echo $alte_movie_info2->{'Plot'}; ?>
		</p>

	<?php endif; ?>

	<?php if($link_trailer == "1" ): ?>
		<a class="link-trailer" href="http://www.imdb.com/title/tt2702724/videogallery" target="_blank">View Trailers</a>
	<?php endif; ?>
</div>
<?php

	echo $after_widget; 

?>