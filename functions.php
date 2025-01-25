<?php
/**
 * politeunivers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package politeunivers
 */

if ( ! defined( 'POLITEUNIVERS_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'POLITEUNIVERS_VERSION', 'smum0p' );
}

if ( ! defined( 'POLITEUNIVERS_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `politeunivers_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'POLITEUNIVERS_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'politeunivers_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function politeunivers_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on politeunivers, use a find and replace
		 * to change 'politeunivers' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'politeunivers', get_template_directory() . '/languages' );

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



		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary Menu', 'politeunivers' ),
				'menu-2' => __( 'Footer Menu', 'politeunivers' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'politeunivers_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function politeunivers_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'politeunivers' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'politeunivers' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'politeunivers_widgets_init' );


// import js swiper 
function politeunivers_enqueue_script() {
	//include js swiper css
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/js/package/swiper-bundle.min.css', array(),null );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/package/swiper-bundle.min.js', array(),null , true );
}
add_action( 'wp_enqueue_scripts', 'politeunivers_enqueue_script' );


function theme_enqueue_styles() {
    wp_enqueue_style('tailwind-style', get_template_directory_uri() . '/asset/css/style.css', [], '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


/**
 * Enqueue scripts and styles.
 */
function politeunivers_scripts() {
	wp_enqueue_style( 'politeunivers-style', get_stylesheet_uri(), array(), POLITEUNIVERS_VERSION );
	wp_enqueue_script( 'politeunivers-script', get_template_directory_uri() . '/js/script.min.js', array(), POLITEUNIVERS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'politeunivers_scripts' );


add_action( 'after_setup_theme', 'check_woocommerce_active' );

function check_woocommerce_active() {
    // Cek apakah WooCommerce aktif
    if ( ! class_exists( 'WooCommerce' ) ) {
        if ( is_admin() ) {
            // Tampilkan notifikasi di dashboard
            add_action( 'admin_notices', function() {
                echo '<div class="notice notice-error"><p>' . __( 'WooCommerce is not active. Please install and activate WooCommerce plugin.', 'text-domain' ) . '</p></div>';
            } );
        }
    } else {
        // WooCommerce aktif, tambahkan dukungan tema
        add_theme_support( 'woocommerce',array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
	
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 2,
				'max_rows'        => 8,
				'default_columns' => 2,
				'min_columns'     => 2,
				'max_columns'     => 3,
			),
		) );
    }
}

	

/**
 * Add style from <asset>/css/main.css
 */
function politeunivers_enqueue_styles() {
    wp_enqueue_style( 'politeunivers-style', get_stylesheet_uri() );
    wp_enqueue_style( 'fonts', get_template_directory_uri() . '/asset/css/font.css'); // Tambahkan "/" sebelum path 'asset'
    wp_enqueue_style( 'style', get_template_directory_uri() . '/asset/css/main.css'); // Tambahkan "/" sebelum path 'asset'
}
add_action( 'wp_enqueue_scripts', 'politeunivers_enqueue_styles' );


/**
 * Enqueue the block editor script.
 */
function politeunivers_enqueue_block_editor_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'politeunivers-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			POLITEUNIVERS_VERSION,
			true
		);
		wp_add_inline_script( 'politeunivers-editor', "tailwindTypographyClasses = '" . esc_attr( POLITEUNIVERS_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'politeunivers_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function politeunivers_tinymce_add_class( $settings ) {
	$settings['body_class'] = POLITEUNIVERS_TYPOGRAPHY_CLASSES;
	return $settings;
}
// add_filter( 'tiny_mce_before_init', 'politeunivers_tinymce_add_class' );
// add_filter( 'product_attributes_type_selector' ,function($types) {
// 	$types['color'] = __('Color', 'woocommerce');
// 	return $types;
// });


add_filter('nav_menu_css_class', function($classes, $item, $args, $depth) {
    if (in_array('menu-item-has-children', $classes)) {
        // Menambahkan class Tailwind untuk item yang memiliki submenu
        $classes[] = 'relative group'; // Tambahkan class Tailwind khusus untuk dropdown
    }
    return $classes;
}, 10, 4);

add_filter('nav_menu_submenu_css_class', function($classes, $args, $depth) {
    // Menambahkan class Tailwind khusus untuk elemen <ul> submenu
    $classes[] = 'absolute hidden bg-white text-gray-700 shadow-lg mt-2 p-2';
    return $classes;
}, 10, 3);





function custom_enqueue_variation_swatches_scripts() {
	// if it's not front-page then dont load the script
	if (!is_front_page()) {
        return;
    }
	wp_enqueue_script( 'js', get_template_directory_uri() . '/js/fp-swiper.js', array() );
    // wp_enqueue_style('custom-variation-swatches', get_template_directory_uri() . '/css/variation-swatches.css');
    // wp_enqueue_script('custom-variation-swatches', get_template_directory_uri() . '/js/variation-swatches.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'custom_enqueue_variation_swatches_scripts');


function custom_enqueue_gallery_scripts() {
  // Periksa apakah halaman saat ini menggunakan template 'template-gallery.php'
    if (is_page_template('templates/lookbooks-swiper.php') || is_page_template('templates/lookbooks-gallery2.php')) {
	    wp_enqueue_script('gallery-script', get_template_directory_uri() . '/js/lookbooks.js', array(), null, true);
        wp_enqueue_style('gallery-style', get_template_directory_uri() . '/asset/css/lookbooks.css');
    }
	if(is_page_template('templates/contact-me.php')){
		wp_enqueue_style('gallery-style', get_template_directory_uri() . '/asset/css/form.css');
	}
	if(is_page_template('templates/contact.php')){
		wp_enqueue_script('gallery-script', get_template_directory_uri() . '/js/about.js', array(), null, true);
	}
		if(is_page_template( 'templates/retailers.php' )){
		wp_enqueue_style('retailers-style', get_template_directory_uri() . '/asset/css/retailers.css');
	}
		if(is_page_template( 'templates/about-blank.php' )){
		wp_enqueue_style('blank-style', get_template_directory_uri() . '/asset/css/blank.css');
	}
}

add_action('wp_enqueue_scripts', 'custom_enqueue_gallery_scripts');


function custon_enqueue_archive() {
	if (is_archive()) {
		wp_enqueue_style('archive-style', get_template_directory_uri() . '/asset/css/lookbooks.css');
		wp_enqueue_script('archive-script', get_template_directory_uri() . '/js/archive-lookbooks.js', array(), null, true);
	}
}

add_action('wp_enqueue_scripts', 'custon_enqueue_archive');


// add javascript main js
function politeunivers_enqueue_js() {
	wp_enqueue_script('main-js', get_template_directory_uri() . '/js/app.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'politeunivers_enqueue_js');


// Increase WooCommerce Variation Limit
function custom_wc_ajax_variation_threshold( $qty, $product ) {
	return 100;
	}
	
	add_filter( 'woocommerce_ajax_variation_threshold', 'custom_wc_ajax_variation_threshold', 100, 2 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

require_once('hooks/setup-acf.php');
require_once('hooks/woocomerce-hooks.php');

// Register Custom Navigation Walker

require_once __DIR__ . '/vendor/autoload.php';
add_action('init', function() {
    if (!class_exists('Log1x\Navi\Navi')) {
        error_log('Navi class tidak ditemukan');
    } else {
        error_log('Navi class berhasil dimuat');
    }
});


// include css and js for achieve page if the page is archieve php 
function custom_enqueue_archive_scripts() {
	// Periksa apakah halaman saat ini menggunakan template 'template-gallery.php'
	if (is_archive()) {
		wp_enqueue_style('archive-style', get_template_directory_uri() . '/asset/css/lookbooks.css');
	}
}
add_action('wp_enqueue_scripts', 'custom_enqueue_archive_scripts');


    // // Remove the Product SKU from Product Single Page
	// add_filter( 'wc_product_sku_enabled', 'woocustomizer_remove_product_sku' );

	// function woocustomizer_remove_product_sku( $sku ) {
	// 	 // Remove only if NOT admin and is product single page
	// 	 if ( ! is_admin() && is_product() ) {
	// 		 return false;
	// 	 }
	// 	 return $sku;
	//  }


	add_filter( 'wc_product_sku_enabled', '__return_false' );	
