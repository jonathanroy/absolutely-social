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
	define('AS_PLUGIN_URL', WP_PLUGIN_URL.'/absolutely-social');
	define('AS_ICON_DIRECTORY', AS_PLUGIN_URL . '/icons');

/*
	Define social bookmarking sites */
	$sites = array(
		'blinklist' => array( 'name' => 'Blinklist', 'submit-url' => 'http://www.blinklist.com/index.php?Action=Blink/addblink.php&Url=%the_permalink%&Title=%the_title%' ),
		'delicious' => array( 'name' => 'Delicious', 'submit-url' => 'http://delicious.com/post?url=%the_permalink%&title=%the_title%&notes=%the_excerpt%' ),
		'design-bump' => array( 'name' => 'Design Bump', 'submit-url' => 'http://www.designbump.com/submit?url=%the_permalink%&title=%the_title%' ),
		'design-float' => array( 'name' => 'Design Float', 'submit-url' => 'http://www.designfloat.com/submit.php?url=%the_permalink%&title=%the_title%' ),
		'design-moo' => array( 'name' => 'Design Moo', 'submit-url' => 'http://www.designmoo.com/submit?url=%the_permalink%&title=%the_title%' ),
		'digg' => array( 'name' => 'Digg', 'submit-url' => 'http://digg.com/submit?phase=2&url=%the_permalink%&title=%the_title%&bodytext=%the_excerpt%' ),
		'diigo' => array( 'name' => 'Diigo', 'submit-url' => 'http://www.diigo.com/post?url=%the_permalink%&title=%the_title%' ),
		'dzone' => array( 'name' => 'Dzone', 'submit-url' => 'http://www.dzone.com/links/add.html?url=%the_permalink%&title=%the_title%' ),
		'facebook' => array( 'name' => 'Facebook', 'submit-url' => 'http://www.facebook.com/share.php?u=%the_permalink%&t=%the_title%' ),
		'fark' => array( 'name' => 'Fark', 'submit-url' => 'http://cgi.fark.com/cgi/fark/farkit.pl?h=%the_title%&u=%the_permalink%' ),
		'friendfeed' => array( 'name' => 'Friendfeed', 'submit-url' => 'http://www.friendfeed.com/share?title=%the_title%&link=%the_permalink%' ),
		'google-bookmarks' => array( 'name' => 'Google Bookmarks', 'submit-url' => 'http://www.google.com/bookmarks/mark?op=edit&bkmk=%the_permalink%&title=%the_title%&annotation=%the_excerpt%' ),
		'hacker-news' => array( 'name' => 'Hacker News', 'submit-url' => 'http://news.ycombinator.com/submitlink?u=%the_permalink%&t=%the_title%' ),
		'identica' => array( 'name' => 'Identi.ca', 'submit-url' => 'http://identi.ca/notice/new?status_textarea=%the_permalink%' ),
		'linkedin' => array( 'name' => 'LinkedIn', 'submit-url' => 'http://www.linkedin.com/shareArticle?mini=true&url=%the_permalink%&title=%the_title%&summary=%the_excerpt%' ),
		'live-favorites' => array( 'name' => 'Live Favorites', 'submit-url' => 'https://favorites.live.com/quickadd.aspx?marklet=1&url=%the_permalink%&title=%the_title%' ),
		'mister-wong' => array( 'name' => 'Mister Wong', 'submit-url' => 'http://www.mister-wong.com/addurl/?bm_url=%the_permalink%&bm_description=%the_title%' ),
		'mixx' => array( 'name' => 'Mixx', 'submit-url' => 'http://www.mixx.com/submit?page_url=%the_permalink%&title=%the_title%' ),
		'myspace' => array( 'name' => 'MySpace', 'submit-url' => 'http://www.myspace.com/Modules/PostTo/Pages/?u=%the_permalink%&t=%the_title%' ),
		'netvibes' => array( 'name' => 'Netvibes', 'submit-url' => 'http://www.netvibes.com/share?title=%the_title%&url=%the_permalink%' ),
		'newsvine' => array( 'name' => 'Newsvine', 'submit-url' => 'http://www.newsvine.com/_tools/seed&save?u=%the_permalink%&h=%the_title%' ),
		'pingfm' => array( 'name' => 'Ping.fm', 'submit-url' => 'http://ping.fm/ref/?link=%the_permalink%&title=%the_title%&body=%the_excerpt%' ),
		'posterous' => array( 'name' => 'Posterous', 'submit-url' => 'http://posterous.com/share?linkto=%the_permalink%&title=%the_title%&selection=%the_excerpt%' ),
		'propeller' => array( 'name' => 'Propeller', 'submit-url' => 'http://www.propeller.com/submit/?url=%the_permalink%' ),
		'reddit' => array( 'name' => 'Reddit', 'submit-url' => 'http://reddit.com/submit?url=%the_permalink%&title=%the_title%' ),
		'slashdot' => array( 'name' => 'Slashdot', 'submit-url' => 'http://slashdot.org/bookmark.pl?title=%the_title%&url=%the_permalink%' ),
		'sphere' => array( 'name' => 'Sphere', 'submit-url' => 'http://www.sphere.com/search?q=sphereit:%the_permalink%&title=%the_title%' ),
		'sphinn' => array( 'name' => 'Sphinn', 'submit-url' => 'http://sphinn.com/index.php?c=post&m=submit&link=%the_permalink%' ),
		'stumbleupon' => array( 'name' => 'StumbleUpon', 'submit-url' => 'http://www.stumbleupon.com/submit?url=%the_permalink%&title=%the_title%' ),
		'technorati' => array( 'name' => 'Technorati', 'submit-url' => 'http://technorati.com/faves?add=%the_permalink%' ),
		'tipd' => array( 'name' => 'Tipd', 'submit-url' => 'http://tipd.com/submit.php?url=%the_permalink%' ),
		'tumblr' => array( 'name' => 'Tumblr', 'submit-url' => 'http://www.tumblr.com/share?v=3&u=%the_permalink%&t=%the_title%&s=%the_excerpt%' ),
		'twitter' => array( 'name' => 'Twitter', 'submit-url' => 'http://twitter.com/home?status=%the_title% - %the_permalink%' ),
		'yahoo-bookmarks' => array( 'name' => 'Yahoo Bookmarks', 'submit-url' => 'http://bookmarks.yahoo.com/toolbar/savebm?u=%the_permalink%&t=%the_title%' ),
		'yahoo-buzz' => array( 'name' => 'Yahoo Buzz', 'submit-url' => 'http://buzz.yahoo.com/submit/?submitUrl=%the_permalink%&submitHeadline=%the_title%&submitSummary=%the_excerpt%&submitCategory=science&submitAssetType=text' )
	);

