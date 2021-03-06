<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 wp_enqueue_script( 'ubermenu_extension', get_template_directory_uri().'/js/uberMenu_extension.js', array('ubermenu'), false, true );
 
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<script type='text/javascript'>var _sf_startpt=(new Date()).getTime()</script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,900' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon.png" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/isotope/jquery.isotope.min.js"></script>

<?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' );
if ($image[0]){
	$ogimage = $image[0];
} else {
	$ogimage = get_stylesheet_directory_uri().'/images/ona_fbk.png';
}
if (is_singular()){ 
	setup_postdata( $post );
	$excerpt = get_the_excerpt();
	$title = get_the_title().' | ONA13 - Atlanta, GA';
	$permalink = get_permalink();
	echo '<meta property="og:url" content="'.$permalink.'" />';
	echo '<meta property="og:type" content="article" />';
} else {
	$excerpt = "";
	$title = "";
	$permalink = "";
	$ogimage = get_stylesheet_directory_uri().'/images/ona_fbk.png';
	echo '<meta property="og:type" content="website" />';
} ?>
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:image" content="<?php echo $ogimage;?>" />
<meta property="og:description" content="<?php echo $excerpt; ?>" />

</head>

<body <?php body_class(); ?>>
	<header id="masthead" class="site-header" role="banner">
    <div id="header-background">
    <div id="header-container">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
        
        <div id="header_info">
            <?php $header_image = get_header_image();
            if ( ! empty( $header_image ) ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/ona13_19px.png" class="header-image" alt="" /></a>
            <?php endif; ?>
            <div class="about">
                <p>October 17-19, 2013 &bull; Atlanta, GA</p>
            </div>
            <div class="searchform">
                <?php locate_template( array( 'searchform.php' ), true ) ?>
            </div>
        </div>
        
        </div>
        </div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<!--  I don't think we need this with the uberMenu
            	<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3> -->
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		
        
	</header><!-- #masthead -->
    <div id="page" class="hfeed site">

	<div id="main" class="wrapper">