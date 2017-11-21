<?php

	echo $before_widget;

	echo $before_title . $title . $after_title;

?>

<div class="container-movie">
	<h3><?php echo $alte_movie_info	->{'Title'}; ?></h3>
	<br/>
	<?php
		$the_imdb_link = 'http://www.imdb.com/title/' . $alte_movie_info->{'imdbID'};
		//echo 'Link: ' . $the_imdb_link;
	?>
	<?php if($show_poster == "1"): ?>
		<div class="container-movie-poster">
			<?php if($link_imdb == "1"): ?>
				<a href="<?php echo $the_imdb_link; ?>" target="_blank">
			<?php endif; ?>
			<?php
			    echo wp_get_attachment_image($options['poster_attachment_id' . $which_movie], 'thumbnail' );

			    //returns empty string on failure
			?>
			<?php if($link_imdb == "1"): ?>
			</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if($show_plot == "1" ): ?>
		<p><strong>Rated:</strong> <?php echo $alte_movie_info->{'Rated'}; ?></p>
		<p><strong>Length:</strong> <?php echo $alte_movie_info->{'Runtime'}; ?></p>
		<p><strong>Starring:</strong> <?php echo $alte_movie_info->{'Actors'}; ?></p>

		<p>
			<?php echo $alte_movie_info->{'Plot'}; ?>
		</p>

	<?php endif; ?>

	<?php if($link_trailer == "1" ): ?>
		<a class="link-trailer" href="<?php echo $the_imdb_link; ?>/videogallery" target="_blank">View Trailers</a>
	<?php endif; ?>
</div>

<?php

	echo $after_widget;

?>
