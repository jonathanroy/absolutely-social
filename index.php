<?php

/*
	Plugin Name:    Absolutely Social
	Plugin URI:     http://absolutely-social.com
	Description:    Absolutely the most complete and flexible social bookmarking plugin available for WordPress!
	Version:        0.1
	Author:         Jonathan Roy
	Author URI:     http://jonathan-roy.com
	License:        The Unlicense
	License URI:    http://unlicense.org/
*/

/*
	Define plug-in URI */
	define('ASOCIAL_PLUGIN_URL', WP_PLUGIN_URL.'/absolutely-social');
	define('ASOCIAL_ICON_DIRECTORY', ASOCIAL_PLUGIN_URL . '/icons');

/*
	Define social bookmarking sites */
	$asocial_sites = array(
		'delicious' => array( 'name' => 'Delicious', 'submit-url' => 'http://delicious.com/post?url=%the_permalink%&title=%the_title%&notes=%the_excerpt%' ),
		'digg' => array( 'name' => 'Digg', 'submit-url' => 'http://digg.com/submit?phase=2&url=%the_permalink%&title=%the_title%&bodytext=%the_excerpt%' ),
		'facebook' => array( 'name' => 'Facebook', 'submit-url' => 'http://www.facebook.com/share.php?u=%the_permalink%&t=%the_title%' ),
		'friendfeed' => array( 'name' => 'Friendfeed', 'submit-url' => 'http://www.friendfeed.com/share?title=%the_title%&link=%the_permalink%' ),
		'google-bookmarks' => array( 'name' => 'Google Bookmarks', 'submit-url' => 'http://www.google.com/bookmarks/mark?op=edit&bkmk=%the_permalink%&title=%the_title%&annotation=%the_excerpt%' ),
		'hacker-news' => array( 'name' => 'Hacker News', 'submit-url' => 'http://news.ycombinator.com/submitlink?u=%the_permalink%&t=%the_title%' ),
		'linkedin' => array( 'name' => 'LinkedIn', 'submit-url' => 'http://www.linkedin.com/shareArticle?mini=true&url=%the_permalink%&title=%the_title%&summary=%the_excerpt%' ),
		'newsvine' => array( 'name' => 'Newsvine', 'submit-url' => 'http://www.newsvine.com/_tools/seed&save?u=%the_permalink%&h=%the_title%' ),
		'stumbleupon' => array( 'name' => 'StumbleUpon', 'submit-url' => 'http://www.stumbleupon.com/submit?url=%the_permalink%&title=%the_title%' ),
		'tumblr' => array( 'name' => 'Tumblr', 'submit-url' => 'http://www.tumblr.com/share?v=3&u=%the_permalink%&t=%the_title%&s=%the_excerpt%' ),
		'twitter' => array( 'name' => 'Twitter', 'submit-url' => 'http://twitter.com/home?status=%the_title% - %the_permalink%' ),
		'yahoo-bookmarks' => array( 'name' => 'Yahoo Bookmarks', 'submit-url' => 'http://bookmarks.yahoo.com/toolbar/savebm?u=%the_permalink%&t=%the_title%' )
	);

