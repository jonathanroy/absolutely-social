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
	1. Define plug-in variables & constants */

	define('ASOCIAL_PLUGIN_URL', WP_PLUGIN_URL.'/absolutely-social');

	$asocial_options = get_option('asocial_options');

/*
	2. Include share buttons */
	
	require_once("asocial-buttons.php");

/*
	3. Include admin section */

	require_once("asocial-admin.php");

/*
	4. Create functions to add above elements to pages */

	function asocial_dynamic_html($url, $post_ID)
	{
		$post = get_post( $post_ID );
        
        if ( is_single() ) {
            $post_title = urlencode( $post->post_title );
            $post_permalink = urlencode( get_permalink($post_ID) );
            $post_excerpt = urlencode( ( isset( $post->post_excerpt ) && strlen( $post->post_excerpt ) > 0 ) ? $post->post_excerpt : substr( strip_tags( $post->post_content ), 0, 250 ) . '...' );
        }
        else {
            $post_title = urlencode( wp_title('', 0) );
            $post_permalink = urlencode( ( !empty( $_SERVER['HTTPS'] ) ) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] );
            $post_excerpt = '';
        }

		$symbol = array( '%the_title%', '%the_permalink%', '%the_excerpt%' );
		$value  = array(  $post_title,   $post_permalink,   $post_excerpt   );

		return str_replace($symbol, $value, $url);
	}

	function asocial_get_button($site_key, $button_format = null)
	{
		global $asocial_options, $asocial_buttons;
		global $wp_query;

		$button_format = !is_null($button_format) ? $button_format : $asocial_options[$site_key];

		$icon_html = $asocial_buttons[$site_key]['formats'][$button_format]['html'];
		$icon_html = asocial_dynamic_html( $icon_html, $wp_query->post->ID );

		$icon_has_js = ( isset( $asocial_buttons[$site_key]['js'] ) && strlen( $asocial_buttons[$site_key]['js'] ) > 0 ) ? true : false;
		if ( $icon_has_js ) {
			$icon_js = $asocial_buttons[$site_key]['js'];
			$icon_html .= '<script type="text/javascript" src="' . $icon_js . '"></script>';
		}

		$icon_html = '<span class="asocial-button ' . $site_key . '-icon">' . $icon_html . '</span> ';

		return $icon_html;
	}

	function asocial_insert_buttons($button_format = null)
	{
		global $asocial_options, $asocial_buttons, $wp_query;

		$icons_html = "<div class=\"asocial-buttons\">";
		foreach ( $asocial_buttons as $site_key => $val ) {
			if ( isset( $asocial_options[$site_key] ) && $asocial_options[$site_key] != 'off' ) {
				$icons_html .= asocial_get_button( $site_key );
			}
		}
		$icons_html .= "</div>";

		return $icons_html . PHP_EOL;
	}


	function asocial_insert_buttons_before_post($content)
	{
		return asocial_insert_buttons() . $content;
	}

	function asocial_insert_buttons_after_post($content)
	{
		return $content . asocial_insert_buttons();
	}

	function asocial_the_buttons($button_format = null)
	{
		echo asocial_insert_buttons($button_format);
	}


/*
	5. Add Absolutely Social to page as requested */

	// insert icons
	if ( isset( $asocial_options['insert_before_post'] ) && $asocial_options['insert_before_post'] )
		add_filter('the_content', 'asocial_insert_buttons_before_post');

	if ( isset( $asocial_options['insert_after_post'] ) && $asocial_options['insert_after_post'] )
		add_filter('the_content', 'asocial_insert_buttons_after_post');


/*	End customization for Absolutely Social */

?>
