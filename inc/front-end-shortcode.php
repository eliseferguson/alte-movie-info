<?php

	// echo $before_widget;

	// echo $before_title . $title . $after_title;
	//TODO this isn't working in this file for some reason
?>

<div class="container-movie">
	<h3><?php
		//TODO there must be a better way to do this
		if ($which_movie == "1") {
			echo $alte_movie_info1->{'Title'};
		}
		if($which_movie == "2") {
			echo $alte_movie_info2->{'Title'};
		}

	?></h3>
	<br/>
	<?php
		if ($which_movie == "1") {
			$the_imdb_link = 'http://www.imdb.com/title/' . $alte_movie_info1->{'imdbID'};
			//echo 'Link: ' . $the_imdb_link;
		}
		if ($which_movie == "2") {
			$the_imdb_link = 'http://www.imdb.com/title/' . $alte_movie_info2->{'imdbID'};
		}
	?>
	<?php if($show_poster == "1"): ?>
		<div class="container-movie-poster">
			<?php if($link_imdb == "1"): ?>
				<a href="<?php echo $the_imdb_link; ?>" target="_blank">
			<?php endif; ?>
			<?php
				//TODO we should let the user define the image size in the widget and shortcode?

				echo wp_get_attachment_image($options['poster_attachment_id' . $which_movie], array(340,504) );

			?>
			<?php if($link_imdb == "1"): ?>
			</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ($which_movie == "1") : ?>

		<?php if($show_plot == "1" ): ?>
			<p><strong>Rated:</strong> <?php echo $alte_movie_info1->{'Rated'}; ?></p>
			<p><strong>Length:</strong> <?php echo $alte_movie_info1->{'Runtime'}; ?></p>
			<p><strong>Starring:</strong> <?php echo $alte_movie_info1->{'Actors'}; ?></p>

			<p>
				<?php echo $alte_movie_info1->{'Plot'}; ?>
			</p>

		<?php endif; ?>

		<?php if($link_trailer == "1" ): ?>
			<a class="link-trailer" href="<?php echo $the_imdb_link; ?>/videogallery" target="_blank">View Trailers</a>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ($which_movie == "2") : ?>

		<?php if($show_plot == "1" ): ?>
			<p><strong>Rated:</strong> <?php echo $alte_movie_info2->{'Rated'}; ?></p>
			<p><strong>Length:</strong> <?php echo $alte_movie_info2->{'Runtime'}; ?></p>
			<p><strong>Starring:</strong> <?php echo $alte_movie_info2->{'Actors'}; ?></p>

			<p>
				<?php echo $alte_movie_info2->{'Plot'}; ?>
			</p>

		<?php endif; ?>

		<?php if($link_trailer == "1" ): ?>
			<a class="link-trailer" href="<?php echo $the_imdb_link; ?>/videogallery" target="_blank">View Trailers</a>
		<?php endif; ?>
	<?php endif; ?>
</div>


<?php

	// echo $after_widget;

?>
