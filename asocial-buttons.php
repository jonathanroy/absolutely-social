<?php

/*
	Define Absolutely Social Buttons */
	$asocial_buttons = array(
		'gplus' => array(
			'name' => 'Google+',
			'js' => 'https://apis.google.com/js/plusone.js',
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
			'formats' => array(
				'standard' => array(
					'name' => 'Standard',
					'html' => '<iframe src="//www.facebook.com/plugins/like.php?href=%the_permalink%&amp;send=false&amp;layout=standard&amp;width=49&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=24" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:49px; height:24px;" allowTransparency="true"></iframe>'
				),
				'button_count' => array(
					'name' => 'Button Count',
					'html' => '<iframe src="//www.facebook.com/plugins/like.php?href=%the_permalink%&amp;send=false&amp;layout=button_count&amp;width=47&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:47px; height:20px;" allowTransparency="true"></iframe>'
				),
				'box_count' => array(
					'name' => 'Box Count',
                    'html' => '<iframe src="//www.facebook.com/plugins/like.php?href=%the_permalink%&amp;send=false&amp;layout=box_count&amp;width=60&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=50" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:60px;" allowTransparency="true"></iframe>'
				)
			)
		),
		'twitter' => array(
			'name' => 'Twitter',
			'js' => 'http://platform.twitter.com/widgets.js',
			'formats' => array(
				'no_count' => array(
					'name' => 'No Count',
					'html' => '<a href="http://twitter.com/share" class="twitter-share-button" data-count="none"></a>'
				),
				'horizontal_count' => array(
					'name' => 'Horizontal Count',
					'html' => '<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal"></a>'
				),
				'box_count' => array(
					'name' => 'Vertical Count',
					'html' => '<a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical"></a>'
				)
			)
		),
		'linkedin' => array(
			'name' => 'LinkedIn',
			'js' => 'http://platform.linkedin.com/in.js',
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
			'js' => 'http://widgets.digg.com/buttons.js',
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
