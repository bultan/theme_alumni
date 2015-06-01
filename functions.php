<?php
/**
 * alumni functions and definitions
 *
 * @package alumni
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660; /* pixels */
}

if ( ! function_exists( 'alumni_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function alumni_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on alumni, use a find and replace
	 * to change 'alumni' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'alumni', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'index-thumb', 250, 200, true );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'alumni' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside'
	) );

	// Set up the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'alumni_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '',
	// ) ) );
}
endif; // alumni_setup
add_action( 'after_setup_theme', 'alumni_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function alumni_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'alumni' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Home Search Widget', 'alumni' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Social Media Widget', 'alumni' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget-social %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'alumni_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function alumni_scripts() {
	wp_enqueue_style( 'alumni-style', get_stylesheet_uri() );

	wp_enqueue_style( 'alumni-font-awesome' , 'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );

	wp_enqueue_script( 'alumni-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'alumni-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), '20120206', true );

	wp_enqueue_script( 'alumni-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(), '20120206', true );

	wp_enqueue_script( 'alumni-tabs', get_template_directory_uri() . '/js/ef-tabs.js', array(), '20120206', true );

	wp_enqueue_script( 'alumni-init', get_template_directory_uri() . '/js/init.js', array(), '20120206', true );

	wp_enqueue_script( 'alumni-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'alumni_scripts' );


function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
	$wp_admin_bar->remove_node( 'site-name' );
	$wp_admin_bar->remove_menu( 'tribe-events' );
	$wp_admin_bar->remove_node( 'bp-login' );
	$wp_admin_bar->remove_node( 'bp-register' );
	$wp_admin_bar->remove_node( 'search' );
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

function wp_remove_events_from_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('tribe-events');
}
add_action( 'wp_before_admin_bar_render', 'wp_remove_events_from_admin_bar' );

function replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy,', '', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

function my_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
	<div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
	<input type="text" placeholder="Search this site" class="serach-box" value="' . get_search_query() . '" name="s" id="s" />
	<button type="submit" id="searchsubmit" class="search-submit" value="'. esc_attr__( 'Search' ) .'" ></button>
	</div>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'my_search_form' );

function my_login_logo() { ?>
    <style type="text/css">
    	body.login {
    		 background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/login-bg.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
    	}
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
            padding-bottom: 30px;
            width: 280px;
            height: 58px;
            background-size: 100%;
            margin: 0;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

add_action('wp_logout','go_home');
function go_home(){
  wp_redirect( home_url() );
  exit();
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
