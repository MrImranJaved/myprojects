<?php
    // Start the session
    session_start();

    // Turn off error reporting
    error_reporting(0);

    // Report runtime errors
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    // Report all errors
    error_reporting(E_ALL);

    // Same as error_reporting(E_ALL);
    ini_set("error_reporting", E_ALL);

    // Report all errors except E_NOTICE
    error_reporting(E_ALL & ~E_NOTICE);


    /** latest-market-insights shortcode */
    include_once('customscripts/functioins/latest-market-insights-shortcodes.php');

    add_action('wp_enqueue_scripts', 'porto_child_css', 1001);

    // Load CSS
    function porto_child_css()
    {
        // porto child theme styles
        wp_deregister_style('styles-child');
        wp_register_style('styles-child', esc_url(get_stylesheet_directory_uri()) . '/style.css');
        wp_enqueue_style('styles-child');
        /*ij custom styles*/
        wp_register_style('ij-custom-styles-child', esc_url(get_stylesheet_directory_uri()) . '/css/ij-custom-style.css', array(), time());
        wp_enqueue_style('ij-custom-styles-child');
        /* Report page styles */
        if ( is_product() ) {

            wp_register_style('ij-custom-report-page-styles', esc_url(get_stylesheet_directory_uri()) . '/css/ij-custom-report-page-style.css', array(), time());
            wp_enqueue_style('ij-custom-report-page-styles');
        }

        if (is_rtl()) {
            wp_deregister_style('styles-child-rtl');
            wp_register_style('styles-child-rtl', esc_url(get_stylesheet_directory_uri()) . '/style_rtl.css');
            wp_enqueue_style('styles-child-rtl');
        }
    }

    function ij_get_productcat_postcount($id)
    {

        //return $count;
        $args = array(
            'post_type'     => 'product', //post type, I used 'product'
            'post_status'   => 'publish', // just tried to find all published post
            'posts_per_page' => -1,  //show all
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',  //taxonomy name  here, I used 'product_cat'
                    'field' => 'id',
                    'terms' => array($id)
                )
            )
        );

        $query = new WP_Query($args);

        /*
        echo '<pre>';

        print_r($query->post_count);
        echo '</pre>';
        */

        return (int)$query->post_count;
    }


    function ij_get_report_category_name($report) {
        global $product;

        $categoryName = '';
        $product_cats_ids = wc_get_product_term_ids( $product->get_id(), 'product_cat' );
        foreach( $product_cats_ids as $cat_id ) {
            $term = get_term_by( 'id', $cat_id, 'product_cat' );
            $categoryName = $term->name;
        }

        return $categoryName;

    }


    function ij_fetch_child_product_categories($parent_term_id)
    {

        //$this_category = get_category($cat);
        //echo $this_category->cat_ID;
        // $parent_term_id =$this_category->cat_ID; // term id of parent term

        //$termchildren = get_terms('category',array('child_of' => $parent_id));
        $taxonomies = array(
            'taxonomy' => 'category'
        );

        $args = array(
            // 'parent'         => $parent_term_id,
            'child_of'      => $parent_term_id
        );

        $terms = get_terms($taxonomies, $args);
        if (sizeof($terms) > 0) {

            echo ' <div class="categories">  ';
            echo '<p> Sub Categories of ' . get_cat_name($parent_term_id) . '</p>';

            foreach ($terms as $term) {

                $term_link = sprintf(
                    '<div class="custom-cats"><a href="%1$s" alt="%2$s">%3$s</a></div>',
                    esc_url(get_category_link($term->term_id)),
                    esc_attr(sprintf('View all posts in %s', 'textdomain'), $term->name),
                    esc_html($term->name)
                );

                echo sprintf($term_link);
            }
            echo '</div><!-- categories div end-->';
        }
    }



    function ij_get_child_categories()
    {

        $term = get_queried_object();

        $children = get_terms($term->taxonomy, array(
            'parent'    => $term->term_id,
            'hide_empty' => false
        ));

        if ($children) {

            foreach ($children as $subcat) {
                echo '<li><a href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . '</a></li>';
            }
        }
    }

    function RemoveSpecialChar($str)
    {

        // Using preg_replace() function 
        // to replace the word 
        $res = preg_replace('/[^&#;a-zA-Z0-9_ -]/s', ' ', $str);

        // Returning the result 
        return $res;
    }

    /*
      add_action( 'init', 'ij_buynow_script_enqueuer' );

    function ij_buynow_script_enqueuer() {
       wp_register_script( "ij_report_buynow", get_stylesheet_directory_uri().'/js/ij_report_buynow.js', array('jquery') );
       wp_localize_script( 'ij_report_buynow', 'ijAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

       wp_enqueue_script( 'jquery' );
       wp_enqueue_script( 'ij_report_buynow' );

    }
    */

    // add_action('wp_ajax_wdm_add_user_custom_data_options_callback', 'wdm_add_user_custom_data_options_callback');
    // add_action('wp_ajax_nopriv_wdm_add_user_custom_data_options_callback', 'wdm_add_user_custom_data_options_callback');

    function wdm_add_user_custom_data_options_callback()
    {
        //Custom data - Sent Via AJAX post method


        /*
          echo "<pre>";
          print_r($_POST);
          echo "</pre>";
          */
        echo "I am pinged";
        //$product_id = $_POST['id']; //This is product ID
        //$user_custom_data_values =  $_POST['user_data']; //This is User custom value sent via AJAX
        //session_start();
        // $_SESSION['wdm_user_custom_data'] = $user_custom_data_values;
        die();
    }

    // Enqueue OwlCarousel  CSS Files

    add_action( 'wp_enqueue_scripts', 'ij_owl_carousel_register_styles' ); 
    /* Enqueue Register style sheet. */
    function ij_owl_carousel_register_styles() { 

       // Register them style 
       wp_register_style( 'ij_owl_carousel_min_css', get_stylesheet_directory_uri() . '/css/owlcarousel/css/owl.carousel.min.css' );
       // Enqueue Style
       wp_enqueue_style( 'ij_owl_carousel_min_css' );

        // Register them style 
       wp_register_style( 'ij_owl_default_min_css', get_stylesheet_directory_uri() . '/css/owlcarousel/css/owl.theme.default.min.css' );
       // Enqueue Style
       wp_enqueue_style( 'ij_owl_default_min_css' );


        // Register them script 
       wp_register_script( 'ij_owl_default_min_js', get_stylesheet_directory_uri() . '/css/owlcarousel/js/owl.carousel.min.js' );
       // Enqueue script
       wp_enqueue_script( 'ij_owl_default_min_js' );
    }



    // Change WooCommerce "Related products" text

    add_filter('gettext', 'change_rp_text', 10, 3);
    add_filter('ngettext', 'change_rp_text', 10, 3);

    function change_rp_text($translated, $text, $domain)
    {
        if ($text === 'Related products' && $domain === 'woocommerce') {
            $translated = esc_html__('Related Reports', $domain);
        }
        return $translated;
    }
    /*
    function ij_theme_enqueue_styles() {

        $product_page_style = 'product-page-style';

        wp_enqueue_style( $product_page_style, get_stylesheet_directory_uri() . '/css/product-page-styles.css' );

    }
    add_action( 'wp_enqueue_scripts', 'ij_theme_enqueue_styles' );
    */

    function numberToNumberName($number)
    {

        $numberName = '';
        if ($number == 1) {

            $numberName = 'One';
        } else if ($number == 2) {

            $numberName = 'Two';
        } else if ($number == 3) {

            $numberName = 'Three';
        } else if ($number == 4) {

            $numberName = 'Four';
        } else if ($number == 5) {

            $numberName = 'Five';
        } else if ($number == 6) {

            $numberName = 'Six';
        } else if ($number == 7) {

            $numberName = 'Seven';
        } else if ($number == 8) {

            $numberName = 'Eight';
        } else if ($number == 9) {

            $numberName = 'Nine';
        } else if ($number == 10) {

            $numberName = 'Ten';
        }

        return $numberName;
    }

    function ij_get_products()
    {

        $args = array(

            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => 5

        );
        $products = get_posts($args);
        return $products;
    }

    function ij_get_product_title_id($id)
    {

        return get_the_title($id);
    }



    function ij_get_parent_category_name_by_childCategory_id($categoryid)
    {

        $categories = get_categories(

            array(
                'post_type' => 'product',
                'taxonomy'  => 'product_cat',
                'cat_ID'  => $categoryid,
                'parent' => 0
            )
        );

        foreach ($categories as  $c) {
            $Category_name = $c->name;
        }
        return $Category_name;
    }



    function ij_get_parent_category_slug_by_childCategory_id($categoryid)
    {

        $categories = get_categories(

            array(
                'post_type' => 'product',
                'taxonomy'  => 'product_cat',
                'cat_ID'  => $categoryid,
                'parent' => 0
            )
        );

        foreach ($categories as  $c) {
            $Category_slug = $c->slug;
        }
        return $Category_slug;
    }



    add_action('wp_ajax_fetch_child_categories', 'fetch_child_categories');
    add_action('wp_ajax_nopriv_fetch_child_categories', 'fetch_child_categories');
    function fetch_child_categories()
    {

        $parentid =  isset($_POST['parentid']) ?  $_POST['parentid'] : '';

        if ($parentid) {


                $children = get_terms( 'product_cat', array(
                    'parent'    => $parentid ,
                    'hide_empty' => false
                ) );
                if ( $children ) { 
                    echo '<h2 style="margin-bottom:10px; font-weight: 600;">SUB CATEGORIES OF:</h2>';
                    echo '<p style="line-height: 1; font-size: 1rem; color: #0b5b82; text-align: left; text-transform: uppercase;">' . get_the_category_by_ID($parentid) . '</p>';
                    echo '<ul>';
                    foreach( $children as $subcat )
                    {
                        echo '<li  class="childcategory-sidebar">  <a href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . '</a></li>';
                    }
                    echo '</ul>';
                }else {

                    echo '<h2>No Sub Categories</h2>';

                }

        } else {

            echo '<h2 class="widgettitle" style="line-height: 1;">SUBCATEGORIES NOT FOUND</h2>';
        }



        // if ($parentid) {
        // 	$catTerms = get_terms('product_cat', array(

        // 		'orderby' => 'ASC',
        // 		'parent' =>  $parentid
        // 	));
        // 	$str = '';
        // 	$str .= '<h2 class="widgettitle yyy" style="line-height: 1.5;">SUB CATEGORY OF:</h2>';
        // 	$str .= '<p style="line-height: 1; font-size: 1rem; color: #0b5b82; text-align: left; text-transform: uppercase;">' . get_the_category_by_ID($parentid) . '</p>';
        // 	$str .= '<ul class="sidebar-ij-child-cat">';
        // 	foreach ($catTerms as $catTerm) {
        // 		$str .= '<li>';
        // 		$str .= '<a href="' . get_term_link($catTerm) . '" >' . $catTerm->name . '</a>';
        // 		$str .= '</li>';
        // 	}
        // 	$str .= '</ul>';
        // 	echo $str;
        // } else {

        // 	echo '<h2 class="widgettitle" style="line-height: 1;">SUBCATEGORIES NOT FOUND</h2>';
        // }

        die();
    }


	/**
 * Add custom taxonomy to Product post type
 *
 * Additional custom taxonomies can be defined here
 * https://codex.wordpress.org/Function_Reference/register_taxonomy
 */
 
 /*
function add_custom_taxonomies() {
  // Add new "Regions" taxonomy to Posts
  register_taxonomy('region', 'product', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Regions', 'taxonomy general name' ),
      'singular_name' => _x( 'Region', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Regions' ),
      'all_items' => __( 'All Regions' ),
      'parent_item' => __( 'Parent Region' ),
      'parent_item_colon' => __( 'Parent Region:' ),
      'edit_item' => __( 'Edit Region' ),
      'update_item' => __( 'Update Region' ),
      'add_new_item' => __( 'Add New Region' ),
      'new_item_name' => __( 'New Region Name' ),
      'menu_name' => __( 'Regions' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'Regions', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/Countries/"
      'hierarchical' => true // This will allow URL's like "/Countries/boston/cambridge/"
    ),
  ));
}
add_action( 'init', 'add_custom_taxonomies', 0 );

*/
    function ij_get_related_reports($catArra, $reportid)
    {

	


        //Now use ids from array:
        $args = array(
				'posts_per_page' => 3,
				'post_type' => 'product',
				//'offset' => 0,
				'post__not_in'     => array($reportid),
            'tax_query'     => array(
                array(
                    'taxonomy'  => 'product_cat',
                    'field'     => 'id',
                    'terms'     => $catArra,
					'include_children' => false // Remove if you need posts from term 7 child terms

                )
            )
			/*,
				'meta_query' => array(
					array(
						'key' => 'isaddedasrelated',
						'value' => $producerIds,
						'compare' => '='
					)
				)
				*/
        );


        $products = get_posts($args);
        return $products;
    }
	function GetRelatedReportsByCatID($ReportCategoryId)
    {

		//Now use ids from array:
        $args = array(
            'posts_per_page' => 5,
            'post_type' => 'product',
            'tax_query'     => array(
                array(
                    'taxonomy'  => 'product_cat',
                    'field'     => 'term_id',
                    'terms'     => $ReportCategoryId
                )
            )
			
        );


        $products = get_posts($args);
        return $products;
    }
	
	function get_reports()
    { 
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'product' 
            
			
        );


        $reports = get_posts($args);
        return $reports;
    }

    function nameofmonth($month)
    {

        $nameOfMonth = '';
        if ($month == 1) {

            $nameOfMonth = 'Jan';
        } else if ($month == 2) {

            $nameOfMonth = 'Fab';
        } else if ($month == 3) {

            $nameOfMonth = 'Mar';
        } else if ($month == 4) {

            $nameOfMonth = 'Apr';
        } else if ($month == 5) {

            $nameOfMonth = 'May';
        } else if ($month == 6) {

            $nameOfMonth = 'Jun';
        } else if ($month == 7) {

            $nameOfMonth = 'Jul';
        } else if ($month == 8) {

            $nameOfMonth = 'Aug';
        } else if ($month == 9) {

            $nameOfMonth = 'Sep';
        } else if ($month == 10) {

            $nameOfMonth = 'Oct';
        } else if ($month == 11) {

            $nameOfMonth = 'Nov';
        } else if ($month == 12) {

            $nameOfMonth = 'Dec';
        }
        return $nameOfMonth;
    }



    function ij_report_ajax_script()
    {

        $reportajaxscriptpath = 	get_stylesheet_directory_uri() . '/js/reports-ajax-call.js?ver=' . time();
        wp_enqueue_script(
            'ij-report-ajax-script',
            $reportajaxscriptpath,
            array('jquery'),
            22
        );

        wp_localize_script(
            'ij-report-ajax-script',
            'ij_market_research_report_object',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'developer-website' =>  'https://www.twitter.com/MrImranJaved'
            )
        );
    }
    add_action('init', 'ij_report_ajax_script');



    /**
     * Create new WooCommerce shortcode [random_product_categories]
     * based on [product_categories] (/wp-content/plugins/woocommerce/includes/class-wc-shortcodes.php)
     * to output product categories randomically.
     *
     * This new shortcode uses all attributes used by [product_categories], except 'orderby' and 'order', of course.
     * See more in //docs.woothemes.com/document/woocommerce-shortcodes/ > Product Categories Section.
     */
    function random_product_categories_shortcode($atts)
    {
        global $woocommerce_loop;

        $atts = shortcode_atts(array(
            'number'     => null,
            'columns'    => '1',
            'hide_empty' => 1,
            'parent'     => 22,
            'ids'        => ''
        ), $atts);

        if (isset($atts['ids'])) {
            $ids = explode(',', $atts['ids']);
            $ids = array_map('trim', $ids);
        } else {
            $ids = array();
        }

        $hide_empty = ($atts['hide_empty'] == true || $atts['hide_empty'] == 1) ? 1 : 0;

        // get terms and workaround WP bug with parents/pad counts
        $args = array(
            'hide_empty' => $hide_empty,
            'include'    => $ids,
            'pad_counts' => true,
            'child_of'   => $atts['parent']
        );

        $product_categories = get_terms('product_cat', $args);

        /**
         * PHP shuffle function will shuffle the array of objects $product_categories
         */
        shuffle($product_categories);

        if ('' !== $atts['parent']) {
            $product_categories = wp_list_filter($product_categories, array('parent' => $atts['parent']));
        }

        if ($hide_empty) {
            foreach ($product_categories as $key => $category) {
                if ($category->count == 0) {
                    unset($product_categories[$key]);
                }
            }
        }

        if ($atts['number']) {
            $product_categories = array_slice($product_categories, 0, $atts['number']);
        }

        $columns = absint($atts['columns']);
        $woocommerce_loop['columns'] = $columns;

        ob_start();

        // Reset loop/columns globals when starting a new loop
        $woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

        if ($product_categories) {

            woocommerce_product_loop_start();

            foreach ($product_categories as $category) {
                wc_get_template(
                    'content-product_cat.php',
                    array(
                        'category' => $category
                    )
                );
            }

            woocommerce_product_loop_end();
        }

        woocommerce_reset_loop();

        return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
    }
    add_shortcode('random_product_categories', 'random_product_categories_shortcode');



    if (!function_exists('kia_add_to_cart_form_shortcode')) {
        /**
         * Display a single product with single-product/add-to-cart/$product_type.php template.
         *
         * @param array $atts Attributes.
         * @return string
         */
        function kia_add_to_cart_form_shortcode($atts)
        {

            if (empty($atts)) {
                return '';
            }

            if (!isset($atts['id'])) {
                return '';
            }

            $atts = shortcode_atts(
                array(
                    'id'            => '',
                    'status'        => 'publish',
                    'show_price'    => 'true',
                    'hide_quantity' => 'false',
                ),
                $atts,
                'product_add_to_cart_form'
            );

            $query_args = array(
                'posts_per_page'      => 1,
                'post_type'           => 'product',
                'post_status'         => $atts['status'],
                'ignore_sticky_posts' => 1,
                'no_found_rows'       => 1,
            );



            if (!empty($atts['id'])) {
                $query_args['p'] = absint($atts['id']);
            }

            // Hide quantity input if desired.
            if ('true' === $atts['hide_quantity']) {
                add_filter('woocommerce_quantity_input_min', 'kia_add_to_cart_form_return_one');
                add_filter('woocommerce_quantity_input_max', 'kia_add_to_cart_form_return_one');
            }

            // Change form action to avoid redirect.
            add_filter('woocommerce_add_to_cart_form_action', '__return_empty_string');

            $single_product = new WP_Query($query_args);

            $preselected_id = '0';

            // Check if sku is a variation.
            if ($single_product->have_posts() && 'product_variation' === $single_product->post->post_type) {

                $variation  = new WC_Product_Variation($single_product->post->ID);
                $attributes = $variation->get_attributes();

                // Set preselected id to be used by JS to provide context.
                $preselected_id = $single_product->post->ID;

                // Get the parent product object.
                $query_args = array(
                    'posts_per_page'      => 1,
                    'post_type'           => 'product',
                    'post_status'         => 'publish',
                    'ignore_sticky_posts' => 1,
                    'no_found_rows'       => 1,
                    'p'                   => $single_product->post->post_parent,
                );

                $single_product = new WP_Query($query_args);
    ?>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        var $variations_form = $('[data-product-page-preselected-id="<?php echo esc_attr($preselected_id); ?>"]').find('form.variations_form');

                        <?php foreach ($attributes as $attr => $value) { ?>
                            $variations_form.find('select[name="<?php echo esc_attr($attr); ?>"]').val('<?php echo esc_js($value); ?>');
                        <?php } ?>
                    });
                </script>
            <?php
            }

            // For "is_single" to always make load comments_template() for reviews.
            $single_product->is_single = true;

            ob_start();

            global $wp_query;

            // Backup query object so following loops think this is a product page.
            $previous_wp_query = $wp_query;
            // @codingStandardsIgnoreStart
            $wp_query          = $single_product;
            // @codingStandardsIgnoreEnd

            wp_enqueue_script('wc-single-product');

            while ($single_product->have_posts()) {
                $single_product->the_post();

            ?>
                <div class="product single-product add_to_cart_form_shortcode" data-product-page-preselected-id="<?php echo esc_attr($preselected_id); ?>">

                    <?php
                    if (wc_string_to_bool($atts['show_price'])) {
                        woocommerce_template_single_price();
                    }
                    ?>

                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>
    <?php
            }

            // Restore $previous_wp_query and reset post data.
            // @codingStandardsIgnoreStart
            $wp_query = $previous_wp_query;
            // @codingStandardsIgnoreEnd
            wp_reset_postdata();

            // Remove filters.
            remove_filter('woocommerce_add_to_cart_form_action', '__return_empty_string');
            remove_filter('woocommerce_quantity_input_min', 'kia_add_to_cart_form_return_one');
            remove_filter('woocommerce_quantity_input_max', 'kia_add_to_cart_form_return_one');

            return '<div class="woocommerce">' . ob_get_clean() . '</div>';
        }
    }
    add_shortcode('add_to_cart_form', 'kia_add_to_cart_form_shortcode');

    if (!function_exists('kia_add_to_cart_form_redirect')) {
        /**
         * Redirect to checkout page
         *
         * @return string
         */
        function kia_add_to_cart_form_redirect($url)
        {
             //$checkouturl =  home_url();
             //return $checkouturl ;
            // $checkouturl =  get_permalink('checkout');
            // return  $checkouturl.'/?product-name=ddd';


        }
    }



    if (!function_exists('kia_add_to_cart_form_return_one')) {
        /**
         * Return integer
         *
         * @return int
         */
        function kia_add_to_cart_form_return_one()
        {
            return 1;
        }
    }

    // To change add to cart text on single product page
    add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text');
    function woocommerce_custom_single_add_to_cart_text()
    {
        return __('Buy Now', 'woocommerce');
    }

    // To change add to cart text on product archives(Collection) page
    add_filter('woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text');
    function woocommerce_custom_product_add_to_cart_text()
    {
        return __('Buy Now', 'woocommerce');
    }


    // add_filter( 'woocommerce_product_add_to_cart_text', 'product_cat_add_to_cart_button_text', 20, 1 );

    // function product_cat_add_to_cart_button_text( $text ) {

    // 	global $product;

    // 	if ( $product->is_purchasable() ) {

    //         $text = __( 'Request For Sample', 'woocommerce' );
    // 	}

    //     return $text;
    // }


    // Change "Add to Cart" > "Add to Bag" in Shop Page
    // add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_shop_page_add_to_cart_callback' );  
    // function woocommerce_shop_page_add_to_cart_callback() {
    //     return __( 'Add to Bag', 'text-domain' );
    // }



    add_filter('woocommerce_add_to_cart_redirect', 'lw_add_to_cart_redirect');
    function lw_add_to_cart_redirect()
    {
        global $woocommerce  ;

        //global $product;
        //$productid = $product->get_id;
        $lw_redirect_checkout = get_site_url() . '/checkout/?reportid=';
        return $lw_redirect_checkout;
    }

    /*
    add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );

        function remove_add_to_cart_buttons() {
          if( is_product_category() || is_shop()) { 
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
          }
        }
    */


    // Replacing the button add to cart by a link to the product in Shop and archives pages for as specific product category
    add_filter('woocommerce_loop_add_to_cart_link', 'replace_loop_add_to_cart_button', 10, 2);
    function replace_loop_add_to_cart_button($button, $product)
    {
        // Only for product category ID 64

        $button_text = __("Buy Now", "woocommerce");
        $button = '<a class="button"  href="' . $product->get_permalink() . '">' . $button_text . '</a>';


        return $button;
    }

    add_action( 'pre_get_posts', 'ij_change_sort_order'); 
        function ij_change_sort_order($query){
            if(is_archive()):
             //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
               //Set the order ASC or DESC
               $query->set( 'order', 'DESC' );
               //Set the orderby
               $query->set( 'orderby', 'date' );
            endif;    
        };


    function ij_k_get_child_categories($parentid)
    {

        $term = get_queried_object();

        $children = get_terms($term->taxonomy, array(
            'parent'    => $parentid,
            'hide_empty' => false
        ));

        if ($children) {
            echo "<h3>Sub Categories</h3>";
            foreach ($children as $subcat) {
                echo '<li><a href="' . esc_url(get_term_link($subcat, $subcat->taxonomy)) . '">' . $subcat->name . '</a></li>';
            }
        }
    }


    function ij_printr($array){

        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
	
	function CheckReportScope($post_id){
		$report_scope = get_field( 'report_scope' , $post_id);
		$scope ='';
		if($report_scope == 'Regional'){
				$scope = 'regional';
		}else if($report_scope == 'Country') {
				$scope = 'country';
        }else {
			
				$scope = 'global';
		}
		
		return $scope;
		
	}

    function productprice($post_id){
		
		$report_scope = get_field( 'report_scope' , $post_id);
		$single_price = get_field( 'single_price' , $post_id);
		$price = '';
		if($report_scope == 'Regional'){
				$price = 2800;
		}else if($report_scope == 'Country') {
				$price = 2600;
        }  else {
			
		if( $post_id == 20005 ){
		    $price =  3490;
		}	else{
		    
		    if( !empty($single_price ) AND $single_price > 0 ){
		        
		        $price = $single_price;
		    }else {
		        
		        
		        
		     $product = wc_get_product($post_id);
              $price = $product->get_regular_price();
              
		   }
    	}
    }
		return $price;
    }

    function reportpublishedDate( $productid ){

            $publishDAte = get_field(  'report_published_date' , $productid);
            $publishDAte =  explode(',' ,$publishDAte);
            $publishD =  substr( $publishDAte[0] , 0 , -2);
            $publishDAte =  $publishD . ' '. $publishDAte[1];
            return $publishDAte;

    }
    add_filter( 'woocommerce_loop_add_to_cart_link', 'ts_replace_add_to_cart_button', 10, 2 );
    function ts_replace_add_to_cart_button( $button, $product ) {

        global $post;
        $productid = $post->ID;

    if (is_product_category() || is_shop()) {
    $button_text1 = __("Buy Now", "woocommerce");
    $button_text2 = __("Download Sample", "woocommerce");
    $button_link1 = $product->get_permalink();
    $button_link2 = home_url()."/request-for-free-sample/?reportid=$productid";
    $button = '<a class="button" href="' . $button_link1 . '">' . $button_text1 . '</a><a class="button" target="blank" href="' . $button_link2 . '">' . $button_text2 . '</a>';
    // $button = '';
    return $button;
    }
    }

    function report_meta_data($productid){


            $publishDAte = reportpublishedDate($productid);
            $pagesReport = get_field(  'report_pages' , $productid );
            $priceReport = productprice(   $productid );
            $report_code = get_field( 'report_code' , $productid );
            $categoryname = ij_get_report_category_name($productid);

        ?>
            <ul class="reportMetaArchive" data-productid="<?php echo $productid; ?>">

            <ul class="report-meta-first-row">
                <li><span class="reportcode"><?php echo isset( $productid) ?  '<strong>Report Code:</strong> ' . 'CMI'.$productid : 'Report Code: ';  ?></span></li>
                <li><span class="reportcode"><?php echo isset( $publishDAte) ?  '<strong>Publish Date: </strong>' . $publishDAte : 'Publish Date: ';  ?></span></li>
            </ul>
            <ul class="report-meta-second-row">
                <li><span class="reportcode"><?php echo isset( $pagesReport) ?  '<strong>Pages:</strong> ' . $pagesReport : ' Pages: ';  ?></span></li>
                <li><span class="reportcode"><?php echo isset( $categoryname) ?  '<strong>Category:</strong> ' . $categoryname : 'Category: ';  ?></span></li>
            </ul>
        <?php
    }

    if( function_exists('acf_add_options_page') ) {

        // acf_add_options_page();


        acf_add_options_page(array(
            'page_title' 	=> 'Theme General Settings',
            'menu_title'	=> 'Theme Settings',
            'menu_slug' 	=> 'ij-theme-general-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));

    }
    function cptui_register_my_cpts_infographics() {

        /**
         * Post Type: Infographics.
         */

        $labels = [
            "name" => __( "Infographics", "custom-post-type-ui" ),
            "singular_name" => __( "infographic", "custom-post-type-ui" ),
            "archives" => __( "infographics", "custom-post-type-ui" ),
        ];

        $args = [
            "label" => __( "Infographics", "custom-post-type-ui" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => false,
            "rewrite" => [ "slug" => "infographics", "with_front" => true ],
            "query_var" => true,
            "menu_icon" => "dashicons-admin-generic",
            "supports" => [ "title", "editor", "thumbnail" ],
            "show_in_graphql" => false,
        ];

        register_post_type( "infographics", $args );
    }

    add_action( 'init', 'cptui_register_my_cpts_infographics' );


    function cptui_register_my_taxes() {

        /**
         * Taxonomy: Infographics.
         */

        $labels = [
            "name" => __( "Infographics", "custom-post-type-ui" ),
            "singular_name" => __( "Infographic", "custom-post-type-ui" ),
        ];


        $args = [
            "label" => __( "Infographics", "custom-post-type-ui" ),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => [ 'slug' => 'infographic', 'with_front' => true, ],
            "show_admin_column" => false,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "infographic",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "wp/v2",
            "show_in_quick_edit" => false,
            "sort" => false,
            "show_in_graphql" => false,
        ];
        register_taxonomy( "infographic", [ "infographics" ], $args );

        /**
         * Taxonomy: Infographics Category.
         */

        $labels = [
            "name" => __( "Infographics Category", "custom-post-type-ui" ),
            "singular_name" => __( "Infographic Category", "custom-post-type-ui" ),
        ];


        $args = [
            "label" => __( "Infographics Category", "custom-post-type-ui" ),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => [ 'slug' => 'info_category', 'with_front' => true, ],
            "show_admin_column" => false,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "info_category",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "wp/v2",
            "show_in_quick_edit" => false,
            "sort" => false,
            "show_in_graphql" => false,
        ];
        register_taxonomy( "info_category", [ "infographics" ], $args );
    }
    add_action( 'init', 'cptui_register_my_taxes' );

    function cptui_register_my_taxes_infographic() {

        /**
         * Taxonomy: Infographics.
         */

        $labels = [
            "name" => __( "Infographics", "custom-post-type-ui" ),
            "singular_name" => __( "Infographic", "custom-post-type-ui" ),
        ];


        $args = [
            "label" => __( "Infographics", "custom-post-type-ui" ),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => [ 'slug' => 'infographic', 'with_front' => true, ],
            "show_admin_column" => false,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "infographic",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "wp/v2",
            "show_in_quick_edit" => false,
            "sort" => false,
            "show_in_graphql" => false,
        ];
        register_taxonomy( "infographic", [ "infographics" ], $args );
    }
    add_action( 'init', 'cptui_register_my_taxes_infographic' );

    function cptui_register_my_taxes_info_category() {

        /**
         * Taxonomy: Infographics Category.
         */

        $labels = [
            "name" => __( "Infographics Category", "custom-post-type-ui" ),
            "singular_name" => __( "Infographic Category", "custom-post-type-ui" ),
        ];


        $args = [
            "label" => __( "Infographics Category", "custom-post-type-ui" ),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => false,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => [ 'slug' => 'info_category', 'with_front' => true, ],
            "show_admin_column" => false,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "info_category",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "wp/v2",
            "show_in_quick_edit" => false,
            "sort" => false,
            "show_in_graphql" => false,
        ];
        register_taxonomy( "info_category", [ "infographics" ], $args );
    }
    add_action( 'init', 'cptui_register_my_taxes_info_category' );



    /* Custom Query for press release */

    function searchfilter($query) {
        if ($query->is_search && !is_admin() ) {
            if(isset($_GET['post_type'])) {
                $type = $_GET['post_type'];
                    if($type == 'press-releases') {
                        $query->set('post_type',array('press-releases'));
                    }
            }       
        }
    return $query;
    }
    add_filter('pre_get_posts','searchfilter');



    add_filter( 'woocommerce_add_to_cart_validation', 'remove_cart_item_before_add_to_cart', 20, 3 );
    function remove_cart_item_before_add_to_cart( $passed, $product_id, $quantity ) {
        if( ! WC()->cart->is_empty() )
            WC()->cart->empty_cart();
        return $passed;
    }



    add_action('woocommerce_after_add_to_cart_button', 'add_check_box_to_product_page', 30 );
    function add_check_box_to_product_page(){ 
		    $reportid = get_the_ID();

		$reportScope = get_field('report_scope', $reportid);
	?>     
     <div style="margin-top:20px; position: absolute; right: -1000px;"> 

				<?php 
					if($reportScope == 'Regional'){ 
				?>
				
                <label class="vh"
                 for="extra_pack"> <?php _e( '2850', 'quadlayers' ); ?>
                <input type="radio" name="extra_pack" id="packone" value="2850" checked> 
                </label>	   
				
					<?php }

				
					else if($reportScope == 'Country'){ 
				?>
				
                <label class="vh"
                 for="extra_pack"> <?php _e( '2650', 'quadlayers' ); ?>
                <input type="radio" name="extra_pack" id="packone" value="2650" checked> 
                </label>	   
				 
				<?php } else {?>
					
                <label class="vh"
                 for="extra_pack"> <?php _e( '3490', 'quadlayers' ); ?>
                <input type="radio" name="extra_pack" id="packone" value="3490" checked> 
                </label>	   
					<?php } ?>
                <label class="vh"
                 for="extra_pack"> <?php _e( '4490', 'quadlayers' ); ?>
                <input type="radio" name="extra_pack" id="packtwo" value="4490"> 
                </label>
                <label class="vh" for="extra_pack"> <?php _e( '5490', 'quadlayers' ); ?>
                <input type="radio" name="extra_pack" id="packthree" value="5490"> 
                </label>
                <label class="vh" for="extra_pack"> <?php _e( '1950', 'quadlayers' ); ?>
                <input type="radio" name="extra_pack" id="packfour" value="1950"> 
                </label>
                <label class="vh" for="extra_pack"> <?php _e( '6200', 'quadlayers' ); ?>
                <input type="radio" name="extra_pack" id="packfive" value="6200"> 
                </label>

    </div>
         <?php
    }


    add_filter( 'woocommerce_add_cart_item_data', 'add_cart_item_data', 10, 3 );

    function add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
         // get product id & price
        $product = wc_get_product( $product_id );
        $price = $product->get_price();
        // extra pack checkbox

        //print_r($_POST);
        //die;
        if( ! empty( $_POST['extra_pack'] ) ) {

            $cart_item_data['new_price'] =   $_POST['extra_pack'] ;
        }else{
            $cart_item_data['new_price'] =   $price ;


        }
    return $cart_item_data;
    }





    add_action( 'woocommerce_before_calculate_totals', 'before_calculate_totals', 10, 1 );

    function before_calculate_totals( $cart_obj ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
    return;
    }
                // Iterate through each cart item
                foreach( $cart_obj->get_cart() as $key=>$value ) {
                    if( isset( $value['new_price'] ) ) {
                        $price = $value['new_price'];
                        $value['data']->set_price( ( $price ) );
                    }
                }
    }


    //add_action( 'woocommerce_review_order_before_order_total', 'update_item_price_checkout' );
    //add_action( 'woocommerce_before_cart_totals', 'update_item_price_checkout' );
    //add_filter( 'woocommerce_order_amount_total', 'update_item_price_checkout' );


     //add_filter('woocommerce_checkout_create_order', 'update_item_price_checkout', 10 , 1);

    //add_action( 'woocommerce_before_calculate_totals', 'update_item_price_checkout', 99 );

    function update_item_price_checkout($cart_object){




         $additionalPrice = 5;
            foreach ( $cart_object->cart_contents as $key => $value ) {
                if( isset( $value["embossing_fee"] ) ) {
                    // Turn $value['data']->price in to $value['data']->get_price()
                    $orgPrice = floatval( $value['data']->get_price() );
                    $discPrice = $orgPrice + $additionalPrice;
                    $value['data']->set_price($discPrice);
                }
            }

    //print_r($cartObj);

    //die("ddd");

        //if ( !is_admin()  && is_checkout() )
          //      return;

    /*
        global $woocommerce;
        $itemprice_checkout = 22222; // $_SESSION["itemprice_checkout"];

        //die($itemprice_checkout);
        $cartObj = $woocommerce->cart;




    foreach( $cartObj as $key=>$value ) {
            if( isset( $value['new_price'] ) ) {
                 $value['new_price'] = $itemprice_checkout;
                $value['data']->set_price( ( $itemprice_checkout ) );
            }
    }

        $cartObjt->total = $itemprice_checkout;

          WC()->session->set( 'total', WC()->cart->total );

        $response = array(
            'price_html'        => wc_price( WC()->cart->total ),
            'price_remaining'   => WC()->cart->total,
        );

        header( 'Content-Type: application/json' );
        echo json_encode( $response );
        */

    }

    //add_action( 'woocommerce_review_order_before_order_total', 'custom_cart_total' );

    add_action( 'wp_ajax_nopriv_custom_cart_total', 'custom_cart_total' );
    add_action( 'wp_ajax_custom_cart_total', 'custom_cart_total' );
    function custom_cart_total(  ) {



    if ( is_admin() && ! defined( 'DOING_AJAX' ) && !is_checkout() )
                return;


        $price = $_POST['itemprice'];

        $price_checkout =  $_SESSION["itemprice_checkout"] = $price;


      //  WC()->cart->total = $price_checkout;

        //var_dump( WC()->cart->total);

        echo $price_checkout;  



    die;

    }




    /*
    add_action('woocommerce_thankyou' , 'thank_you_page', );

    function thank_you_page(){

        global $wp;

        if( isset($wp->query_vars['order-received']) ){

            $order_id = absint($wp->query_vars['order-received']);
            $order = wc_get_order($order_id);

        }

            // Allow code execution only once 

            if( ! get_post_meta( $order_id, '_thankyou_action_done', true ) ) {

            // Get an instance of the WC_Order object
            $order = wc_get_order( $order_id );

            // Get the order key
            $order_key = $order->get_order_key();

            // Get the order number
            $order_number = $order->get_order_number();

            echo "<pre>";
            print_r($order->get_items());
            echo "</pre>";


                // Loop through order items
            foreach ( $order->get_items()  as $item_id => $item) {



                        $subtotal = $item->get_subtotal();
                        $total = $item->get_total();


                    //$item['data']->subtotal = $_SESSION["itemprice_checkout"];
                //	$item['data']->total = $_SESSION["itemprice_checkout"];
            }



                    echo '<p>Order ID: '. $order_id .'  Sub Total  '. $subtotal . ' Total '. $total . ' — Order Status: ' . $order->get_status() . '  Total in session ' . $_SESSION["itemprice_checkout"] .  '</p>';

                    // Flag the action as done (to avoid repetitions on reload for example)
            $order->update_meta_data( '_thankyou_action_done', true );
            $order->save();
            }

    }
    */


    /*
    add_action('woocommerce_before_checkout_form', 'displays_cart_products_feature_image');
    function displays_cart_products_feature_image() {
        foreach ( WC()->cart->get_cart() as $cart_item ) {
            $product = $cart_item['data'];
            if(!empty($product)){
                // $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );
                echo $product->get_image();

                // to display only the first product image uncomment the line below
                // break;
            }
        }
    }
    */
    function get_order_id(){


        global $wp;

        if( isset($wp->query_vars['order-received']) ){

            $order_id = absint($wp->query_vars['order-received']);
            $order = wc_get_order($order_id);

        }

        return $order;

    }

    /*
    add_filter( 'woocommerce_get_checkout_url', 'custom_checkout_url', 30 );
    function custom_checkout_url( $checkout_url ) {


        $home_url = home_url(); // <= custom URL

        $cart_items = WC()->cart->get_cart();

        if ( sizeof($cart_items) > 0 ) {
            foreach ( $cart_items as $cart_item ) {
                if(  $cart_item['product_id'] ){
                     return $home_url.'/checkout/?reportid='.$cart_item['product_id'] ;
                }
            }
        }
        return $checkout_url;
    }*/


    // get product except by post id

    function ij_get_the_excerpt($post_id) {
      global $post;  
      $save_post = $post;
      $post = get_post($post_id);
      $output = get_the_excerpt();
      $post = $save_post;
      return $output;
    }



    // get and send download form data to crm

    function get_and_send_download_form_to_crm(){

        global $product;

        print_r($_POST);

        $servername = "sql759.main-hosting.eu";
        $database = "u980253665_cmi";
        $username = "u980253665_cmi";
        $password = "7@nyb2AKyQQeRetodBJgIGE2";


        $fname = isset( $_POST['fname']   ) ? $_POST['fname'] : '0';
        $bEmail = isset( $_POST['bEmail']   ) ? $_POST['bEmail'] : '0';
        $phone = isset( $_POST['phone']   ) ? $_POST['phone'] : '0';
        $cName = isset( $_POST['cName']   ) ? $_POST['cName'] : '0';
        $titleDesign = isset( $_POST['titleDesign']   ) ? $_POST['titleDesign'] : '0';
        $country = isset( $_POST['country']   ) ? $_POST['country'] : '0';
        $intention = isset( $_POST['intention']   ) ? $_POST['intention'] : '0';
        $message = isset( $_POST['message']   ) ? $_POST['message'] : '0';
        $reportid = isset( $_POST['reportid']   ) ? $_POST['reportid'] : '0'; 
        $reportExcept = isset( $_POST['reportExcept']   ) ? $_POST['reportExcept'] : '0'; 


        $conn = mysqli_connect($servername, $username, $password, $database); 

        if (!$conn) {
          echo("Connection failed: " . mysqli_connect_ersror());
        }


        $currentDate = date("Y-m-d");
        $currentTime = date("h:i:s A");


        $product = wc_get_product($reportid);
        $reportTitle = $reportExcept;	
        ij_get_product_title_id($reportid);

        $reporturl = get_permalink( $product->get_id() );




         $sql = "INSERT INTO `lead_table` ( `selectregion`, `country`, `category`, `publisher`, `team_name`, `enquirytype`, `source`, `creationdate`, `creation_time`, `reportid`, `reporttitle`, `clientname`, `email`, `contactno`, `company`, `designation`, `message`,  `status`, `urllink`, `flag`, `access_area`, `zeal_limit_id`, `callstatus`) 
         VALUES (   'APAC', '$country', 'C1', 'CMI', 'CMI', '$intention', 'CMI-download', '$currentDate' , '$currentTime' , '$reportid' , '$reportTitle' , '$fname' , '$bEmail' , '$phone' , '$cName' , '$titleDesign' , '$message' ,  'In-Progress', '$reporturl' , '0', 'All', '18', '0')";


        if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
        } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);





        die();

    }

    add_action('wp_ajax_get_and_send_download_form_to_crm', 'get_and_send_download_form_to_crm');
    add_action('wp_ajax_nopriv_get_and_send_download_form_to_crm', 'get_and_send_download_form_to_crm');




    // get and send customization request form data to crm

    function get_and_send_customization_form_to_crm(){

        global $product;

        print_r($_POST);

        $servername = "sql759.main-hosting.eu";
        $database = "u980253665_cmi";
        $username = "u980253665_cmi";
        $password = "7@nyb2AKyQQeRetodBJgIGE2";


        $fname = isset( $_POST['fname']   ) ? $_POST['fname'] : '0';
        $bEmail = isset( $_POST['bEmail']   ) ? $_POST['bEmail'] : '0';
        $phone = isset( $_POST['phone']   ) ? $_POST['phone'] : '0';
        $cName = isset( $_POST['cName']   ) ? $_POST['cName'] : '0';
        $titleDesign = isset( $_POST['titleDesign']   ) ? $_POST['titleDesign'] : '0';
        $country = isset( $_POST['country']   ) ? $_POST['country'] : '0';
        $intention = isset( $_POST['intention']   ) ? $_POST['intention'] : '0';
        $message = isset( $_POST['message']   ) ? $_POST['message'] : '0';
        $reportid = isset( $_POST['reportid']   ) ? $_POST['reportid'] : '0'; 
        $reportExcept = isset( $_POST['reportExcept']   ) ? $_POST['reportExcept'] : '0'; 


        $conn = mysqli_connect($servername, $username, $password, $database); 

        if (!$conn) {
          echo("Connection failed: " . mysqli_connect_ersror());
        }


        $currentDate = date("Y-m-d");
        $currentTime = date("h:i:s A");


        $product = wc_get_product($reportid);
        $reportTitle = $reportExcept;	
        ij_get_product_title_id($reportid);

        $reporturl = get_permalink( $product->get_id() );




         $sql = "INSERT INTO `lead_table` ( `selectregion`, `country`, `category`, `publisher`, `team_name`, `enquirytype`, `source`, `creationdate`, `creation_time`, `reportid`, `reporttitle`, `clientname`, `email`, `contactno`, `company`, `designation`, `message`,  `status`, `urllink`, `flag`, `access_area`, `zeal_limit_id`, `callstatus`) 
         VALUES (   'APAC', '$country', 'C1', 'CMI', 'CMI', '$intention', 'CMI-customization', '$currentDate' , '$currentTime' , '$reportid' , '$reportTitle' , '$fname' , '$bEmail' , '$phone' , '$cName' , '$titleDesign' , '$message' ,  'In-Progress', '$reporturl' , '0', 'All', '18', '0')";


        if (mysqli_query($conn, $sql)) {
              echo "New record created successfully";
        } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);





        die();

    }

    add_action('wp_ajax_get_and_send_customization_form_to_crm', 'get_and_send_customization_form_to_crm');
    add_action('wp_ajax_nopriv_get_and_send_customization_form_to_crm', 'get_and_send_customization_form_to_crm');


    function update_report_meta_on_download_report_sample($reportid){


        $reportid = $reportid!='123a'? $reportid: '';
        if( $reportid !='' ){
            $reportTitle =  get_the_title($reportid);
            $reportLink =  get_the_permalink($reportid);

            $reportmeta =  "Report ID :".$reportid." Report Title ".$reportTitle." Report Link ".$reportLink;

            echo '<p class="reportmeta_ij" style="display:none;">'.$reportmeta.'</p>';
        }
    }


    // function that runs when shortcode is called
    function ij_cagr_stats($atts) { 

    $params = array(
             
            'reportid' => '0'

    );

    $researchyears = shortcode_atts( $params , $atts );

    //print_r($researchyears);
    $reportid = isset( $researchyears['reportid'] ) ? $researchyears['reportid'] : '020'; 
	
	$researchy = get_field('research_base_year' , $reportid);
	$studyperiod = get_field('study_period' , $reportid);
	$cagr = get_field('cagr' , $reportid);
	$first_bar_year = get_field('first_bar_year' , $reportid);
	$firstbarheight = get_field('first_bar_height' , $reportid);
	$firstbarfigurelabel = get_field('first_bar_figure' , $reportid);
	$second_bar_year = get_field('second_bar_year' , $reportid);
	$secondbarheight = get_field('second_bar_height' , $reportid);
	$secondbarfigurelabel = get_field('second_bar_figure' , $reportid);
	$thirdyear = get_field('third_bar_year' , $reportid);
	$thirdbarheight = get_field('third_bar_height' , $reportid);
	$thirdbarfigurelabel = get_field('third_bar_figure' , $reportid);
	$source_text = get_field('source_text' , $reportid);   
	$fast_growing_market = get_field('fastest_growing_market' , $reportid);   
	$study_period = get_field('study_period' , $reportid);   
	$lagest_market = get_field('largest_market' , $reportid);   
	$keyplayer = get_field('key_player' , $reportid);   
	$companyName = get_field('company_name' , $reportid);   
	$major_players_name = get_field('major_players_name' , $reportid); 
	
	$left_section_image = get_field('left_section_image', 'option'); 
	$right_section_top_image = get_field('right_section_top_image', 'option'); 
	$right_section_text = get_field('right_section_text', 'option');  

        $str = "<div class='row card-graphs'  style='margin: 40px 0;'>
        <div class='col-sm-12' style='margin: 10px 0; padding: 0px;'>
    <p><strong>Report Snapshot</strong></p>
    </div>
        <div class='col-lg-8'>
            <div class='card graph_card'> <span class='rnd_sale' id='rnd_sale'><span class='blink_me' style='font-size:20px;font-weight:600'>CAGR: $cagr% </span></span>
                <div class='card-body' style='border-radius: 10px;/* box-shadow: 0px 0px 10px 1px rgb(220 220 220); *//* border: 1px solid rgba(220, 220, 220, 1); */'>
                    <div class='row' style='padding-bottom:10px;     align-items: start;'>
                        <div class='col-md-5 bar-graph-box' id='bar-graph' style='text-align: center; display: block; border-right: 1px solid #00ced1; padding: 0 20px 0 0;'>
                            <div class='barcontainer'>
                                <div class='barcontainerheader market-snapshot'> </div>
                                <div class='bar' style='height:$firstbarheight%;min-height:30%;max-height: 70%; left:0%;'>
                                    <span class='bar-figure-lable'>$firstbarfigurelabel</span>
                                    <div class='barlabel'> $researchy </div>
                                </div>
                                <div class='bar' style='height:$secondbarheight%;background: #dc7a35; left:35%; '>
                                    <span class='bar-figure-lable'>$secondbarfigurelabel</span>
                                    <div class='barlabel'> $second_bar_year </div>
                                </div>
                                <div class='bar' style='height:$thirdbarheight%;background: #f04c23; left:70%;'>
                                    <span class='bar-figure-lable'>$thirdbarfigurelabel</span>
                                    <div class='barlabel'>$thirdyear </div>
                                </div>
                            </div>
                            <div class='reportsnamechart'>
                                <div class='col-9'>
                                    <p style='font-size:8px !important;'>Source: CMI</p>
                                </div>

                            </div>
                        </div>
                        <div class='col-md-7'>
                             <table class='graph_table'>
                                <tbody>
								
									<tr>
                                        <td>Study Period:</td>
                                        <td> $study_period </td>
                                    </tr> 	
                                    <tr>
                                        <td>Fastest Growing Market:</td>
                                        <td> $fast_growing_market </td>
                                    </tr> 
									<tr>
                                        <td>Largest Market:</td>
                                        <td> $lagest_market </td>
                                    </tr> 
                                    
                                </tbody>
                            </table>
							
							<div>
							
							<p style='margin: 20px 0 0 0; '><b> Major Players </b></p>
							
							<div style='margin: 0 0 20px 0; font-size: 0.7rem;'>
							$major_players_name
							</div>
							
							</div> 
								
						</div>
						
					</div>
                </div>
            </div>
        </div>
        <div class='col-lg-4 d-flex'>
            <div class='flex submit-customize-form-section'> 
			<!-- <img class='chartimage' src='$right_section_top_image' alt='Carotenoids Market-Snapshot' loading='lazy' width='150px' height='150px'> -->
					<p style='color:#fff;'>$companyName</p>
                <h3>$right_section_text</h3> <a href='https://www.custommarketinsights.com/request-for-free-sample/?reportid=$reportid' target='blank' id='market-snapshot-customize-report' data-target='#customizeFrommodal' class='cta cta--download' aria-label='Download Sample Pdf'>Download Sample Pdf</a>
                <br> </div>
        </div>
    </div>";


    // Output needs to be return
    return $str;
    }
    // register shortcode
    add_shortcode('cagr-ij', 'ij_cagr_stats');



    function ij_scripts_attachment()
    {
        
        wp_register_script( 'ij_charts_lib', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js' );
       // wp_register_script( 'ij_charts_lib', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js', '', '', true);
       // wp_register_script( 'ij_charts_lib', get_stylesheet_directory_uri().'/js/chartjs_2_9_4.js' );
        // wp_register_script( 'ij_charts_lib', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.0/chart.min.js' );
         
        wp_enqueue_script( 'ij_charts_lib' );
    }
    add_action( 'wp_enqueue_scripts', 'ij_scripts_attachment' );

function ij_bar_charts($atts){
    
     $params = array(
             
            'reportid' => '0'

    );

    $researchyears = shortcode_atts( $params , $atts );

    
    $reportid = isset( $researchyears['reportid'] ) ? $researchyears['reportid'] : '020'; 
	$bar_charts_heading = get_field('bar_charts_heading' , $reportid);
	$bar_charts_bottom_legends = get_field('bar_charts_bottom_legends' , $reportid);
    
	$bar_charts_rows = get_field('bar_charts_meta_datasets' , $reportid);

	$image_path_link_for_right_box = get_field('image_path_link_for_right_box' , $reportid);
	$image_path_link_for_right_box = isset($image_path_link_for_right_box) ? $image_path_link_for_right_box: 'https://www.custommarketinsights.com/wp-content/uploads/2022/07/Custom-Market-Insights.png';

	$right_box_width = get_field('barchart_right_box_width' , $reportid);
	$right_box_width = isset ($right_box_width) ? $right_box_width : '4';
	$left_box_width = get_field('barchart_left_box_width' , $reportid);
	$left_box_width = isset ($left_box_width) ? $left_box_width : '8';
   /* echo '<pre>';
    print_r($bar_charts_rows);
    echo '</pre>';
*/
    	$str =	"
        <div class='container bar-charts-container'>
        <div class='row'>
            <div class='col-sm-12'>	
                <canvas id='myChart'> </canvas>
				<div class='row chart-utils' style='margin: 20px 0 0 0;'>
					<a target='blank'  onclick=downloadBlueChartPDF(classname='myChart'); class='print'><i class=' fa fa-print' style='color: #27ae60;'></i></a>
			 </div>
            </div>
          
            </div>
        </div>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');

	var chart = new Chart(ctx, {
	    // The type of chart we want to create
	    type: 'bar',

	    // The data for our dataset
	    data: {
	        labels:  [$bar_charts_bottom_legends],
					datasets: [";
						
					foreach( $bar_charts_rows as $row){

                        $str .=" { \r\n";
                        $str .="label: '". $row['bar_chart_label'] ."', \r\n";
                        $str .="data: [".$row['bar_chart_data']."], \r\n";
                        $str .="backgroundColor: '". $row['bar_chart_background_color']."', \r\n";
                        $str .="borderColor: '" .$row['bar_charts_border_color']."', \r\n" ;
                        $str .="type: 'bar',\r\n";
                        $str .="order:" .$row['bar_charts_order']."\r\n";
                        $str .=" },\r\n";
                     }
				$str .="]
	    },

	    // Configuration options go here
	    options: {
					title:{
						display:true,
						text:'$bar_charts_heading',
						fontSize:15,
						fontFamily: 'poppins',
						fontWeight: 400
					},
					subtitle: {
						display: true,
						text: 'Custom Chart Subtitle'
					},
					tooltips:{
						enabled:false
					},
					scales: {
						xAxes: [{
							gridLines: {
								display:false
							},
							stacked: true,
							categoryPercentage: 0.55,
							barPercentage: 1.0,
						}],
						yAxes: [{
							
							gridLines: {
								display:false
							},
							stacked: true ,
							ticks : {
								display: false
							}
						}]
					},
			legend: {
				display: true,
				position: 'top',
            labels: {
                fontColor: '#333',
            }
        }
	    }

 


	});
    </script>";
    
return $str;
}
 add_shortcode('ij_bar_charts' ,'ij_bar_charts');
 
 function ij_back_report_btn(){
	 
	 
	 $reportid = $_REQUEST['reportid'];
	  $reporturl = isset($reportid) ? get_permalink($reportid) :'';
	 
	 $str = "<a href='$reporturl' class='reportbtnback'><i class='fa-solid fa-arrow-left'></i> Back to report</a>";
	 return $str;
 } 
 add_shortcode('ij-back-report' ,'ij_back_report_btn');
 
 
 
 
 
 
function ij_bar_single_charts($atts){
    
     $params = array(
             
            'reportid' => '0'

    );

    $researchyears = shortcode_atts( $params , $atts );

    
		$reportid = isset( $researchyears['reportid'] ) ? $researchyears['reportid'] : '020'; 
		$single_bar_charts_bottom_legends = get_field('single_bar_charts_bottom_legends' , $reportid);
		$single_bar_chart_data = get_field('single_bar_chart_data' , $reportid);
		$single_bar_chart_report_title = get_field('single_bar_chart_report_title' , $reportid);
	
	$single_bar_chart_currency_denomination = get_field('single_bar_chart_currency_denomination' , $reportid);
	
	
    	$str =	"
		
		<style>
		.print-chart:hover {
			color: #f04c23;
			transition: all .3s;
			}
		.print-chart {
    background: #f04c23;
    padding: 10px 10px;
    padding-inline: 35px;
    margin: 15px 0 0 0;
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 500;
	color: #fff !important;
	 cursor: pointer;
	 border: 1px solid #f04c23;
}
.chart-utils > *{
	cursor: pointer;
}
		</style>
			<div class='chartHeading'>
				
			</div>
        <div class='container bar-charts-container'>
        <div class='row'>
		<div class='reportTitle'>
			<p> $single_bar_chart_report_title </p>
		</div>
            <div class='col-sm-12'>	
                <canvas id='singleCatBarChart'> </canvas>
                <div class='text-center'>www.custommarketinsight.com</div>
				
		<div class='row chart-utils' style='margin: 20px 0 0 0;'>
					<a target='blank'  onclick=downloadBlueChartPDF(classname='singleCatBarChart'); class='print'><i class=' fa fa-print' style='color: #27ae60;'></i></a>
			 </div>

            </div>
          
            </div>
        </div>
    <script>
   
   
   

var ctx = document.getElementById('singleCatBarChart');


	 

// debugger;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [$single_bar_charts_bottom_legends],
        datasets: [{ 
            data: [ $single_bar_chart_data ],
            backgroundColor: '#4082c4'
        }]
    },
    options: {
    		'hover': {
        	'animationDuration': 0
        } ,
		 	
        'animation': {
        	'duration': 1,
						'onComplete': function () {
							var chartInstance = this.chart,
								ctx = chartInstance.ctx;
							
							ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
							ctx.textAlign = 'center';
							ctx.textBaseline = 'bottom';

							this.data.datasets.forEach(function (dataset, i) {
                               // console.log(dataset)
								var meta = chartInstance.controller.getDatasetMeta(i);
								//console.log(meta)
								meta.data.forEach(function (bar, index) {
									let lastindex = meta.data.length-1
									if( index == 0 || index == 1 || index == lastindex ){
                                        var data = dataset.data[index]+' $single_bar_chart_currency_denomination';                            
                                    } else {  
                                        var data = '';
                                    }
									// var data = dataset.data[index];                            
									ctx.fillText(data, bar._model.x, bar._model.y - 5);
								});
							});
						}
        },
    		legend: {
        	'display': false
        },
        tooltips: {
        	'enabled': false
         },
        scales: {
            yAxes: [{
            		display: false,
            		gridLines: {
                	display : false
                },
                ticks: {
                        display: false,
                        beginAtZero:true
                }
            }],
            xAxes: [{
            		gridLines: {
                	display : false
                },
                ticks: {
                    beginAtZero:true
                } ,
				barPercentage: 0.8
            }]
        } 
		
    } 
	/*,
	plugins: [bgColor]
	*/
});
    </script>";
    if( $single_bar_chart_data ){
		return $str;
	}
}
 add_shortcode('ij_bar_single_charts' ,'ij_bar_single_charts');



 
