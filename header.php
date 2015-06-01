<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package alumni
 */
?>
<?php if ( !is_user_logged_in() ){ ?>
	<style>
	#wpadminbar{ display:none; }
	</style>
<?php } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'alumni' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo"><img src="<?php echo site_url(); ?>/wp-content/themes/alumni/images/logo.png" width="246px" height="79px" alt="EF Academy Alumni Association"></a>
			<!--<h2 class="site-description"><?php //bloginfo( 'description' ); ?></h2> -->
			<?php if ( !is_user_logged_in() ){ ?>
			<div class="loginbar">
				<ul>
					<li><a href="<?php echo site_url(); ?>/wp-login.php">Login</a></li>
					<li><a href="<?php echo site_url(); ?>/contact">Contact</a></li>
				</ul>
			</div>
			<?php } else { ?>
				<script>
				jQuery(document).ready(function($){
					$('.menu li').last().hide();
					$('.menu li').last().css('float','left').children().css({'background': 'none', 'color': '#000'});
				});
				</script>
			<?php } ?>
			<div class="social-media-top">
				<?php dynamic_sidebar( 'Social Media Widget' ); ?>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Primary Menu', 'alumni' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	
	<div class="content-wrap">
		<div id="content" class="site-content">
