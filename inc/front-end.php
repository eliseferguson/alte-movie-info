<?php 		

	echo $before_widget;

	echo $before_title . $title . $after_title;	

?>


	<h3><?php echo $alte_movie_info->{'Title'}; ?></h3>
	<br/>
	<div class="container-movie-poster">
	<?php 
	require_once(ABSPATH . 'wp-admin/includes/media.php');
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	require_once(ABSPATH . 'wp-admin/includes/image.php');

	$url = $alte_movie_movie->{'Poster'};
	$post_id = 1;
	$desc = "Test Movie Poster";

	$image = media_sideload_image($url, $post_id, $desc);
	if (is_wp_error($image)) {
		echo $image->get_error_message();
	}
	else {
		echo $image;
	}
	?>
	</div>
	<p><strong>Rated:</strong> <?php echo $alte_movie_info->{'Rated'}; ?></p>
	<p><strong>Length:</strong> <?php echo $alte_movie_info->{'Runtime'}; ?></p>
	<p><strong>Starring:</strong> <?php echo $alte_movie_info->{'Actors'}; ?></p>

	<?php if($show_plot == "1" ): ?>
		<p>
			<?php echo $alte_movie_info->{'Plot'}; ?>
		</p>

	<?php endif; ?>
<?php

	echo $after_widget; 

?>