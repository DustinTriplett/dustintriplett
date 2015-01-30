<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php elegant_titles(); ?></title>
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!--[if IE 7]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/ie7style.css" />
	<![endif]-->
	<!--[if IE 8]>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/ie8style.css" />
	<![endif]-->
    <!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/ie6style.css" />
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('.header a img, img.more, quote.png, .content_wrapper .post_content .text p, .content_wrapper .post_content .text, #wrapper .content .mainbot, .tablinks ul li a, #wrapper .content #mainDiv, .categories ul li, .categories ul li a, .links ul.nav_links li a');</script>
	<![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
		<div id="wrapper">
			<div class="content">
				<div id="mainDiv">
					<div id="mainDiv_content">
						<div class="header">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php $logo = (get_option('deviant_logo') <> '') ? get_option('deviant_logo') : get_template_directory_uri().'/images/logo.png'; ?>
								<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" id="logo"/></a>
						</div>
						<div class="links">
							<?php $menuClass = 'superfish nav_links';
							$primaryNav = '';

							if (function_exists('wp_nav_menu')) {
								$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'echo' => false ) );
							};
							if ($primaryNav == '') { ?>
								<ul class="<?php echo esc_attr( $menuClass ); ?>">
									<?php if (get_option('deviant_home_link') == 'on') { ?>
										<li <?php if (is_front_page()) echo('class="current_page_item"') ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','Deviant'); ?></a></li>
									<?php }; ?>

									<?php
									if (get_option('deviant_swap_navbar') == 'false') {
										show_page_menu($menuClass,false,false);
									} else {
										show_categories_menu($menuClass,false);
									}; ?>
								</ul> <!-- end ul.nav -->
							<?php }
							else echo($primaryNav); ?>
						</div>