/*
	Define available icon sets */
	$asocial_icon_sets = array(
		'vector-social-media-icons' => array(
			'name' => 'Vector Social Media Icons',
			'sizes'	=> array(16, 24, 32),
			'available-icons' => array(
				'add-this', 'amazon', 'aol', 'apple', 'app-store-2', 'app-store', 'bebo', 'behance', 'bing', 'blip',
				'blogger', 'button-blue', 'button-green', 'button-light-blue', 'button-orange', 'button-red', 'button-white',
				'button-yellow', 'coroflot', 'daytum', 'delicious', 'design-bump', 'designfloat', 'deviant-art', 'digg',
				'dribbble', 'dropplr', 'drupal', 'ebay', 'email', 'ember', 'facebook', 'feedburner', 'flickr', 'forrst',
				'foursquare', 'friendfeed', 'friendster', 'gdgt', 'github', 'google-buzz', 'google', 'google-talk', 'gowalla-2',
				'gowalla', 'heart', 'hyves', 'icondock', 'icq', 'identica', 'itune', 'lastfm', 'linkedin', 'meetup', 'metacafe',
				'microsoft', 'mister-wong', 'mixx', 'mobileme', 'msn', 'myspace', 'netvibes', 'newsvine', 'paypal', 'photobucket',
				'picasa', 'podcast', 'posterous', 'qik', 'reddit', 'retweet', 'rss', 'scribd', 'sharethis', 'skype', 'slashdot',
				'slideshare', 'smugmug', 'soundcloud', 'spotify', 'squidoo', 'star', 'stumbleupon', 'technorati', 'tumblr',
				'twitter-2', 'twitter', 'viddler', 'vimeo', 'virb', 'w3', 'wikepedia', 'wordpress-2', 'wordpress', 'xing',
				'yahoo-buzz', 'yahoo', 'yelp', 'youtube'
			)
		)
	);

/*
 	Begin Absolutely Social Admin panel.

	There are essentially 5 sections to this:
	1)	Add "Absolutely Social Admin" link to left-nav Admin Menu & callback function for clicking that menu link
	2)	Add Admin Page CSS if on the Admin Page
	3)	Add "Absolutely Social Admin" Page options
	4)	Create functions to add above elements to pages
	5)	Add Absolutely Social options to page as requested
*/

/*	1)	Add "Absolutely Social" link to left-nav Admin Menu */

	//	Add option if in Admin Page
		function asocial_create_admin_page()
		{
			add_submenu_page('options-general.php', 'Absolutely Social', 'Absolutely Social', 'administrator', 'asocial-admin', 'asocial_build_admin_page');
		}
		add_action('admin_menu', 'asocial_create_admin_page');

	//	You get this if you click the left-column "Absolutely Social" (added above)
		function asocial_build_admin_page()
		{
		?>
			<div id="asocial-options-wrap">
				<div class="icon32" id="icon-tools"><br /></div>
				<h2>Absolutely Social Admin</h2>
				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('asocial_options'); ?>
					<?php do_settings_sections('asocial-admin'); ?>
					<p class="submit"><input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
				</form>
				<?php var_dump( get_option('asocial_options') ); ?>
			</div>
		<?php
		}

/*	2)	Add Admin Page CSS if on the Admin Page */

		function asocial_admin_head()
		{
			echo '<link rel="stylesheet" href="' . AS_PLUGIN_URL . '/admin-style.css" />'.PHP_EOL;
		}
		add_action('admin_head', 'asocial_admin_head');

