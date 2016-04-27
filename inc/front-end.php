<?php 		

	echo $before_widget;

	echo $before_title . $title . $after_title;	

?>

<div class="container-movie1">
	<h3><?php echo $alte_movie_info1->{'Title'}; ?></h3>
	<br/>
	<div class="container-movie-poster">
	<?php
		//how to get the id out of the options table entry
		//echo 'ID: ' . $options['poster_attachment_id'] . '<br/>';

		//egf if returns false no image is available, handle this error
	    echo wp_get_attachment_image($options['poster_attachment_id1'], array(214,317) );

	    //egf can we get something other than the thumbnail?
	    //wp_get_attachment_image_src ( int $attachment_id, string|array $size = 'thumbnail', bool $icon = false )
	 	// (string|array) (Optional) Image size. Accepts any valid image size, or an array of width and height values in pixels (in that order).
		// Default value: 'thumbnail'

		//egf show the thumbnail in the widget but original size in the shortcode
	    
	    //egf let's link this to the imdb page

	    //egf options to show or hide poster
	    //egf options to show or hide link to imdb
	    
	?>


	</div>
	<p><strong>Rated:</strong> <?php echo $alte_movie_info1->{'Rated'}; ?></p>
	<p><strong>Length:</strong> <?php echo $alte_movie_info1->{'Runtime'}; ?></p>
	<p><strong>Starring:</strong> <?php echo $alte_movie_info1->{'Actors'}; ?></p>

	<?php if($show_plot == "1" ): ?>
		<p>
			<?php echo $alte_movie_info1->{'Plot'}; ?>
		</p>

	<?php endif; ?>
</div>
<div class="container-movie2">
	<h3><?php echo $alte_movie_info2->{'Title'}; ?></h3>
	<br/>
	<div class="container-movie-poster">
	<?php
	    echo wp_get_attachment_image($options['poster_attachment_id2'], array(214,317) );
	?>


	</div>
	<p><strong>Rated:</strong> <?php echo $alte_movie_info2->{'Rated'}; ?></p>
	<p><strong>Length:</strong> <?php echo $alte_movie_info2->{'Runtime'}; ?></p>
	<p><strong>Starring:</strong> <?php echo $alte_movie_info2->{'Actors'}; ?></p>

	<?php if($show_plot == "1" ): ?>
		<p>
			<?php echo $alte_movie_info2->{'Plot'}; ?>
		</p>

	<?php endif; ?>
</div>
<?php

	echo $after_widget; 

?>