/*
	Define available icon sets */
	$icon_sets = array(
		'vector-social-media-icons' => array(
			'name' => 'Vector Social Media Icons',
			'sizes'	=> array(16, 24, 32),
			'available-sites' => array(
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
		function create_absolutely_social_admin_page()
		{
			add_submenu_page('options-general.php', 'Absolutely Social', 'Absolutely Social', 'administrator', 'absolutely-social-admin', 'build_absolutely_social_admin_page');
		}
		add_action('admin_menu', 'create_absolutely_social_admin_page');

	//	You get this if you click the left-column "Absolutely Social" (added above)
		function build_absolutely_social_admin_page()
		{
		?>
			<div id="absolutely-social-options-wrap">
				<div class="icon32" id="icon-tools"><br /></div>
				<h2>Absolutely Social Admin</h2>
				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('plugin_options'); ?>
					<?php do_settings_sections('absolutely-social-admin'); ?>
					<p class="submit"><input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
				</form>
			</div>
		<?php
		}

/*	2)	Add Admin Page CSS if on the Admin Page */

		function admin_register_head()
		{
			echo '<link rel="stylesheet" href="' .AS_PLUGIN_URL. 'admin-style.css" />'.PHP_EOL;
		}
		add_action('admin_head', 'admin_register_head');

/*	3)	Add "Boilerplate Admin" Page options */

	//	Register form elements
		function register_and_build_fields()
		{
			global $sites, $icon_sets;

			$options = get_option('plugin_options');

			register_setting('plugin_options', 'plugin_options', 'validate_setting');
			
			add_settings_section('main_section', '', 'section_cb', 'absolutely-social-admin');

			add_settings_field('icon_set', 'Choose icon set:', 'icon_set_setting', 'absolutely-social-admin', 'main_section');

			if ( isset($options['icon_set']) ) {

				add_settings_field('icon_size', 'Choose icon size:', 'icon_size_setting', 'absolutely-social-admin', 'main_section');

				foreach ( $sites as $key => $val ) {
					if ( in_array($key, $icon_sets[$options['icon_set']]['available-sites']) ) {
						add_settings_field($key, $val['name'], 'build_site_selection', 'absolutely-social-admin', 'main_section', $key);
					}
				}

			}

			add_settings_field('insert_where', 'Insert automatically?', 'insert_where_setting', 'absolutely-social-admin', 'main_section');
			
		}
		add_action('admin_init', 'register_and_build_fields');

	//	Add Admin Page options

	//	in case you need it...
		function section_cb() {}

		function icon_set_setting()
		{
			global $icon_sets;
			$options = get_option('plugin_options');

			echo "<select name=\"plugin_options[icon_set]\">";
			foreach ( $icon_sets as $key => $val ) {
				echo "<option value=\"" . $key . "\"" . ( ( isset($options['icon_set']) && $options['icon_set'] == $key ) ? " selected=\"selected\"" : "" ) . ">" . $val['name'] . "</option>";
			}
			echo "</select>" . PHP_EOL;
		}

		function icon_size_setting()
		{
			global $icon_sets;
			$options = get_option('plugin_options');

			echo "<select name=\"plugin_options[icon_size]\">";
			foreach ( $icon_sets[$options['icon_set']]['sizes'] as $size ) {
				echo "<option value=\"" . $size . "\"" . ( ( isset($options['icon_size']) && $options['icon_size'] == $size ) ? " selected=\"selected\"" : "" ) . ">" . $size . "px</option>";
			}
			echo "</select>" . PHP_EOL;
		}

	//	callback fn for doctype
		function build_site_selection($key)
		{
			global $sites;
			$options = get_option('plugin_options');
			$checked = (isset($options[$key]) && $options[$key]) ? 'checked="checked" ' : '';
			echo "<input class=\"check-field\" type=\"checkbox\" name=\"plugin_options[" . $key . "]\" " . $checked . "/>";
			echo "<p>" . $sites[$key]['name'] . "</p>" . PHP_EOL;
		}

		function insert_where_setting()
		{
			$options = get_option('plugin_options');

			$insert_where_options = array(
				'0' => 'Do not insert automatically',
				'before_post' => 'Before posts',
				'after_post' => 'After posts'
			);

			echo "<select name=\"plugin_options[insert_where]\">";
			foreach ( $insert_where_options as $key => $val ) {
				echo "<option value=\"" . $key . "\"" . ( ( isset($options['insert_where']) && $options['insert_where'] == $key ) ? " selected=\"selected\"" : "" ) . ">" . $val . "</option>";
			}
			echo "</select>" . PHP_EOL;
		}


/*	4)	Create functions to add above elements to pages */

		function insert_absolutely_social_icons()
		{
			$options = get_option('plugin_options');

			$icons = array();
			foreach ( $sites as $key => $val ) {
				if ( isset($options[$key]) && $options[$key] ) {
					$icon_path = AS_ICON_DIRECTORY . "/" . $options['icon_set'] . "/" . $options['icon_size'] . "px/" . $key . ".png";
					if ( file_exists( $icon_path ) ) {
						$icons[$key]  = "<span id=\"" . $key . "-as-icon\" class=\"as-icon\">";
						$icons[$key] .= "<img src=\"" . $icon_path . "\" width=\"" . $options['icon_size'] . "\" height=\"" . $options['icon_size'] . "\" alt=\"" . $val['name'] . "\" />";
						$icons[$key] .= "</span>" . PHP_EOL;
					}
				}
			}
			return implode("", $icons);
		}



/*	5)	Add Boilerplate options to page as requested */
		if ( !is_admin() && !is_feed() ) {
			
			$options = get_option('plugin_options');

			// insert icons
			if ( isset($options['insert_where']) && $options['insert_where'] == 'before_post' ) {
				add_filter('the_content', function($content) { return $content . insert_absolutely_social_icons(); });
			}

			if ( isset($options['insert_where']) && $options['insert_where'] == 'after_post' ) {
				add_filter('the_content', function($content) { return insert_absolutely_social_icons() . $content; });
			}

		}


/*	End customization for Absolutely Social */

?>
