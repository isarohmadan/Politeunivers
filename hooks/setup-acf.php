<?php
/** Theme after setup **/
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
// @ini_set( 'max_execution_time', '300' );

// if (!function_exists( 'p_setup')) {
// 	function p_setup() {
// 		// add_theme_support( 'automatic-feed-links' );
// 		// add_theme_support( 'post-thumbnails');
// 		// add_theme_support( 'woocommerce', array(
// 		// 'thumbnail_image_width' => 800,
// 		// 'single_image_width' => 600,
// 		// ));
// 		remove_action( 'wp_head', 'wp_generator' );
	
// 		if (function_exists('add_image_size')) {
// 			add_image_size('square', 600, 600, false);
// 			add_image_size('thumbnail', 400, 600, false);
// 			add_image_size('gallery_cover', 1920, 1080, true);
// 			add_image_size('gallery_thumbnail', 900, 600, true);
// 			add_image_size('fullsize', 9999, 9999, false);
// 		};
// 	};
// };
// add_action('after_setup_theme', 'p_setup');

wp_enqueue_style('acf-input', get_template_directory_uri() . '/inc/acf/assets/build/css/acf-input.min.css', array(), '1.0.0');
wp_enqueue_script('acf-pro-input', get_template_directory_uri() . '/inc/acf/assets/build/js/pro/acf-pro-input.min.js', array('jquery'), '1.0.0', true);


/** Advanced Cust om Fields Distribution **/
// Customize ACF path
add_filter('acf/settings/path', 'p_acf_settings_path');
function p_acf_settings_path($path) {
	$path = get_stylesheet_directory().'/inc/acf/';
	return $path;
}

// Customize ACF dir
add_filter('acf/settings/dir', 'p_acf_settings_dir');
function p_acf_settings_dir($dir) {
	$dir = get_stylesheet_directory_uri().'/inc/acf/';
	return $dir;
}

// Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');


// Add ACF Option Page
if( function_exists('acf_add_options_page') ) {
	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'Site Options',
		'menu_title' 	=> 'Site Options',
		'menu_slug'		=> 'theme_options',
		'capability' 	=> 'manage_options',
		'position'		=> 2,
		'icon_url'		=> 'dashicons-admin-generic',
		'post_id'		=> 'theme_options',
		'redirect'		=> false,
		'autoload'		=> true
	));
	
}

function save_options_page() {
	$screen = get_current_screen();
	if (strpos($screen->id, "theme_options") == true) {
		update_option('site_icon', $_POST['acf']['field_58dbb82544958']);
		update_option('blogname', $_POST['acf']['field_5937c1f59fa1c']);
		update_option('blogdescription', $_POST['acf']['field_5937c20a9fa1d']);
	}
}
add_action('acf/save_post', 'save_options_page', 20);

add_action('update_option_site_icon', 'update_site_icon_acf', 10, 2);
function update_site_icon_acf($old_value, $value) {
	update_field('field_58dbb82544958', $value, 'theme_options');
}

add_action('update_option_blogname', 'update_blogname_acf', 10, 2);
function update_blogname_acf($old_value, $value) {
	update_field('field_5937c1f59fa1c', $value, 'theme_options');
}

add_action('update_option_blogdescription', 'update_blogdescription_acf', 10, 2);
function update_blogdescription_acf($old_value, $value) {
	update_field('field_5937c20a9fa1d', $value, 'theme_options');
}

// add_filter( 'woocommerce_enqueue_styles', 'p_dequeue_styles' );
// function p_dequeue_styles( $enqueue_styles ) {
// unset( $enqueue_styles['1~	'] );	// Remove the gloss
// 	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
// 	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
// 	return $enqueue_styles;
// }

//Remove woocommerce style
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );

//get_option('woocommerce_shop_page_id')

// add_filter( 'body_class', 'append_acf__body_class' );
// function append_acf__body_class( $classes ) {
// 	$post = get_queried_object();
// 	$post_id = $post->ID;
// 	$theme_color = get_field('navigation_color', $post_id);
	
// 	if ( $theme_color ) {
//     	$theme_color	= esc_attr(trim($theme_color));
// 		$classes[]		= $theme_color;
// 	}
// 	return $classes;
// }


// Add Variation Settings
add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );

// Save Variation Settings
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );

/**
 * Create new fields for variations
 *
*/
function variation_settings_fields( $loop, $variation_data, $variation ) {

	// Text Field
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_text_field[' . $variation->ID . ']', 
			'label'       => __( 'SKU', 'woocommerce' ), 
			'placeholder' => 'SKU Product',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the custom value here.', 'woocommerce' ),
			'value'       => get_post_meta( $variation->ID, '_text_field', true )
		)
	);
}

/**
 * Save new fields for variations
 *
*/
function save_variation_settings_fields( $post_id ) {

	// Text Field
	$text_field = $_POST['_text_field'][ $post_id ];
	if( ! empty( $text_field ) ) {
		update_post_meta( $post_id, '_text_field', esc_attr( $text_field ) );
	}

}


// function create_lookbooks_cpt() {
//     register_post_type('lookbook',
//         array(
//             'labels' => array(
//                 'name' => __('Lookbooks'),
//                 'singular_name' => __('Lookbook')
//             ),
//             'public' => true,
//             'has_archive' => true,
//             'supports' => array('title', 'editor', 'thumbnail' , 'custom-fields' , 'page-attributes'),
//             'menu_icon' => 'dashicons-format-gallery',
//         )
//     );
// }
// add_action('init', 'create_lookbooks_cpt');


if (function_exists('acf_add_local_field_group')):

	acf_add_local_field_group(array(
		'key' => 'group_product_video',
		'title' => 'Product Video',
		'fields' => array(
			array(
				'key' => 'field_video_mp4',
				'label' => 'Video MP4',
				'name' => 'video_mp4_field',
				'type' => 'file',
				'instructions' => 'Upload a video in MP4 format.',
				'required' => 0,
				'return_format' => 'url',
				'library' => 'all',
				'mime_types' => 'mp4',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
	endif;


	add_action('acf/init', function() {
		if (function_exists('acf_add_local_field_group')) {
			acf_add_local_field_group(array(
				'key' => 'group_1',
				'title' => 'Custom Field Group for Gallery',
				'fields' => array(),
				'location' => array(
					array(
						array(
							'param' => 'page_template',
							'operator' => '==',
							'value' => 'template-gallery.php', // Nama file template page
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));
	
			for ($i = 1; $i <= 21; $i++) {
				acf_add_local_field(array(
					'key' => 'field_' . $i,
					'label' => 'Image URL ' . $i,
					'name' => 'image_url_' . $i,
					'type' => 'url', // Field untuk URL gambar
					'parent' => 'group_1',
				));
			}
		}
	});


		
	

