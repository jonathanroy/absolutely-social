<?php

/*
	Define Absolutely Social Icons */
	$asocial_icons = array(
		'gplus' => array(
			'name' => 'Google+',
			'javascript' => array(
				'src' => 'https://apis.google.com/js/plusone.js',
				'location' => 'footer'
			),
			'formats' => array(
				'small' => array(
					'name' => 'Small',
					'html' => '<g:plusone size="small"></g:plusone>'
				),
				'medium' => array(
					'name' => 'Medium',
					'html' => '<g:plusone size="medium"></g:plusone>'
				),
				'standard' => array(
					'name' => 'Standard',
					'html' => '<g:plusone></g:plusone>'
				),
				'tall' => array(
					'name' => 'Tall',
					'html' => '<g:plusone size="tall"></g:plusone>'
				)
			)
		),
		'facebook' => array(
			'name' => 'Facebook',
			'javascript' => array(),
			'formats' => array(
				'standard' => array(
					'name' => 'Standard',
					'html' => '<iframe src="http://www.facebook.com/plugins/like.php?app_id=166922286717944&amp;href&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:35px;" allowTransparency="true"></iframe>'
				),
				'button_count' => array(
					'name' => 'Button Count',
					'html' => '<iframe src="http://www.facebook.com/plugins/like.php?app_id=166922286717944&amp;href&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>'
				),
				'box_count' => array(
					'name' => 'Box Count',
					'html' => '<iframe src="http://www.facebook.com/plugins/like.php?app_id=166922286717944&amp;href&amp;send=false&amp;layout=box_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:90px;" allowTransparency="true"></iframe>'
				)
			)
		),
		'twitter' => array(
			'name' => 'Twitter',
			'javascript' => array(
				'src' => 'http://platform.twitter.com/widgets.js',
				'location' => 'footer'
			),
			'formats' => array(
				'no_count' => array(
					'name' => 'No Count',
					'html' => '<a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>'
				),
				'horizontal_count' => array(
					'name' => 'Horizontal Count',
					'html' => '<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>'
				),
				'box_count' => array(
					'name' => 'Vertical Count',
					'html' => '<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a>'
				)
			)
		),
		'linkedin' => array(
			'name' => 'LinkedIn',
			'javascript' => array(
				'src' => 'http://platform.linkedin.com/in.js',
				'location' => 'footer'
			),
			'formats' => array(
				'no_count' => array(
					'name' => 'No Count',
					'html' => '<script type="IN/Share" data-url="%the_permalink%"></script>'
				),
				'horizontal' => array(
					'name' => 'Horizontal',
					'html' => '<script type="IN/Share" data-url="%the_permalink%" data-counter="right"></script>'
				),
				'vertical' => array(
					'name' => 'Vertical',
					'html' => '<script type="IN/Share" data-url="%the_permalink%" data-counter="top"></script>'
				)
			)
		),
		'digg' => array(
			'name' => 'Digg',
			'javascript' => array(
				'src' => 'http://widgets.digg.com/buttons.js',
				'location' => 'footer'
			),
			'formats' => array(
				'icon' => array(
					'name' => 'Icon',
					'html' => '<a class="DiggThisButton DiggIcon"></a>'
				),
				'compact' => array(
					'name' => 'Compact',
					'html' => '<a class="DiggThisButton DiggCompact"></a>'
				),
				'medium' => array(
					'name' => 'Medium',
					'html' => '<a class="DiggThisButton DiggMedium"></a>'
				),
				'wide' => array(
					'name' => 'Wide',
					'html' => '<a class="DiggThisButton DiggWide"></a>'
				)
			)
		)
	);

?>