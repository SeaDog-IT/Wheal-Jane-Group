<?php 
/* *** enqueue custom scripts and styles *** */
add_action( 'wp_enqueue_scripts', function() {

	if ( ! bricks_is_builder_main() ) {
		wp_enqueue_style( 'bricks-child', get_stylesheet_uri(), ['bricks-frontend'], filemtime( get_stylesheet_directory() . '/style.css' ) );
    wp_enqueue_script( 'add-classes', get_stylesheet_directory_uri() . '/lib/js/classes.js', array('jquery'), null, true);
    wp_enqueue_script( 'inpage-nav', get_stylesheet_directory_uri() . '/lib/js/inpage-nav.js', array('jquery'), null, true);
    
	}
} );

/* *** register custom elements *** */
add_action( 'init', function() {
  $element_files = [
    __DIR__ . '/elements/title.php',
  ];

  foreach ( $element_files as $file ) {
    \Bricks\Elements::register_element( $file );
  }
}, 11 );

/* *** add text strings to builder *** */
add_filter( 'bricks/builder/i18n', function( $i18n ) {
  // for element category 'custom'
  $i18n['custom'] = esc_html__( 'Custom', 'bricks' );

  return $i18n;
} );

/* *** disable theme and plugin editor *** */
define('DISALLOW_FILE_EDIT',true);

/* *** custom login *** */
add_action( 'login_head', function() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/lib/css/login.css" />';
} );

add_filter( 'login_headerurl', function() {
	return get_bloginfo( 'url' );
} );

add_filter( 'login_headertitle', function() {
	return get_bloginfo( 'name' );
} );

/* *** Add theme support for logo *** */
add_theme_support( 'custom-logo' );

/* *** Disable language switcher on login page *** */
add_filter( 'login_display_language_dropdown', '__return_false' );

/* *** register categories for pages *** */
function page_categories() {  
  register_taxonomy_for_object_type('category', 'page');  
}
add_action( 'init', 'page_categories' );

/* *** Redirect Non Logged in Users to Login Page */
add_action('template_redirect','non_logged_redirect');
function non_logged_redirect() {
  if( !is_user_logged_in() && !is_page( 'Register' ) ) :
    wp_redirect( home_url( '/login/' ) );
    die();
	endif;
}

function ti_custom_login_redirect( $url, $request, $user ) {
  if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
      if ( $user->has_cap( 'administrator' ) ) {
          $url = admin_url();
      } else {
          $url = home_url();
      }
  }
  return $url;
}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
show_admin_bar(false);
}
}

add_filter( 'login_redirect', 'ti_custom_login_redirect', 10, 3 );
/* *** add category slugs to body tag *** */
function add_category_name( $classes = '' ) {
  global $post;

  if( is_single() || is_page() ) :
    $categories = get_the_category();

    foreach( $categories as $category ) :
      $classes[] = $post->post_type.'-'.$category->slug; 
    endforeach;

  endif;
  return $classes;
}
add_filter('body_class','add_category_name');