function ij_pie_charts($atts){
    
    $params = array(
            
           'reportid' => '0'

   );

   $researchyears = shortcode_atts( $params , $atts );

   
       $reportid = isset( $researchyears['reportid'] ) ? $researchyears['reportid'] : '020'; 
       $pie_chart_heading = get_field('pie_chart_heading' , $reportid);
       $pie_chart_years = get_field('pie_chart_years' , $reportid);
       $pie_chart_data = get_field('pie_chart_data' , $reportid); 
       $pie_chart_colors = get_field('pie_chart_colors' , $reportid); 

    
   
       $str =	"
           <div class='chartHeading'>
               
           </div>
       <div class='container bar-charts-container'>
       <div class='row'>
       <div class='reportTitle'>
        <p>$pie_chart_heading</p>
       </div>
           <div class='col-sm-12'>	
               <canvas id='piechart'> </canvas>
               <div class='text-center'>www.custommarketinsight.com</div>
			   <div class='row chart-utils' style='margin: 20px 0 0 0;'>
					<a target='blank'  onclick=downloadBlueChartPDF(classname='piechart'); class='print'><i class=' fa fa-print' style='color: #27ae60;'></i></a>
			 </div>
			  
           </div>
         
           </div>
       </div>
   <script>
  
var ctx = document.getElementById('piechart');


var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        
        labels:  [$pie_chart_years],
        datasets: [{ 
            data:  [$pie_chart_data],
            backgroundColor: [ $pie_chart_colors ]
        }, 
    ]
    },
   
    options: {
			 
        legend: {
            display: true,
            position: 'right',
            labels: {
                fontSize: 15,
                fontFamily: 'poppins'
            }
        }, 
            tooltips:{
                enabled:false
            }, 
         
        responsive: true,
        layout: {
            padding: 20
        },
},

    

});
 
   </script>";
   if( $reportid ){
       return $str;
   }
}
add_shortcode('ij_pie_charts' ,'ij_pie_charts');



