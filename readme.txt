=== ALTE Movie Info Plugin ===
Contributors: egf
Tags: movie, imdb, films
Requires at least: 4.0.1
Tested up to: 4.9
Stable tag: 1.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides both widgets and shortcodes to help you display movie information in various places on your site with only having to enter the IMDB movie ID in one place.


== Description ==

I had been using a couple different IMDB plugins on a movie theater site but I had to enter the movie ID in multiple places and having the widgets in the content area of the home page could lead to user mistakes and result in messing up the site layout.  So I created this plugin where a user can enter the IMDB ID in one place in the settings page and then use shortcodes in the content or widgets in the design to display the movie information.


== Installation ==

To install this plugin:

= Upload Manually =

1. Download and unzip the plugin
2. Upload the 'alte-movie-info' folder into the '/wp-content/plugins/' directory
3. Go to the Plugins admin page and activate the plugin

= Use GitHub Updater =

1. Install github updater: https://github.com/afragen/github-updater
2. In Settings > Github Updater, click the Install Plugin tab
3. Use plugin URI: https://github.com/eliseferguson/alte-movie-info
4. Click Install Plugin button
5. Github updater will notify you of future plugin updates
6. Activate ALTE Movie Showtimes plugin from the plugin page

= To Setup The Plugin =

1. Find the IMDB Movie ID.
2. In the WordPress admin area go to Settings > Movie Info and then enter in the IMDB Movie ID

= How to Use the Widget =

1. Setup the Plugin (refer to above)
2. Go to Appearance > Widgets and drag the 'ALTE Movie Info Widget' to your sidebar.
3. Enter in a Title to appear above the movie info.  For example "Now Playing".
4. Check the box if you would like to have a short plot displayed along with the rest of the movie info.

= How to Use the Shortcode =

1. Navigate to the post or page you would like to add the badges to
2. Enter in the shortcode [alte_movie_info]
3. Optional parameters:
show plot: [alte_movie_info plot='yes']
show poster: [alte_movie_info poster='yes']
add link to poster: [alte_movie_info link='yes']
link trailer: [alte_movie_info trailer='yes']
which movie: [alte_movie_info which_movie='1']


== Frequently Asked Questions ==

= How do I find the IMDB Movie ID? =

1. Browse to IMDB.com
2. Search for the movie you would like to display.
3. In the resulting URL you will find the Movie ID after the "title" folder. For example, in the URL http://www.imdb.com/title/tt2948356/ the Movie ID is tt2948356
4. Copy the Movie ID and enter it into the Movie Info Settings page.

= It's taking a really long time when I submit my Movie ID in the admin area =

Just give it a few seconds and it should load properly.  The movie information is being pulled from the JSON file and saved into the database.

= How Often Does the Movie Information Get Updated? =

Whenever someone visits a page, the plugin checks to see if the profile information was updated in the last 24 hours.  If it has been longer than 24 hours, then the plugin will update the movie information.  The next time someone visits the site or clicks on a page, the latest info show.

= Can I Choose Other Specific Info I Want to Display? =

Unfortunately, not yet.  For future releases, we are considering more customized ways to choose what information you want to display.

= What if I Want to Show Multiple Movies? =

Currently you can show two movies.



== Screenshots ==



== Changelog ==

= 1.2.4 =

* Removing old updater stuff

= 1.2.3 =

* Moved menu item

= 1.2.2 =

* Updated shortcode image size


= 1.2.1 =

* Updated undefined index issue

= 1.2.0 =

* Error handling for missing API key
* Added API key
* Separated into two widgets, one for each set movie

= 1.1.0 =

* Updated deprecated code for php7 style constructors *

= 1.0.7 =

* Movie poster is now displaying as a thumbnail - will update more in future

= 1.0.6 =

* Removed movie poster code that was breaking settings page

= 1.0.3 =

* Testing github updater scripts

= 1.0.1 =

* Added Updater file

= 1.0.0 =

* Initial deployment onto GitHub

= 0.9 =

* Initial launch of the plugin
* Display movie info based on IMDB movie ID
* Option to choose if plot is displayed
