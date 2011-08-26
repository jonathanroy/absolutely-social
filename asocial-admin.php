<?php

	global $asocial_options, $asocial_icons;

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
		<div class="wrap">
			<div class="icon32" id="icon-tools"><br /></div>
			<h2>Absolutely Social Admin</h2>
			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields('asocial_options'); ?>
				<?php do_settings_sections('asocial-admin'); ?>
				<p class="submit"><input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
			</form>
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

		foreach ( $asocial_insert_where_options as $key => $val ) {
			$checked = ( isset($asocial_options[$key]) && $asocial_options[$key] ) ? 'checked="checked" ' : '';
			echo "<p><input class=\"check-field\" type=\"checkbox\" value=\"on\" name=\"asocial_options[" . $key . "]\" " . $checked . "/> " . $val . "</p>" . PHP_EOL;
		}
	}

//	callback fn for doctype
	function asocial_sites_setting($site_key)
	{
		global $asocial_options, $asocial_icons;

		$checked = ( isset($asocial_options[$site_key . '-status']) && $asocial_options[$site_key . '-status'] == 'on' ) ? 'checked="checked" ' : '';
		echo "<p>Active <input class=\"check-field\" type=\"checkbox\" value=\"on\" name=\"asocial_options[" . $site_key . "-status]\" " . $checked . "/></p>" . PHP_EOL;

		echo "<select name=\"" . $site_key . "-format\">";
		foreach ( $asocial_icons[$site_key]['formats'] as $format_key => $format ) {
			$selected = ( isset( $asocial_options[$site_key . '-format'] ) && $asocial_options[$site_key . '-format'] == $format_key ) ? ' selected="selected"' : '';
			echo "<option value=\"" . $format_key . "\"" . $selected . ">" . $format['name'] . "</option>";
		}
		echo "</select>" . PHP_EOL;
	}

?>