<?php 		

	echo $before_widget;

	echo $before_title . $title . $after_title;	

?>

<div class="container-movie1">
	<h3><?php echo $alte_movie_info1->{'Title'}; ?></h3>
	<br/>
	<?php
		$the_imdb_link = 'http://www.imdb.com/title/' . $alte_movie_info1->{'imdbID'}; 
		//echo 'Link: ' . $the_imdb_link;
	?>
	<?php if($show_poster == "1"): ?>
		<div class="container-movie-poster">
			<?php if($link_imdb == "1"): ?>
				<a href="<?php echo $the_imdb_link; ?>" target="_blank">
			<?php endif; ?> 
			<?php
			    echo wp_get_attachment_image($options['poster_attachment_id1'], 'thumbnail' );
			    //returns empty string on failure
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
		<a class="link-trailer" href="<?php echo $the_imdb_link; ?>/videogallery" target="_blank">View Trailers</a>
	<?php endif; ?>
</div>
<div class="container-movie2">
	<h3><?php echo $alte_movie_info2->{'Title'}; ?></h3>
	<br/>
	<?php
		$the_imdb_link2 = 'http://www.imdb.com/title/' . $alte_movie_info2->{'imdbID'}; 
		//echo 'Link: ' . $the_imdb_link;
	?>
	<?php if($show_poster == "1"): ?>
		<div class="container-movie-poster">
			<?php if($link_imdb == "1"): ?>
				<a href="<?php echo $the_imdb_link2; ?>" target="_blank">
			<?php endif; ?> 
			<?php
			    echo wp_get_attachment_image($options['poster_attachment_id2'], 'thumbnail' );
			    //returns empty string on failure
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
		<a class="link-trailer" href="<?php echo $the_imdb_link2; ?>/videogallery" target="_blank">View Trailers</a>
	<?php endif; ?>
</div>
<?php

	echo $after_widget; 

?>