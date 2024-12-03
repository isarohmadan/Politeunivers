<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


add_action( 'manage_shop_order_posts_custom_column' , 'misha_order_items_column_cnt' );
  function misha_order_items_column_cnt( $colname ) {
    global $the_order; // the global order object
    if( $colname == 'order_products' ) {
      // get items from the order global object
      $order_items = $the_order->get_items();
      if ( !is_wp_error( $order_items ) ) {
        foreach( $order_items as $order_item ) {
          $product = $order_item->get_product();
          // product checking
          $sku = ( $product && $product->get_sku() ) ? ' - ' . $product->get_sku() : '';
          echo $order_item['quantity'] .' × <a href="' . admin_url('post.php?post=' . $order_item['product_id'] . '&action=edit' ) . '" target="_blank">'. $order_item['name'] . '</a>'. $sku . '<br />';
        }
      }
    } 
  }

// remove breadcrumbs from the shop page
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
function custom_remove_additional_info_tab($tabs) {
     unset($tabs['additional_information']); 
     unset($tabs['description']); return $tabs; 
    } 
Add_filter('woocommerce_product_tabs', 'custom_remove_additional_info_tab', 98);


// function remove_woocommerce_product_short_description() {
//   remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
// }
// add_action('init', 'remove_woocommerce_product_short_description');



// Ganti teks 'Add to Cart' dengan ikon
add_filter('woocommerce_product_add_to_cart_text', 'custom_add_to_cart_icon'); // Untuk produk di halaman arsip
add_filter('woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_icon'); // Untuk produk di halaman tunggal

function custom_add_to_cart_icon($tabs) {
    return $tabs = "add to cart !";
}

// if the page was shop page then add this banner

function load_woocommerce_css_on_shop_page() {
    if (is_woocommerce() ) { // Only load on the shop page
        wp_enqueue_style( 'woocommerce-custom-css', get_template_directory_uri() . '/asset/css/woocommerce.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'load_woocommerce_css_on_shop_page' );

add_action( 'woocommerce_before_main_content', 'custom_banner_main_content',5);
function custom_banner_main_content(){
    if(is_shop() || is_product_category()){
        // add your banner here
        get_template_part('template-parts/layout/banner');
    }else{
        return;
    }
}



add_filter('woocommerce_swatches_get_swatch_anchor_css_class', 'add_swatch_out_stock_class', 10, 2);

function add_swatch_out_stock_class( $anchor_classes, $swatch_term ) {
    if ( is_product() ) {
        global $post;
        $product = wc_get_product($post);

        if ( $product->get_type() === 'variable' ) {
            foreach( $product->get_available_variations() as $variation ) {
                $product_variation = new WC_Product_Variation($variation['variation_id']);

                if( $product_variation->get_stock_quantity() === 0 ) {
                    foreach( $product_variation->get_variation_attributes() as $var_attribute) {
                        if( $swatch_term->term_slug === $var_attribute) {
                            $anchor_classes .= ' out-of-stock';
                        }
                    }
                }
            }
        }
    }
    return $anchor_classes;
}




add_filter('woocommerce_get_image_size_single', 'custom_single_product_image_size');

function custom_single_product_image_size($size) {
    $size['width'] = 800; // Lebar maksimal
    $size['height'] = 800; // Tinggi maksimal
    $size['crop'] = 1; // Memotong gambar jika melebihi ukuran yang ditentukan
    return $size;
}

// add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'custom_remove_variation_label' );

// // function custom_remove_variation_label( $args ) {
// //     if ( $args['attribute'] == 'pa_size' ) { // Assuming 'name' is the correct key
// //         $args['show_option_none'] = 'Sizes';
// //     } elseif ( $args['attribute'] == 'pa_color' ) {
// //         $args['show_option_none'] = 'Colors';
// //     }
// //     return $args;

// // }


add_filter( 'woocommerce_get_availability', 'custom_override_get_availability', 10, 2 );

function custom_override_get_availability( $availability, $_product ) {

  $stock_quantity = $_product->get_stock_quantity();

  if ( 0 === $stock_quantity ) {
    $availability['availability'] = 'Available on backorder';
  } elseif ( $stock_quantity < 10 ) {
    $availability['availability'] = sprintf( 'available', $stock_quantity );
  } else {
    $availability['availability'] = sprintf( '%s left in stock', $stock_quantity );
  }

  return $availability;
}


add_filter('woocommerce_reset_variations_link', '__return_empty_string');
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'editor-color-palette' );
add_filter( 'wc_product_sku_enabled', '__return_false' );



//change the template of @hooked woocommerce_show_roduct_images - 20

// remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
// add_action( 'woocommerce_before_single_product_summary', 'custom_show_product_images', 20 );


//remove the default before cart
remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);


remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'custom_template_loop_product_thumbnail', 10);
function custom_template_loop_product_thumbnail(){
    global $product;
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' );
    echo '<img src="'.$image[0].'" alt="'.$product->get_name().'" />';
}


