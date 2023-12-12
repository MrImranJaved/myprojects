<?php

function enqueue_parent_theme_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	if ( is_rtl() ) {
		wp_enqueue_style( 'parent-rtl', get_template_directory_uri() . '/rtl.css', array(), RH_MAIN_THEME_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );

function custom_admin_style() {
	wp_enqueue_style( 'custom-admin-style', get_stylesheet_directory_uri() . '/styles/admin-styles.css' );
}
add_action( 'admin_enqueue_scripts', 'custom_admin_style' );

// Remove SKU, price and Stock column from WooCommerce Product Table
function custom_remove_sku_column( $columns ) {
	unset( $columns['sku'] );
	unset( $columns['price'] );
	unset( $columns['is_in_stock'] );

	return $columns;
}
add_filter( 'manage_edit-product_columns', 'custom_remove_sku_column' );

function remove_stock_status_filter( $filters ) {
	unset( $filters['stock_status'] );

	return $filters;
}

add_filter( 'woocommerce_products_admin_list_table_filters', 'remove_stock_status_filter' );

function change_additional_information_heading( $heading ): string {
	return esc_html__( 'Features', 'finance-compare' );  // Changed "Specification" to "Features".
}
add_filter( 'woocommerce_product_additional_information_heading', 'change_additional_information_heading' );

function format_currency( $amount, $currency ): bool|string {
	$amount = floatval( strip_tags( $amount ) ); // Convert to float after stripping tags

	$locale = get_locale();
	$fmt    = new NumberFormatter( $locale . '@currency=' . $currency, NumberFormatter::CURRENCY );

	return $fmt->formatCurrency( $amount, $currency );
}


function format_percentage( $amount ): bool|string {
	$field_value = floatval( strip_tags( $amount ) );
	$field_value = $field_value / 100;  // convert to decimal
	$fmt         = new NumberFormatter( get_locale(), NumberFormatter::PERCENT );
	$fmt->setAttribute( NumberFormatter::FRACTION_DIGITS, 1 ); // Display one decimal digit

	return $fmt->format( $field_value );
}

function customize_woocommerce_attribute_display( $value, $attribute, $values ) {
	// You can now modify $value based on the $attribute and $values.
	// For example, for the APY attribute:
	if ( 'pa_apy' === $attribute->get_name() ) {
		$value = format_percentage( $values[0] );  // Assuming $values is an array with the APY value as the first element.
	} elseif ( in_array(
		$attribute->get_name(),
		array(
			'pa_teller-fee',
			'pa_minimum-opening-balance',
			'pa_minimum-balance-service-fee',
			'pa_annual-fee',
			'pa_additional-card',
			'pa_late-payment-fee',
			'pa_over-limit-fee',
		),
		true
	) ) {  // Adjust these slugs to match the actual attribute slugs for fees.
		$value = format_currency( $values[0], 'BBD' );  // Prefixing with BBD currency.
	}

	return $value;  // Always return the modified or original value.
}
add_filter( 'woocommerce_attribute', 'customize_woocommerce_attribute_display', 10, 3 );

function dynamic_related_products_heading( $heading ) {
	global $product;

	// Get the product categories
	$terms = wp_get_post_terms( $product->get_id(), 'product_cat' );

	// Check if product has categories
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		// Check if the term has a parent (0 means no parent)
		if ( $terms[0]->parent !== 0 ) {
			$parent_term   = get_term( $terms[0]->parent, 'product_cat' );
			$category_name = $parent_term->name;
		} else {
			$category_name = $terms[0]->name;
		}

		$heading = __( 'Related ', 'finance-compare' ) . $category_name;
	}

	return $heading;
}
add_filter( 'woocommerce_product_related_products_heading', 'dynamic_related_products_heading' );
