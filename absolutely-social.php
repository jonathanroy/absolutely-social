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
	1. Define plug-in constants */

	define('ASOCIAL_PLUGIN_URL', WP_PLUGIN_URL.'/absolutely-social');
	define('ASOCIAL_ICON_DIRECTORY', ASOCIAL_PLUGIN_URL . '/icons');

/*
	2. Include icons info */
	
	require_once("asocial-icons.php");

/*
	3. Admin Section */

//	Add option if in Admin Page
	function asocial_create_admin_page()
	{
		add_submenu_page('options-general.php', 'Absolutely Social', 'Absolutely Social', 'administrator', 'asocial-admin', 'asocial_build_admin_page');
	}
	add_action('admin_menu', 'asocial_create_admin_page');


//	You get this if you click the left-column "Absolutely Social" (added above)
	function asocial_build_admin_page()
	{
		global $asocial_options;
	?>
		<div class="wrap">
			<div class="icon32" id="icon-tools"><br /></div>
			<h2>Absolutely Social Admin</h2>
			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields('asocial_options'); ?>
				<?php do_settings_sections('asocial-admin'); ?>
				<p class="submit"><input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
			</form>
			<?php var_dump($asocial_options, $_POST); ?>
		</div>
	<?php
	}


//	Register form elements
	function asocial_register_and_build_fields()
	{
		global $asocial_icons;

		register_setting('asocial_options', 'asocial_options', 'asocial_validate_setting');
		add_settings_section('main_section', '', 'section_cb', 'asocial-admin');
		add_settings_field('insert_where', 'Insert the icons:', 'asocial_insert_where_setting', 'asocial-admin', 'main_section');
		foreach ( $asocial_icons as $site_key => $val ) {
			add_settings_field($site_key, $asocial_icons[$site_key]['name'], 'asocial_sites_setting', 'asocial-admin', 'main_section', $site_key);
		}
	}
	add_action('admin_init', 'asocial_register_and_build_fields');


	function asocial_validate_setting($options)
	{
		return $options;
	}

//	Add Admin Page options

//	in case you need it...
	function section_cb() {}

	function asocial_insert_where_setting()
	{
		global $asocial_options;

		$asocial_insert_where_options = array(
			'insert_before_post' => 'Before posts',
			'insert_after_post' => 'After posts'
		);

		foreach ( $asocial_insert_where_options as $option_key => $option_val ) {
			$checked = ( isset($asocial_options[$option_key]) && $asocial_options[$option_key] ) ? 'checked="checked" ' : '';
			echo "<p><input class=\"check-field\" type=\"checkbox\" value=\"on\" name=\"asocial_options[" . $option_key . "]\" " . $checked . "/> " . $option_val . "</p>" . PHP_EOL;
		}
	}

//	callback fn for doctype
	function asocial_sites_setting($site_key)
	{
		global $asocial_options, $asocial_icons;

		echo "<select name=\"asocial_options[" . $site_key . "]\">";
		echo "<option value=\"off\">Inactive</option>";
		foreach ( $asocial_icons[$site_key]['formats'] as $format_key => $format ) {
			$selected = ( isset( $asocial_options[$site_key] ) && $asocial_options[$site_key] == $format_key ) ? ' selected="selected"' : '';
			echo "<option value=\"" . $format_key . "\"" . $selected . ">" . $format['name'] . "</option>";
		}
		echo "</select>" . PHP_EOL;
	}

/*
	4. Create functions to add above elements to pages */

	function asocial_dynamic_html($url, $post_ID)
	{
		$post = get_post( $post_ID );

		$post_title = urlencode( $post->post_title );
		$post_permalink = urlencode( get_permalink($post_ID) );
		$post_excerpt = urlencode( ( isset( $post->post_excerpt ) && strlen( $post->post_excerpt ) > 0 ) ? $post->post_excerpt : substr( strip_tags( $post->post_content ), 0, 250 ) . '...' );

		$symbol = array( '%the_title%', '%the_permalink%', '%the_excerpt%' );
		$value  = array(  $post_title,   $post_permalink,   $post_excerpt   );

		return str_replace($symbol, $value, $url);
	}

	function asocial_get_icon($site_key, $icon_format = null)
	{
		global $asocial_options, $asocial_icons;

		$icon_format = !is_null($icon_format) ? $icon_format : $asocial_options[$site_key];

		$icon_js_src = $asocial_icons[$site_key]['javascript']['src'];
		$icon_js_loc = $asocial_icons[$site_key]['javascript']['location'];
		$icon_js_in_footer = ( $icon_js_loc == 'footer' ) ? true : false;

		$icon_html = asocial_dynamic_html( $asocial_icons[$site_key]['formats'][$icon_format]['html'] );

		if ( !isset( $icon_html ) || strlen( $icon_html ) == 0 ) return false;

		wp_enqueue_script( $site_key . '_script', $icon_js_src, array(), false, $icon_js_in_footer );

		return $icon_html;
	}

	function asocial_insert_icons($icon_format = null)
	{
		global $asocial_options, $asocial_icons, $wp_query;

		$icons_html = "<div class=\"asocial-icons\">";
		foreach ( $asocial_icons as $site_key => $val ) {
			if ( isset( $asocial_options[$site_key] ) && $asocial_options[$site_key] != 'off' ) {
				$icons_html .= asocial_get_icon( $site_key );
			}
		}
		$icons_html .= "</div>";

		return $icons_html . PHP_EOL;
	}


	function asocial_insert_icons_before_post($content)
	{
		return asocial_insert_icons() . $content;
	}

	function asocial_insert_icons_after_post($content)
	{
		return $content . asocial_insert_icons();
	}


/*
	5. Add Absolutely Social to page as requested */

	// insert icons
	if ( isset( $asocial_options['insert_before_post'] ) && $asocial_options['insert_before_post'] )
		add_filter('the_content', 'asocial_insert_icons_before_post');

	if ( isset( $asocial_options['insert_after_post'] ) && $asocial_options['insert_after_post'] )
		add_filter('the_content', 'asocial_insert_icons_after_post');


/*	End customization for Absolutely Social */

?>
