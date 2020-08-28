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
		<div class="menu-bar">
			<a class="menu-bar-fliplet-wrapper" aria-label="Home" href="/">
        <img class="menu-bar-fliplet-icon" src="/wp-content/uploads/2018/03/Ribbon_Colour.png" alt="Fliplet Icon">
        <img class="menu-bar-fliplet-text" src="/wp-content/uploads/2018/11/fliplet-menu-text.png" alt="Fliplet">
      </a>
			<a href="https://studio.fliplet.com/signin" aria-label="Pricing"><div class="menu-link"><p>LOG IN</p></div></a>
			<a href="/pricing" aria-label="Pricing"><div class="menu-link"><p>PRICING</p></div></a>
			<div class="menu-link" id="resources-link"><p>RESOURCES</p>
				<div class="sub-menu" id="resources-link-sub-menu">
					<div class="sub-menu-column">
						<a href="https://help.fliplet.com/" aria-label="Fliplet support site" target="_blank"><div class="sub-menu-link">Support site</div></a>
						<a href="https://code.fliplet.com/code-library/" aria-label="Fliplet code library" target="_blank"><div class="sub-menu-link">Code library</div></a>
						<a href="http://developers.fliplet.com" aria-label="Fliplet developer site" target="_blank"><div class="sub-menu-link">Developer site</div></a>
						<a href="/contact" aria-label="Contact us"><div class="sub-menu-link">Contact us</div></a>
						<a href="/reports" aria-label="Reports"><div class="sub-menu-link">Reports</div></a>
					</div>
					<div class="sub-menu-column">
						<a href="https://studio.fliplet.com" aria-label="Fliplet Studio login" target="_blank"><div class="sub-menu-link">Studio login</div></a>
						<a href="/fliplet-viewer" aria-label="Fliplet Viewer download"><div class="sub-menu-link">Fliplet viewer</div></a>
						<a href="/blog" aria-label="Blog"><div class="sub-menu-link">Blog</div></a>
						<a href="/fliplet-careers" aria-label="Contact us"><div class="sub-menu-link">Careers</div></a>
						<a href="/webinars" aria-label="Webinars"><div class="sub-menu-link">Webinars</div></a>
					</div>
				</div>
			</div>
			<a href="/app-gallery" aria-label="App gallery"><div class="menu-link"><p>APP GALLERY</p></div></a>

      <div class="menu-link" id="features-link"><p>FEATURES</p>
				<div class="sub-menu" id="features-link-sub-menu">
					<div class="sub-menu-column">
						<a href="/creating-prefab-apps-fliplet-studio/" aria-label="How it works"><div class="sub-menu-link">App creation features</div></a>
						<a href="/data-storage-integrations-security/" aria-label="data integrations, storage and security"><div class="sub-menu-link">Data & integrations</div></a>
            <a href="/process-logic-workflow/" aria-label="workflow and process logic"><div class="sub-menu-link">Workflow and process logic</div></a>
						<a href="/extend-fliplet-code/" aria-label="Extending Fliplet with code"><div class="sub-menu-link">Extending Fliplet</div></a>
						<a href="/technical-details/" aria-label="compare Fliplet to alternatives"><div class="sub-menu-link">Info for IT teams</div></a>
						<a href="/security/" aria-label="Fliplet security"><div class="sub-menu-link">Security</div></a>
					</div>
				</div>
			</div>
      <div class="menu-link" id="why-fliplet-link"><p>WHY FLIPLET?</p>
				<div class="sub-menu" id="why-fliplet-link-sub-menu">
					<div class="sub-menu-column">
						<a href="/prefab-app-builder/" aria-label="Why use Prefab Apps?"><div class="sub-menu-link">Why use Prefab Apps?</div></a>
						<a href="/compare-fliplet-alternatives/" aria-label="Compare Fliplet to alternatives"><div class="sub-menu-link">Compare Fliplet to alternatives</div></a>
						<a href="/case-studies" aria-label="Fliplet case studies"><div class="sub-menu-link">Case studies</div></a>
					</div>
				</div>
			</div>
			<a href="https://studio.fliplet.com/signup" aria-label="Create a free account"><div class="menu-link"><p>FREE ACCOUNT</p></div></a>
		</div>

		<div class="menu-hamburger">
			<span></span>
			<span></span>
			<span></span>
		</div>

		<div class="menu-overlay">
			<div class="menu-overlay-main">
				<div class="menu-overlay-title">MAIN MENU</div>
				<a href="https://studio.fliplet.com/signup" aria-label="Create a free account">
					<div class="menu-overlay-link">Create a free account</div>
				</a>
				<a href="/prefab-app-builder/" aria-label="Why use prefab apps">
					<div class="menu-overlay-link">Why use prefab apps?</div>
				</a>
				<a href="/creating-prefab-apps-fliplet-studio/" aria-label="How it works">
					<div class="menu-overlay-link">App creation features</div>
				</a>
        <a href="/process-logic-workflow/" aria-label="Workflow and process logic">
					<div class="menu-overlay-link">Workflow and process logic</div>
				</a>
				<a href="/app-gallery" aria-label="App gallery">
					<div class="menu-overlay-link">App gallery</div>
				</a>
				<a href="/compare-fliplet-alternatives" aria-label="Compare Fliplet to alternatives">
					<div class="menu-overlay-link">Compare Fliplet to alternatives</div>
				</a>
				<a href="/case-studies" aria-label="Case studies">
					<div class="menu-overlay-link">Case studies</div>
				</a>
				<a href="/pricing/" aria-label="Pricing">
					<div class="menu-overlay-link">Pricing</div>
				</a>
				<a href="/extend-fliplet-code/" aria-label="Extending Fliplet with code">
					<div class="menu-overlay-link">Extending Fliplet</div>
				</a>
				<a href="/technical-details/" aria-label="Info for IT">
					<div class="menu-overlay-link">Info for IT teams</div>
				</a>
				<a href="/data-storage-integrations-security/" aria-label="Data integrations, storage and security">
					<div class="menu-overlay-link">Data &  integrations</div>
				</a>
				<a href="/security/" aria-label="Security">
					<div class="menu-overlay-link">Security</div>
				</a>
			</div>
			<div class="menu-overlay-title">RESOURCES</div>
			<div class="menu-overlay-footer">
				<div class="menu-overlay-column-1">
					<a href="https://help.fliplet.com/" target="_blank" aria-label="Fliplet Support Site"><div class="menu-overlay-footerlink">Support site</div></a>
					<a href="http://developers.fliplet.com" target="_blank" aria-label="Fliplet Developer Site"><div class="menu-overlay-footerlink">Developer site</div></a>
					<a href="/fliplet-viewer" aria-label="Download Fliplet Viewer"><div class="menu-overlay-footerlink">Fliplet viewer</div></a>
					<a href="/contact" aria-label="Contact us"><div class="menu-overlay-footerlink">Contact us</div></a>
				</div>
				<div class="menu-overlay-column">
					<a href="/fliplet-careers" aria-label="Careers"><div class="menu-overlay-footerlink">Careers</div></a>
					<a href="/webinars" aria-label="Webinars"><div class="menu-overlay-footerlink">Webinars</div></a>
					<a href="/reports" aria-label="Reports"><div class="menu-overlay-footerlink">Reports</div></a>
					<a href="/blog" aria-label="Blog"><div class="menu-overlay-footerlink">Blog</div></a>
				</div>
			</div>
		</div>
	</header>
