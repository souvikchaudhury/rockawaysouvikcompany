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
?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6"> <![endif]-->
<!--[if IE 7]>    <html class="ie7"> <![endif]-->
<!--[if IE 8]>    <html class="ie8"> <![endif]-->
<!--[if IE 9]>    <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/css.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
			@import "<?php echo get_template_directory_uri(); ?>/css/domtab.css";
		</style>
	<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<script src="<?php echo get_template_directory_uri(); ?>/js/domtab.js" type="text/javascript"></script>
	<script type="text/javascript">
	/*<![CDATA[*/
		document.write('<style type="text/css">');    
		document.write('div.domtab div{display:none;}<');
		document.write('/s'+'tyle>');   
		 /*]]>*/
	</script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/global.css"/>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />

	<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

	<link href='http://fonts.googleapis.com/css?family=Lato:900' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Snowburst+One' rel='stylesheet' type='text/css'>

	<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

	<!--
	<script type="text/javascript" src="<?php echo get_bloginfo("template_url")."/source/"; ?>jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo("template_url")."/source/"; ?>jquery.fancybox.css?v=2.1.5" media="screen" />
	-->
		
	<!-- Add fancyBox -->
	<link rel="stylesheet" href="<?php echo get_bloginfo("template_url")."/js/fancybox/source/jquery.fancybox.css?v=2.1.5"; ?>" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo get_bloginfo("template_url")."/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"; ?>"></script>
	<!-- close fancyBox -->


	<script type="text/javascript" src="<?php echo get_bloginfo("template_url")."/js/"; ?>ticketinfo.js"></script>

	<script type="text/javascript" src='<?php echo get_bloginfo('template_directory').'/js/rockaway-ajax.js'; ?>'></script>

	<!--for checkbox style
	<script type="text/javascript" src="<?php echo get_bloginfo("template_url")."/js/"; ?>custom-form-elements.js"></script>-->


	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slides.min.jquery.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/contentslider.js">
	
	</script>
		<script type="text/javascript">
		/*<![CDATA[*/
			$(function(){
				$('#slides').slides({
					preload: true,
					preloadImage: '<?php echo get_template_directory_uri(); ?>/img/loading.gif',
					play: 5000,
					pause: 2500,
					hoverPause: true,
					animationStart: function(current){
						$('.caption').animate({
							bottom:-35
						},100);
						if (window.console && console.log) {
							// example return of current slide number
							console.log('animationStart on slide: ', current);
						};
					},
					animationComplete: function(current){
						$('.caption').animate({
							bottom:0
						},200);
						if (window.console && console.log) {
							// example return of current slide number
							console.log('animationComplete on slide: ', current);
						};
					},
					slidesLoaded: function() {
						$('.caption').animate({
							bottom:0
						},200);
					}
				});
				$('.proceed').click(function(){
				 	$("#maindialog").hide();
				});
			});
			/*]]>*/
		</script>
	<?php 
	/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
	 */

	 wp_head(); ?>
</head>

<body>
	<input type="hidden" name="RockawayAjaxUrl" id="RockawayAjaxUrl" value="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" />
	<?php
		if(is_front_page()){
			?>
			<input type="hidden" name="typeChck" id="typeChck" value="front" />
			<?php
		}
		if(is_page(478)){
			?>
			<input type="hidden" name="typeChck" id="typeChck" value="tcktRsrvtn" />
			<?php
		}	
	?>
	<div id="page">
	<div id="wrapper">		
			<div id="header">
				  	<div class="header">
					  	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" width="147" height="128" /></a>
					  	<div class="hed_rgt">
							<div class="top_links"><!--<a href="#">Sign In </a> |  <a href="#">Sign up</a>-->&nbsp;</div>
							<div class="join_outer">
							<div class="ph_bx"><span class="ph_icon"></span>(718) 374-6400</div>
							<a href="<?php echo esc_url( home_url( '/join-campaign' ) ); ?>" class="join_comp">Join the Campaign</a></div>
		             	</div>
	       			</div>

				
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'top_nav' ) ); ?>


				<?php $header_image = get_header_image();
				if ( ! empty( $header_image ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
				<?php endif; ?>

			</div>
			<!-- </header> -->
		<!-- #masthead -->

