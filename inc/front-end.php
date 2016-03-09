<?php 		

	echo $before_widget;

	echo $before_title . $title . $after_title;	

?>


	<h3><?php echo $alte_movie_info->{'Title'}; ?></h3>
	<br/>
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