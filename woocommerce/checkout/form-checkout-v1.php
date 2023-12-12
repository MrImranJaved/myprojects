<?php
/**
 * Checkout Form V1
 *
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$porto_woo_version = porto_get_woo_version_number();
$checkout          = WC()->checkout();

/*
global $woocommerce;
$items = $woocommerce->cart->get_cart();
echo "<pre>";
print_r($items);
echo "</pre>";
*/
// filter hook for include new pages inside the payment method
$get_checkout_url = wc_get_checkout_url();
?>

<script>
			   jQuery(document).ready(  function (){
				   
				   console.log("checkout page ready!")
					let report_title = localStorage.getItem('imran_reporttitle');
					let reportexcerpt = localStorage.getItem('imran_reportexcerpt');
					let reportlink = localStorage.getItem('imran_reportlink');
					
					console.log(reportlink);
				   if( report_title !='' ) {
						jQuery('.reportTtile').append(report_title);
				   }
				   
				    if( reportexcerpt !='' ) {
						jQuery('.reportExcerpt').append(reportexcerpt);
				   }
				   
						jQuery('a.backtoreport').attr( "href" , reportlink);
				   
				   
					
				   
			   });
			</script>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="row" id="customer_details">
			<div class="col-lg-4">
				<div class="align-left">
					<div class="box-content" style="border: 1px solid #ccc; padding: 20px;">
						<h2 class="sectionHeading"> Billing Information </h2>
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
						<?php //do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>
				<div class="supportedpayments py-2">
				    
				
				<img src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/supportedpayments.jpg'?>" />
				</div>
			</div>
			<div class="col-lg-8">
				<div class="align-left">
					<div class="checkout-order-review align-left">
						<div class="box-content featured-boxes">
							<!-- <h3 id="order_review_heading" class="text-md text-uppercase"><?php //esc_html_e( 'Your order', 'woocommerce' ); ?></h3> -->
							<h2 class="sectionHeading">Report Title</h2>	
<div class="reportTitleContainer">
<div class="reportNameContainer">
	<a href="#" class="backtoreport">Back to report</a>
	<p class="reportTtile" data-reportTtile="" data-reportid=""> </p>
	</div>
	<p class="reportExcerpt"></p>
</div>
<h2 class="sectionHeading" >Purchase Options</h2>
							<div class="table-wrapper">
								<div class="scroller">
									
<table>
  <tr class="tableHeading">
    <th style="width:25%">LICENSE TYPE</th>
    <th style="width:25%">USER ACCESS</th>
    <th style="width:25%">WHAT YOU GET</th>
    <th style="width:25%">ANALYST SUPPORT</th>
  </tr>
  <tr class="tableRow singleuser">
    <td>
	<label class="container">Single License
	<!-- <input type="radio"   id="singlelicense01" class="packageprice-"   name="poption"> -->
	<span class="checkmark"></span>
	</label>
	</td>
    <td>1 User</td>
    <td>
	<img src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/pdf.png'?>" />

	</td>
    <td>Free 25% or 40 hours of customisation.</td>
  </tr>
<tr class="tableRow teamlicense">
    <td><label class="container">Team License
	<!-- <input type="radio" value="" id="teamlicense01" class="packageprice-" checked="checked" name="poption"> -->
	<span class="checkmark"></span>
	</label>
	</td>
    <td>2-5 Users</td>
    <td> 
	<img src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/pdf.png'?>" />
	<img src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/excel.png'?>" />
	</td>
    <td>Free 35% or 60 hours of customisation.</td>
  </tr>
  <tr class="tableRow enterpriselicense">
    <td>
	<label class="container">Enterprise License
	<!-- <input type="radio" value="" id="enterpriselicense01" class="packageprice-"  name="poption"> -->
	<span class="checkmark"></span>
	</label>
	</td>
    <td>Unlimited Users</td>
    <td>
		<img src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/pdf.png'?>" />
		<img src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/excel.png'?>" />
		<img src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/powerbi.png'?>" />
		 
	</td>
    <td>Free 40% or 80 hours of customisation.</td>
  </tr>
  
  <tr class="tableRow datapack">
    <td><label class="container">Data Pack
	<!-- <input type="radio" value="" id="datapack01" class="packageprice-" name="poption"> -->
	<span class="checkmark"></span>
	</label>
	</td>
    <td>Customized</td>
    <td> 
	<img src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/excel.png'?>" />
	</td>
    <td>Upgradable to other licenses.</td>
  </tr>	
  <tr class="tableRow powerbilicense">
    <td>
	<label class="container">Power BI License
	<!-- <input type="radio" value="" id="enterpriselicense01" class="packageprice-"  name="poption"> -->
	<span class="checkmark"></span>
	</label>
	</td>
    <td>Unlimited Users</td>
    <td>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/market-research/pdf.png" alt="pdf" style="width:25px;padding-right:4px"> 
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/market-research/excel.png" alt="excel" style="width:25px;padding-right:4px"> 
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/market-research/powerbi.png" alt="powerbi" style="width:25px;padding-right:4px"> </figure>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/market-research/ms-power-bi.png" alt="pdf" style="width:25px;padding-right:4px"> 

		 
	</td>
    <td>Free 50% or 90 hours of customisation with Every Year Free Update (Apr - Apr)</td>
  </tr>
</table>
									
								</div>
							</div>
							<!--
<br>
<h2 class="sectionHeading"> PAYMENT OPTIONS</h2>
<div class="payment-option-container">
		<div class="row">
			<div class="col-md-4">
				<table>
				<tr class="payment_tableHeading">
				<th>Currency </th>
				<th>Total</th>

				</tr>
				<tr class="payment_tableRow">
				<td>$</td>
				<td>1200	</td>

				</tr>
				</table>
			</div>
			<div class="col-md-4 payment-icon-alignment  borderRight">
				<img  class="payment-icon" src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/paypal.png'; ?>" />
				<button class="paywithCC" id="paycc">Pay via Credit Card</button>
			</div>
			<div class="col-md-4 payment-icon-alignment">
				<img  class="payment-icon" src="<?php echo get_stylesheet_directory_uri(). '/images/checkout/bank-transfer.png'; ?>" />
				<button class="paywithBT paywithCC" id="paybt">Pay via Bank Transfer</button>
			</div>
		</div>


</div>
-->
 
							<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

							<div id="order_review" class="woocommerce-checkout-review-order">
								<?php do_action( 'woocommerce_checkout_order_review' ); ?>
							</div>

							<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>				
	<?php endif;  ?>
<style>

.customer-support-checkout-container ul li p{
    color: #fff;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="customer-support-checkout-container">
				<ul>
				<li>
					<i class="fa fa-solid fa-headset"></i>
					<p>NEED ASSISTANCE ? REACH OUT TO US</p>
				</li>
				
				<li>
					<i class="fa fa-envelope"></i>
					<p><?php  the_field('co_email_address', 'option') ; ?></p>
				</li>
				
				<li>
					<i class="fa fa-phone"></i>
					<p><?php   the_field('co_contact_number', 'option'); ?></p>
				</li>
				
				<li>
					<i class="fa fa-whatsapp" aria-hidden="true"></i>
					<a href="https://wa.me/message/DO6YG44I2NGFI1" target="_blank">
					
					<p>Chat with us</p>
					</a>
				</li>
				</ul>
		</div>
</div>
</div>
</form>