function ij_dough_charts($atts){
    
    $params = array(
            
           'reportid' => '0'

   );

   $researchyears = shortcode_atts( $params , $atts );

   
       $reportid = isset( $researchyears['reportid'] ) ? $researchyears['reportid'] : '020'; 
       $doughnut_chart_heading = get_field('doughnut_chart_heading' , $reportid);
       $doughnut_chart_years = get_field('doughnut_chart_years' , $reportid);
       $doughnut_chart_data = get_field('doughnut_chart_data' , $reportid); 
       $doughnut_chart_colors = get_field('doughnut_chart_colors' , $reportid); 

    
   
       $str =	"
           <div class='chartHeading'>
               
           </div>
       <div class='container bar-charts-container'>
       <div class='row'>
       <div class='reportTitle'>
        <p>$doughnut_chart_heading</p>
       </div>
           <div class='col-sm-12'>	
               <canvas id='doughChart'> </canvas>
               <div class='text-center'>www.custommarketinsight.com</div>
			   <div class='row chart-utils' style='margin: 20px 0 0 0;'>
					<a target='blank'  onclick=downloadBlueChartPDF(classname='doughChart'); class='print'><i class=' fa fa-print' style='color: #27ae60;'></i></a>
			 </div>
           </div>
         
           </div>
       </div>
   <script>
  
var ctx = document.getElementById('doughChart');


var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'doughnut',

    // The data for our dataset
    data: {
        
        labels:  [$doughnut_chart_years],
        datasets: [{ 
            data:  [$doughnut_chart_data],
            backgroundColor: [ $doughnut_chart_colors ]
        }, 
    ]
    },
   
    options: {
			 
        legend: {
            display: true,
            position: 'right',
            labels: {
                fontSize: 14,
                fontFamily: 'Roboto'
            }
        }, 
            tooltips:{
                enabled:false
            }, 
         
        responsive: true,
        layout: {
            padding: 20
        },
},

    

});
 
   </script>";
   if( $reportid ){
       return $str;
   }
}
add_shortcode('ij_dough_charts' ,'ij_dough_charts'); 