/**
 * Include a Post Template rule type
 */
function acf_post_template_rule_type( $rule_types ) {
  if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
      return $rule_types;
  }
  $rule_types['Post']['post_template'] =  __("Post Template",'acf');
  return $rule_types;
}
add_filter('acf/location/rule_types', 'acf_post_template_rule_type', 10, 1);

/**
 * Supply values for the Post Template rule type
 */
function acf_post_template_rule_values ( $choices ) {
  if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
      return $choices;
  }
  $args = array('public' => true, 'capability_type' => 'post');
  $post_types = get_post_types( $args );
  $post_templates = array( 'none' => 'None' );
  foreach ($post_types as $key => $post_type) {
    $post_templates = array_merge($post_templates, get_page_templates(null, $post_type) );
  }
  foreach( $post_templates as $k => $v ) {
    $choices[ $v ] = $k;
  }
  return $choices;
}
add_filter( 'acf/location/rule_values/post_template', 'acf_post_template_rule_values', 10, 1 );

/**
 * Match the rule type and edit screen
 */
add_filter('acf/location/rule_match/post_template', 'acf_location_rules_match_post_template', 10, 3);
function acf_location_rules_match_post_template( $match, $rule, $options ) {
  if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
      return $match;
  }
  // copied from acf_location::rule_match_page_template (advanced-custom-fields-pro/core/location.php)

  // bail early if not a post
  if( !$options['post_id'] ) return false;
  // vars
  $page_template = $options['page_template'];
  // get page template
  if( !$page_template ) {
    $page_template = get_post_meta( $options['post_id'], '_wp_page_template', true );
  }

  // get page template again
  if( !$page_template ) {
    $post_type = $options['post_type'];
    if( !$post_type ) {
      $post_type = get_post_type( $options['post_id'] );
    }
    if( $post_type === 'page' ) {
      $page_template = "default";
    }
  }

  // compare
  if( $rule['operator'] == "==" ) {
    $match = ( $page_template === $rule['value'] );
  } elseif( $rule['operator'] == "!=" ) {
    $match = ( $page_template !== $rule['value'] );
  }

  // return
  return $match;
}

add_action('woocommerce_after_shipping_rate', 'tampilkan_store_address_for_local_pickup', 10, 2);

function tampilkan_store_address_for_local_pickup($method, $index) {
    if ('local_pickup' === $method->method_id) {
        // Ambil Store Address dari pengaturan WooCommerce
        $store_address = get_option('woocommerce_store_address');
        $store_address_2 = get_option('woocommerce_store_address_2');
        $store_city = get_option('woocommerce_store_city');
        $store_postcode = get_option('woocommerce_store_postcode');
        $store_country = WC()->countries->get_base_country();
        $store_state = WC()->countries->get_base_state();

        // Format alamat toko
        $full_address = $store_address;
        if ($store_address_2) {
            $full_address .= ', ' . $store_address_2;
        }
        $full_address .= ', ' . $store_city . ', ' . $store_state . ' ' . $store_postcode;
        $full_address .= ', ' . WC()->countries->countries[$store_country];

        // Tampilkan di bawah metode Local Pickup
        echo '<div class="store-address" style="margin-top: 10px; font-size: 14px;">
                <strong>Pickup Location:</strong>
                <p>' . esc_html($full_address) . '</p>
              </div>';
    }
}

add_filter( 'woocommerce_package_rates', 'custom_conditional_shipping', 10, 2 );
function custom_conditional_shipping( $rates, $package ) {
    // Nama kabupaten tempat toko Anda berada
    $kabupaten_toko = 'Kabupaten Badung';

    // Ambil kabupaten pelanggan dari field 'city'
    $kabupaten_pelanggan = $package['destination']['city'];
    // Jika kabupaten pelanggan tidak sama dengan kabupaten toko
    if ( strtolower($kabupaten_pelanggan) !== strtolower($kabupaten_toko) ) {
        // Hapus Local Pickup
        foreach ( $rates as $rate_key => $rate ) {
            if ( $rate->method_id === 'local_pickup' ) {
                unset( $rates[$rate_key] );
            }
        }
    }

    return $rates;
}



add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}