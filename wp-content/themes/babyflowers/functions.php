<?php
/**
 * babyflowers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package babyflowers
 */

if ( ! function_exists( 'babyflowers_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function babyflowers_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on babyflowers, use a find and replace
	 * to change 'babyflowers' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'babyflowers', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'babyflowers' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	
}
endif;
add_action( 'after_setup_theme', 'babyflowers_setup' );


/**
 * Enqueue scripts and styles.
 */
function babyflowers_scripts() {
	wp_enqueue_style( 'main', get_template_directory_uri().'/css/main.css?v='.date("mdyhs") );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri().'/css/bootstrap-theme.min.css' );

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '20151215', true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), date("mdyhs"), true );

	wp_enqueue_script( 'boostrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'babyflowers_scripts' );



/*function my_theme_wrapper_start() {
  echo '<section id="main">';
}

function my_theme_wrapper_end() {
  echo '</section>';
}*/
function register_my_session()
{
  if( !session_id() )
  {
    session_start();
  }
}

add_action('init', 'register_my_session');

include (TEMPLATEPATH.'/slider/php/slider_function_include.php');
include (TEMPLATEPATH.'/flores/php/flores_function_include.php');


add_action( 'init', 'flores_type_rest_support', 25 );
  function flores_type_rest_support() {
  	global $wp_post_types;
  
  	$post_type_name = 'flores_panel';
		if( isset( $wp_post_types[ $post_type_name ] ) ) {
			$wp_post_types[$post_type_name]->show_in_rest = true;
			$wp_post_types[$post_type_name]->rest_base = $post_type_name;
			$wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
		}
  
  }

  add_action('rest_api_init','register_custom_fields');

  function register_custom_fields(){
	  register_rest_field(
		  'flores_panel',
		  'precio',
		  
		  array(
			  'get_callback' => 'show_fields',
			  'update_callback' => 'update_fields', 
   			   'schema' => null
		  )
		);
  }

	function show_fields($object, $field_name, $request){
		
		return get_post_meta($object['id'],$field_name,true);
	}


	function update_fields($value, $object, $field_name){
		
		if ( ! $value || ! is_string( $value ) ) {
			return;
		}
	
		return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );
	}