/*
 * Whitelist email domains from your WPForms.
 *
 * @link https://wpforms.com/developers/how-to-restrict-email-domains/
 *
*/
 
function wpf_blacklist_domains( $field_id, $field_submit, $form_data ) {
    
    //die($form_data['id']);
    //$field_id = 3;
    //$form_data['id'] = 17583;
    
    $domain          = substr( strrchr( $field_submit, "@" ), 1 );
    $blacklist       = array( 'yahoo.com', 'hotmail.com' , 'gmail.com' );
 
    if( in_array( $domain, $blacklist ) ) { 
        wpforms()->process->errors[ $form_data['id'] ][ $field_id ] = esc_html__( 'We apologize for any inconvenience, we are unable to accept emails from this domain.', 'wpforms' );
 
        return;
    }
 
}
 
add_action('wpforms_process_validate_email', 'wpf_blacklist_domains', 10, 3 );


function ij_pr_post_meta(){

    $str = '<div class="text-center"> 
    <p> <strong>Released Date:</strong> '.get_the_date().' |  <strong>Author Name:</strong> '.get_the_author().' | <strong>Location:</strong> Sandy, USA</p> 
</div>';
    return $str;
}
add_shortcode('ij_pr_post_meta' ,'ij_pr_post_meta');






    // function to add buy report on PR
    function ij_pr_buy_report_btn($atts) { 

    $params = array(
             
            'reportid' => '0'

    );

    $researchyears = shortcode_atts( $params , $atts );

    //print_r($researchyears);
    $reportid = isset( $researchyears['reportid'] ) ? $researchyears['reportid'] : ''; 
	
	 $str = '<a href="https://www.custommarketinsights.com/report/" class="buythisreport">Buy Now</a>';
    return $str;
    }
    // register shortcode
    add_shortcode('ij_pr_buy_report_btn', 'ij_pr_buy_report_btn');
    
    
    
    function get_category_name_by_post_id (){
		
		$postType='';
		if($_POST['postid']){ 
			 $category = get_the_category($_POST['postid']); 
			 
			foreach($category as $cd){
				$catName=  $cd->cat_name;
			}
			$post = get_post( $_POST['postid'] );
			if ( $post ) {
			$postType = $post->post_type;
			}
			echo $catName.'^'.$postType;
		die();
		}
	}
	
	add_action('wp_ajax_get_category_name_by_post_id', 'get_category_name_by_post_id');
	add_action('wp_ajax_nopriv_get_category_name_by_post_id', 'get_category_name_by_post_id');


    
    function ij_press_releases_cta_btns(){
        
        if ( is_singular( 'press-releases' ) ) {
        
        ?>
        
        <script>
            jQuery( document ).ready(function() {
                
                
                jQuery('.buythisreport').click( function(){
                    
                    
                    let btnname = jQuery(this).data('prreport');
                    console.log(btnname);
                    let reportid = jQuery('#pr_reportid').data('reportid');
                    let reporturl = jQuery('#pr_reportid').data('reporturl');
                     
                    if( btnname === 'readreport'){
                        
                        window.open(reporturl , '_blank');

                    } else  if( btnname === 'request-customization'){
                        
                        window.open( 'https://www.custommarketinsights.com/request-for-customization/?reportid='+reportid , '_blank');

                    } else  if( btnname === 'requestsample'){
                        
                        window.open('https://www.custommarketinsights.com/request-for-free-sample/?reportid='+reportid , '_blank');

                    }
                    
                })
                
                /*
            const myTimeout = setTimeout(updateBtns, 5000);
            console.log('Hello');
            
                function updateBtns(){
            
                    let ctabtns = document.querySelectorAll('.buythisreport');
                    let reportid = jQuery('#pr_reportid').data('reportid');
                    console.log(reportid);
                    
                    
                    
                          for (i = 0; i < ctabtns.length; i++) {
                          
                        
                               
                                 ctabtns[0].href='https://www.custommarketinsights.com/';
                                 ctabtns[1].href='https://www.custommarketinsights.com/inquire-for-discount/?reportid='+reportid;
                                 ctabtns[2].href='https://www.custommarketinsights.com/request-for-free-sample/?reportid='+reportid;
                        
                              
                          }
                }
              clearTimeout(myTimeout);
*/
            });    
        </script>
        
        <?php
        }
    }
    
    add_action( 'wp_footer', 'ij_press_releases_cta_btns', 1);
    
    
    
    function breakText($text, $minLength = 200, $needle='.') {
              $delimiter = preg_quote($needle);
              $match = preg_match_all("/.*?$delimiter/",$text, $matches);
            
              if ($match == 0)
               return array($text);
            
              $sentences = current($matches);
              $paras = array();
              $tmp = '';
            
              foreach ($sentences as $sentence) {
               $tmp .= $sentence;
               if (strlen($tmp) > $minLength){
                $paras[] = $tmp;
                $tmp = '';
               }
              }
            
              if ($tmp != '')
               $paras[] = $tmp;
              return $paras;
 }
	

