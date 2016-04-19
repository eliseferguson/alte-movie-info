<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h1>ALTE IMDB Info Plugin</h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">
				
					<div class="postbox">

						<h2><span>Let's get started!</h2>

						<div class="inside">
							<form name="alte_movie_code_form" method="post" action="">
							<input type="hidden" name="alte_movie_code_form_submitted" value="Y"/>
							<table class="widefat">	
								<tr>
									<td><label for="alte_movie_code">IMDB Movie Code</label></td>
									<td><input name="alte_movie_code" id="alte_movie_code" type="text" value="" class="regular-text" /></td>
								</tr>
								
							</table>

							<p><input class="button-primary" type="submit" name="alte_movie_code_submit" value="Save" /></p>
							</form>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->
					<?php if($display_json == true): ?>
					<div class="postbox">

						<h2><span>Json Feed</h2>
						<p>Movie Title: 
						<?php echo $alte_movie_movie->{'Title'}; ?>
						</p>
						<p>Movie Poster: 
						<?php echo $alte_movie_movie->{'Poster'}; ?>

						<?php 
						/*
						if value in json is array -
						echo $alte_movie_info->{'Parameter'}[0]->{'sub parameter'};
						*/?>
						</p>
						<div class="inside">
							<pre><code>
								<?php var_dump($alte_movie_movie); ?>
							</code></pre>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->
					<?php endif; ?>
					
					
				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">

						<h2>Current Movie</h2>

						<div class="inside">
							<?php if(isset($alte_movie_code) || $alte_movie_code != '' ):	?>	
								<p>Current Movie Displaying on Site: </p>
								<?php 
									echo $alte_movie_movie->{'Title'} . ' (' . $alte_movie_code . ')'; 
								?> 
								<br/>
								<!-- Movie Poster URL: <php echo $alte_movie_movie->{'Poster'}; > -->
                                Movie Poster:
                                <br/>
								<?php 
								// EGF move this to alte-movie-info.php file and then use the id here and front-end
								$url = $alte_movie_movie->{'Poster'};
								$post_id = 1;
								$desc = $alte_movie_movie->{'Title'} . ' Movie Poster';

								function get_attachment_id_from_src ($image_src) {
							      global $wpdb;
							      $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
							      $id = $wpdb->get_var($query);
							      return $id;
							    }
								 
								// Upload an Image
								$image = media_sideload_image($url, $post_id, $desc);
								 
								// Remove any unwanted HTML, keep just a plain URL (or whatever is in the image src="..." )
								$image = preg_replace('/.*(?<=src=["\'])([^"\']*)(?=["\']).*/', '$1', $image);
								 
								// Get the Attachment ID
								$attachment_id = get_attachment_id_from_src ($image);
								echo "ID: " . $attachment_id;
								echo wp_get_attachment_image($attachment_id);
								?>
							<?php else: ?>
								<p>No current title is selected</p>
							<?php endif; ?>
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->
