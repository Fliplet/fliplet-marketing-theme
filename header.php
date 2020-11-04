<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html lang="en"><!--<![endif]-->

<head>
	<title><?php echo get_bloginfo( 'name' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!-- standard viewport tag to set the viewport to the device's width
	, Android 2.3 devices need this so 100% width works properly and
	doesn't allow children to blow up the viewport width-->
	<meta name="viewport" id="vp" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width" />
	<!-- width=device-width causes the iPhone 5 to letterbox the app, so
	we want to exclude it for iPhone 5 to allow full screen apps -->
	<meta name="viewport" id="vp2" content="initial-scale=1.0,user-scalable=no,maximum-scale=1" media="(device-height: 568px)" />

	<!-- prevent web apps from navigating back to the default browser -->
	<script type="text/javascript">(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>

	<!-- prevent google from indexing images as webpages -->
  <?php if(is_attachment()) { echo '<meta name="robots" content="noindex, nofollow" />';} ?>

	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/touch-icon-iphone.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/touch-icon-ipad.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/touch-icon-iphone-retina.png">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/touch-icon-ipad-retina.png">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png"/>
	<link href="https://plus.google.com/116446886753301423291" rel="publisher" />
	<?php wp_head();?>

</head>

<body <?php global $blog_id; body_class('site-id-' . $blog_id);?>>


	<header id="header">
		<?php
			$attachmentLogo = wp_get_attachment_by_post_name( 'Ribbon_Colour' );
			$attachmentText = wp_get_attachment_by_post_name( 'fliplet-menu-text' );

			if ( $attachmentLogo ) {
				$imageLogo = wp_get_attachment_image_src($attachmentLogo->ID, 'full');
			}

			if ( $attachmentText ) {
				$imageText = wp_get_attachment_image_src($attachmentText->ID, 'full');
			}
		?>
		<div class="menu-bar-fliplet-wrapper">
			<a class="menu-bar-fliplet-logo" aria-label="Home" href="/">
				<img class="menu-bar-fliplet-icon" src="<?php echo $imageLogo[0]; ?>" alt="Fliplet Icon">
				<img class="menu-bar-fliplet-text" src="<?php echo $imageText[0]; ?>" alt="Fliplet">
			</a>
		</div>

		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'main_menu',
					'menu_class' => 'navbar-nav',
					'container' => 'div',
					'container_class' => 'menu-bar',
					'walker' => new Nav_Menu_Walker(),
				)
			);
		?>

		<div class="menu-hamburger">
			<span></span>
			<span></span>
			<span></span>
		</div>

		<div class="menu-overlay">
			<div class="menu-overlay-main">
			<div class="menu-overlay-title">MAIN MENU</div>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main_menu_mobile',
							'menu_class' => 'main-mobile-menu',
							'container' => 'div',
							'container_class' => 'menu-overlay-list',
							'walker' => new Main_Mobile_Menu_Walker(),
						)
					);
				?>
			</div>
			<div class="menu-overlay-footer">
				<div class="menu-overlay-title">RESOURCES</div>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'resources_menu_mobile',
							'menu_class' => 'resources-mobile-menu',
							'container' => 'div',
							'container_class' => 'menu-footer-holder',
							'walker' => new Main_Mobile_Menu_Walker(),
						)
					);
				?>
			</div>
		</div>
	</header>