// Remove feed URLs from the header
function disable_feed_links() {
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
}
add_action('init', 'disable_feed_links');
// Redirect feed requests to the original page
function redirect_feed_requests_to_original_page($query) {
if ($query->is_feed) {
global $wp;
$current_url = home_url(add_query_arg(array(), $wp->request));
$original_url = preg_replace('/\/feed(\/.*|$)/', '', $current_url);
wp_redirect($original_url, 301);
exit;
}
}
add_action('parse_query', 'redirect_feed_requests_to_original_page');


function defer_parsing_of_js ( $url ) {
if ( FALSE === strpos( $url, '.js' ) ) return $url;
if ( strpos( $url, '.min.js' ) ) return $url;
return "$url' defer ";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );





//20-09-2023 Imran   update prices



// Simple, grouped and external products
/*
add_filter('woocommerce_product_get_price', 'custom_price', 99, 2 );
add_filter('woocommerce_product_get_regular_price', 'custom_price', 99, 2 );
// Variations
//add_filter('woocommerce_product_variation_get_regular_price', 'custom_price', 99, 2 );
//add_filter('woocommerce_product_variation_get_price', 'custom_price', 99, 2 );
function custom_price( $price, $product ) {
    return '3490.00' ;
}
*/
/*

add_filter('woocommerce_get_regular_price', array( $this, 'ij_report_new_price'), 99);
add_filter('woocommerce_get_price', array( $this, 'ij_report_new_price'), 99);

function ij_report_new_price( $original_price ) {
  global $post, $woocommerce;

  //Logic for calculating the new price here
  $new_price = '3490';

  //Return the new price (this is the price that will be used everywhere in the store)
  return $new_price;
 }*/


function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) 
        return true;
    return false;
}


//Disable theme updates

add_filter( 'site_transient_update_themes', 'remove_update_themes' );
function remove_update_themes( $value ) {

    // Set your theme slug accordingly:
    $themeslug = 'porto';

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ $themeslug ] );
    }

    return $value;
}
