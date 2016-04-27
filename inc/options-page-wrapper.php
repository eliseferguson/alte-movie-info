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
									<td><label for="alte_movie_code1">IMDB Movie Code 1:</label></td>
									<td><input name="alte_movie_code1" id="alte_movie_code1" type="text" value="" class="regular-text" /></td>
								</tr>
								<tr>
									<td><label for="alte_movie_code2">IMDB Movie Code 2:</label></td>
									<td><input name="alte_movie_code2" id="alte_movie_code2" type="text" value="" class="regular-text" /></td>
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
						<?php echo $alte_movie_movie1->{'Title'}; ?>
						</p>
						<p>Movie Poster: 
						<?php echo $alte_movie_movie1->{'Poster'}; ?>

						<?php 
						/*
						if value in json is array -
						echo $alte_movie_info->{'Parameter'}[0]->{'sub parameter'};
						*/?>
						</p>
						<div class="inside">
							<pre><code>
								<?php var_dump($alte_movie_movie1); ?>
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

						<h2>Current Movies</h2>

						<div class="inside">
							<?php if(isset($alte_movie_code1) || $alte_movie_code1 != '' ):	?>	
								<h3>Movie 1 - </h3>
								<?php 
									echo $alte_movie_movie1->{'Title'} . ' (' . $alte_movie_code1 . ')'; 
								?> 
								<br/>
                                Poster:
                                <br/>
								<?php 
								echo wp_get_attachment_image($poster_attachment_id1);
								?>
								<h3>Movie 2 - </h3>
								<?php 
									echo $alte_movie_movie2->{'Title'} . ' (' . $alte_movie_code2 . ')'; 
								?> 
								<br/>
                                Poster:
                                <br/>
								<?php 
								echo wp_get_attachment_image($poster_attachment_id2);
								?>
							<?php else: ?>
								<!-- <p>No current title is selected</p> -->
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
