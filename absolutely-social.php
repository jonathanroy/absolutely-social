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
	Include other parts of the plugin */
	require_once("asocial-icons.php");
	require_once("asocial-admin.php");

/*
	Create functions to add above elements to pages */

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

		$icon_format = !is_null($icon_format) ? $icon_format : $asocial_options[$site_key . '-format'];

		$icon_js_src = $asocial_icons[$site_key]['javascript']['src'];
		$icon_js_loc = $asocial_icons[$site_key]['javascript']['location'];
		$icon_js_in_footer = ( $icon_js_loc == 'footer' ) ? true : false;

		$icon_html = asocial_dynamic_html( $asocial_icons[$site_key]['formats'][$icon_format]['html'] );

		wp_enqueue_script( $site_key . '_script', $icon_js_src, array(), false, $icon_js_in_footer );

		return $icon_html;
	}

	function asocial_insert_icons()
	{
		global $asocial_options, $asocial_icons, $wp_query;

		$icons_html = "<div class=\"asocial-icons\">";
		foreach ( $asocial_icons as $site_key => $val ) {
			if ( isset( $asocial_options[$site_key . '-status'] ) && $asocial_options[$site_key . '-status'] == 'on' ) {
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
	Add Absolutely Social to page as requested */

	// insert icons
	if ( isset( $asocial_options['insert_before_post'] ) && $asocial_options['insert_before_post'] )
		add_filter('the_content', 'asocial_insert_icons_before_post');

	if ( isset( $asocial_options['insert_after_post'] ) && $asocial_options['insert_after_post'] )
		add_filter('the_content', 'asocial_insert_icons_after_post');


/*	End customization for Absolutely Social */

?>