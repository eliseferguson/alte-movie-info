jQuery(document).ready(function($) {
	$.post(ajaxurl, {
		action: 'alte_movie_info_refresh_movie'
	});
});