/*	3)	Add "Boilerplate Admin" Page options */

	//	Register form elements
		function asocial_register_and_build_fields()
		{
			global $asocial_sites, $asocial_icon_sets;

			$asocial_options = get_option('asocial_options');

			register_setting('asocial_options', 'asocial_options', 'asocial_validate_setting');
			
			add_settings_section('main_section', '', 'section_cb', 'asocial-admin');

			add_settings_field('icon_set', 'Choose icon set:', 'asocial_icon_set_setting', 'asocial-admin', 'main_section');

			if ( isset($asocial_options['icon_set']) ) {

				add_settings_field('icon_size', 'Choose icon size:', 'asocial_icon_size_setting', 'asocial-admin', 'main_section');

				foreach ( $asocialsites as $key => $val ) {
					if ( in_array($key, $asocial_icon_sets[$options['icon_set']]['available-icons']) ) {
						add_settings_field($key, $val['name'], 'asocial_site_setting', 'asocial-admin', 'main_section', $key);
					}
				}

			}

			add_settings_field('insert_where', 'Insert automatically?', 'asocial_insert_where_setting', 'asocial-admin', 'main_section');
			
		}
		add_action('admin_init', 'asocial_register_and_build_fields');


		function asocial_validate_setting($options)
		{
			return $options;
		}

	//	Add Admin Page options

	//	in case you need it...
		function section_cb() {}

		function asocial_icon_set_setting()
		{
			global $asocial_icon_sets;

			$asocial_options = get_option('asocial_options');

			echo "<select name=\"asocial_options[icon_set]\">";
			foreach ( $asocial_icon_sets as $key => $val ) {
				echo "<option value=\"" . $key . "\"" . ( ( isset($asocial_options['icon_set']) && $asocial_options['icon_set'] == $key ) ? " selected=\"selected\"" : "" ) . ">" . $val['name'] . "</option>";
			}
			echo "</select>" . PHP_EOL;
		}

		function asocial_icon_size_setting()
		{
			global $asocial_icon_sets;

			$asocial_options = get_option('asocial_options');

			echo "<select name=\"asocial_options[icon_size]\">";
			foreach ( $icon_sets[$asocial_options['icon_set']]['sizes'] as $size ) {
				echo "<option value=\"" . $size . "\"" . ( ( isset($asocial_options['icon_size']) && $asocial_options['icon_size'] == $size ) ? " selected=\"selected\"" : "" ) . ">" . $size . "px</option>";
			}
			echo "</select>" . PHP_EOL;
		}

	//	callback fn for doctype
		function asocial_site_setting($key)
		{
			global $asocial_sites;

			$asocial_options = get_option('asocial_options');
			
			$checked = ( isset($asocial_options[$key]) && $asocial_options[$key] ) ? 'checked="checked" ' : '';
			echo "<input class=\"check-field\" type=\"checkbox\" name=\"asocial_options[" . $key . "]\" " . $checked . "/>";
			echo "<p>" . $asocial_sites[$key]['name'] . "</p>" . PHP_EOL;
		}

		function asocial_insert_where_setting()
		{
			$asocial_options = get_option('asocial_options');

			$asocial_insert_where_options = array(
				'0' => 'Do not insert automatically',
				'before_post' => 'Before posts',
				'after_post' => 'After posts'
			);

			echo "<select name=\"asocial_options[insert_where]\">";
			foreach ( $asocial_insert_where_options as $key => $val ) {
				echo "<option value=\"" . $key . "\"" . ( ( isset($asocial_options['insert_where']) && $asocial_options['insert_where'] == $key ) ? " selected=\"selected\"" : "" ) . ">" . $val . "</option>";
			}
			echo "</select>" . PHP_EOL;
		}


/*	4)	Create functions to add above elements to pages */

		function asocial_insert_icons()
		{
			$asocial_options = get_option('asocial_options');

			$icons = array();
			foreach ( $asocial_sites as $key => $val ) {
				if ( isset($asocial_options[$key]) && $asocial_options[$key] ) {
					$icon_path = AS_ICON_DIRECTORY . "/" . $asocial_options['icon_set'] . "/" . $asocial_options['icon_size'] . "px/" . $key . ".png";
					if ( file_exists( $icon_path ) ) {
						$icons[$key]  = "<span id=\"" . $key . "-as-icon\" class=\"as-icon\">";
						$icons[$key] .= "<img src=\"" . $icon_path . "\" width=\"" . $asocial_options['icon_size'] . "\" height=\"" . $asocial_options['icon_size'] . "\" alt=\"" . $val['name'] . "\" />";
						$icons[$key] .= "</span>" . PHP_EOL;
					}
				}
			}
			return implode("", $icons);
		}



/*	5)	Add Boilerplate options to page as requested */
		if ( !is_admin() && !is_feed() ) {
			
			$asocial_options = get_option('asocial_options');

			// insert icons
			if ( isset($asocial_options['insert_where']) && $asocial_options['insert_where'] == 'before_post' ) {
				add_filter('the_content', function($content) { return $content . asocial_insert_icons(); });
			}

			if ( isset($asocial_options['insert_where']) && $asocial_options['insert_where'] == 'after_post' ) {
				add_filter('the_content', function($content) { return asocial_insert_icons() . $content; });
			}

		}


/*	End customization for Absolutely Social */

?>
