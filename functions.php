<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

include_once( get_stylesheet_directory() . '/lib/require-col-gravity.php' );

include_once( get_stylesheet_directory() . '/inc/gravity-forms-list-field-datepicker.php' );

include_once( get_stylesheet_directory() . '/inc/custom-shortcode.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Tuned WP' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	// CSS
  wp_enqueue_style( 'fontawesome5', get_stylesheet_directory_uri() . '/lib/fontawesome5/css/fontawesome-all.min.css', array(), CHILD_THEME_VERSION );
  wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:100,300,300i,400,400i,700,900', array(), CHILD_THEME_VERSION );
  wp_enqueue_style( 'slickslider', get_stylesheet_directory_uri() . '/lib/slickslider/slick.css', array(), "1.8.0" );
  wp_enqueue_style( 'tuned', get_stylesheet_directory_uri() . '/tuned.css', array(), CHILD_THEME_VERSION );
  wp_enqueue_style( 'lity', '//cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.css' );
  wp_enqueue_style( 'datepicker', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css' );
  wp_enqueue_style( 'child', get_stylesheet_directory_uri() . '/child.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
  
  // JS
  //wp_enqueue_script( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array( 'jquery' ), "1.12.1" ); // sample
  wp_enqueue_script( 'slickslider', get_stylesheet_directory_uri() . '/lib/slickslider/slick.min.js', array( 'jquery' ), "1.8.0" );
  wp_enqueue_script( 'lity', '//cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js', array('jquery'), true );
   wp_enqueue_script( 'lity', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js', array('jquery'), true );
  wp_enqueue_script( 'moment', '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js', array('jquery'), true );
  //wp_enqueue_script( 'dateformat', '//stevenlevithan.com/assets/misc/date.format.js', array('jquery'), true );
  wp_enqueue_script( 'child-js', get_stylesheet_directory_uri() . '/js/child.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
  wp_enqueue_script( 'child-footer-js', get_stylesheet_directory_uri() . '/js/child-footer.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

	$output = array(
		'pid' => get_the_ID(),
		'second_day_price' => get_field( 'second_day_price', get_the_ID() ),
		'additional_day_price' => get_field( 'additional_day_price', get_the_ID() ),
		'regular_price' => get_post_meta( get_the_ID(), '_regular_price', true),
		'extra_child' => get_field( 'extra_child', get_the_ID() ),
		'extra_child_second' => get_field( 'extra_child_second', get_the_ID() ),
		'extra_child_third' => get_field( 'extra_child_third', get_the_ID() ),
		'incl_boots_poles_price' => get_field( 'incl_boots_poles_price', get_the_ID() ),
		'fixed_price' => get_field( 'fixed_price', get_the_ID() ),
		'price_description' => get_field( 'price_description', get_the_ID() ),
		'no_cart_product' => get_field( 'no_cart_product', get_the_ID() ),
	);
	
	wp_localize_script( 'child-js', 'output', $output );

	if( class_exists('FLBuilderModel') && ( FLBuilderModel::is_builder_active() ) ) {
		//wp_dequeue_style( 'tuned' );
		wp_dequeue_script( 'child-js' );
	}

}

add_action( 'gform_enqueue_scripts', 'gform_dequeue_script_list' );
function gform_dequeue_script_list() { 
    global $wp_styles; 
    if( isset($wp_styles->registered['gforms_datepicker_css']) ) {
        unset( $wp_styles->registered['gforms_datepicker_css'] );
    } 
}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}


/** CHANGE ADMIN CSS **/
/** http://www.code-slap.com/4-space-tabs-in-textarea-editors/ **/
if ( !function_exists('base_admin_css') ) {
	function base_admin_css()
	{
		wp_enqueue_style('base-admin-css', get_stylesheet_directory_uri() .'/admin.css', false, '1.0', 'all');
	}
	add_action( 'admin_print_styles', 'base_admin_css' );
}


// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
function eve_theme_setup() {
  add_image_size( 'featured-image', 720, 400, TRUE );
  add_image_size( 'team-featured-image', 246, 328, TRUE );
  add_image_size( 'testimonial-featured-image', 202, 202, FALSE );
  add_image_size( 'blog-featured-image1', 371, 280, TRUE );
  add_image_size( 'blog-featured-image4', 371, 462, TRUE );
  add_image_size( 'service-image2', 260, 200, TRUE );
  add_image_size( 'service-image4', 360, 200, TRUE );
}
add_action( 'after_setup_theme', 'eve_theme_setup' );


// Add Image Sizes to dropdown
function eve_custom_sizes( $sizes ) {
  return array_merge( $sizes, array(
      'service-image2' => __('Service 2 - Image'),
  ) );
}
add_filter( 'image_size_names_choose', 'eve_custom_sizes' );


// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}


//* Remove the entry header markup (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );



// Prepare iframes for defer loading by automatically updating in the content
function eve_filter_content_iframes( $content ) {
	/*if( is_singular() && is_main_query() ) {  // enable to filter only on main content */

  $doc = new DOMDocument();
  $doc->loadHTML( $content );
  

  foreach ( $doc->getElementsByTagName('iframe') as $item ) {
  	$src_node = $item->attributes->getNamedItem('src');
    if ( $src_node ) {
      $src_value = $src_node->value;
      if ( !empty($src_value) ) {
        $item->setAttribute( 'data-src', $src_value );
        $item->setAttribute( 'src', '' );
      }      
    }    
  }  
  
	return $doc->saveHTML();
}
//add_filter( 'the_content', 'eve_filter_content_iframes' );


add_filter('wpcf7_autop_or_not', '__return_false'); 

add_post_type_support( 'page', 'excerpt' );


// Adjust your form ID
//add_filter( 'gform_form_post_get_meta_3', 'add_my_field' );
function add_my_field( $form ) {
 
    // Create a Single Line text field for the team member's name
    $name = GF_Fields::create( array(
        'type'   => 'text',
        'id'     => 1002, // The Field ID must be unique on the form
        'formId' => $form['id'],
        'label'  => 'Name',
        'pageNumber'  => 1, // Ensure this is correct
    ) );
 
    // Create an email field for the team member's email address
    $email = GF_Fields::create( array(
        'type'   => 'email',
        'id'     => 1001, // The Field ID must be unique on the form
        'formId' => $form['id'],
        'label'  => 'Email',
        'pageNumber'  => 1, // Ensure this is correct
    ) );
 
    // Create a repeater for the team members and add the name and email fields as the fields to display inside the repeater.
    $team = GF_Fields::create( array(
        'type'             => 'repeater',
        'description'      => '',
        'id'               => 1000, // The Field ID must be unique on the form
        'formId'           => $form['id'],
        'label'            => 'Date of Booking',
        'addButtonText'    => 'Add Date of Booking', // Optional
        'removeButtonText' => 'Remove Date of Booking', // Optional
        'maxItems'         => 3, // Optional
        'pageNumber'       => 1, // Ensure this is correct
        'fields'           => array( $name, $email ), // Add the fields here.
    ) );
 
    $form['fields'][] = $team;
 
    return $form;
}
 
// Remove the field before the form is saved. Adjust your form ID
//add_filter( 'gform_form_update_meta_3', 'remove_my_field', 10, 3 );
function remove_my_field( $form_meta, $form_id, $meta_name ) {
 
    if ( $meta_name == 'display_meta' ) {
        // Remove the Repeater field: ID 1000
        $form_meta['fields'] = wp_list_filter( $form_meta['fields'], array( 'id' => 1000 ), 'NOT' );
    }
 
    return $form_meta;
}


// removes Order Notes Title – Additional Information
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

add_action( 'gform_after_submission_2', 'mysite_gform_after_submission_2', 10, 2 ); 
function mysite_gform_after_submission_2 ( $entry, $form ) {
  GFAPI::delete_entry( $entry['id'] );
}

add_action( 'gform_after_submission_11', 'mysite_gform_after_submission_11', 10, 2 ); 
function mysite_gform_after_submission_11 ( $entry, $form ) {
  GFAPI::delete_entry( $entry['id'] );
}

add_action( 'gform_after_submission_9', 'mysite_gform_after_submission_9', 10, 2 ); 
function mysite_gform_after_submission_9 ( $entry, $form ) {
  GFAPI::delete_entry( $entry['id'] );
}


include_once( get_stylesheet_directory() . '/inc/woo-remove-entry-fields.php' );








