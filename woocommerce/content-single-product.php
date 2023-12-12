<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * @version     3.6.0
 */
defined('ABSPATH') || exit;
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');
if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.	
    return;
}
global $porto_layout, $porto_settings, $porto_product_layout, $product;



$productid = get_the_ID();
$post_class  = join(' ', wc_get_product_class('', $product));
$post_class .= ' product-layout-' . esc_attr($porto_product_layout);
$skeleton_lazyload = apply_filters('porto_skeleton_lazyload', !empty($porto_settings['show-skeleton-screen']) && in_array('product', $porto_settings['show-skeleton-screen']) && !porto_is_ajax(), 'single-product');
if ($skeleton_lazyload && ((function_exists('vc_is_inline') && vc_is_inline()) || porto_is_elementor_preview())) {
    $skeleton_lazyload = false;
}
if ($skeleton_lazyload) {
    $porto_settings['skeleton_lazyload'] = true;
    if (apply_filters('porto_skeleton_lazyload_product_desc_only', class_exists('WeDevs_Dokan') || class_exists('WCFM') || class_exists('Uni_Cpo') || class_exists('WooCommerce_Waitlist_Plugin'))) {
        $porto_settings['skeleton_lazyload_product_desc'] = true;
        $skeleton_lazyload                                = false;
    }
}
?>

<style>
    /* Tabs */

    #myTab .nav-item i {
        margin: 0 5px 0 0;
    }

    #myTab .nav-item button {

        color: #fff;

        border-radius: 0px;
    }

    #myTab .nav-item:nth-child(1) button {

        background-color: var(--bs-indigo);

    }

    #myTab .nav-item:nth-child(2) button {
        background-color: var(--bs-primary);

    }

    #myTab .nav-item:nth-child(3) button {

        background-color: var(--bs-pink);

    }

    #myTab .nav-item:nth-child(4) button {

        background-color: var(--bs-green);

    }

    /* side box style */


    .order-summary .card .card-header,
    .purchase-summary .card-header,
    .payment-head-sec {
        background-color: #000;
    }


    .card .card-header h5,
    .purchase-summary .card-header h5,
    .payment-head-sec h5 {
        color: #fff;
        line-height: 2;
    }



    @media screen and (max-width: 374px) and (min-width: 320px) {
        .head-cart {
            margin-left: 15px;
        }

        .list-bg {
            padding: 15px 0px;
        }

        .header-search {
            padding: 10px 10px;
        }

        .company-logo {
            /* width: 116px !important;
height: 40px !important; */
            width: 100% !important;
            height: 100% !important;
        }

        .logo-col {
            order: 1;
        }

        .currency-cart {
            order: 2;
        }

        .search-col {
            /* order: 3;
margin-top: 10px; */
        }

        .clientcurrency,
        .head-cart {
            padding: 0px;
        }

        .head-cart {
            margin-left: 8px;
        }

        .banner-bg {
            padding: 25px 10px !important;
        }

        .business-section {
            padding: 100px 10px 30px;
        }

        .banner-bg h1 {
            font-size: 19px;
        }

        .banner-bg h1 span {
            font-size: 25px;
        }

        .banner-bg a {
            font-size: 12px;
        }

        .details-section {
            padding: 15px 15px;
        }

        .details-section .details .details-head h1 {
            font-size: 15px;
        }

        .section-body {
            padding: 15px 30px;
        }

        .btn-mdf-button {
            font-size: 12px;
        }

        .about-us-content {
            padding: 15px 20px;
        }

        .contact-section,
        .accordion-sections {
            padding: 15px 5px;
        }

        .latest-blog .blog-card p {
            color: #ffffff;
        }

        .purchase-summary .currency-sec .custom-control-label,
        .purchase-summary .license-sec .custom-control-label {
            font-size: 12px !important;
        }
    }

/*
    .purchase-summary,
    .cid-btn-bg {
        background-color: #0E8BC8 !important;
    }
	*/

   

    .order-summary .card .card-header,
    .purchase-summary .card-header,
    .payment-head-sec {
        background-color: #3AAAE1;
    }

    .order-summary .card .card-header h5,
    .purchase-summary .card-header h5,
    .payment-head-sec h5 {
        color: #fff;
        line-height: 2;
    }


    .purchase-summary .currency-sec .custom-control-label,
    .purchase-summary .license-sec .custom-control-label,
    .purchase-summary .license-sec p,
    .purchase-summary .what-you-get p,
    .purchase-summary .what-you-get ul li,
    .pc-currencySymbol {
        color: #ffffff;
        font-size: 14px;
    }

    .purchase-summary .currency-sec .custom-control-label::before {
        /* left: -32%; */
        width: 15px;
        height: 15px;
        box-shadow: none;
    }

    .purchase-summary .currency-sec .custom-control-label::after {
        /* left: -60%; */
        width: 14px;
        height: 14px;
        box-shadow: none;
    }

    .purchase-summary .license-sec .custom-control-label::before {
        width: 15px;
        height: 15px;
        box-shadow: none;
    }

    .purchase-summary .license-sec .custom-control-label::after {
        width: 14px;
        height: 14px;
        box-shadow: none;
    }

    .purchase-summary .what-you-get ul {
        list-style: none;
        padding: 0;
    }

    .purchase-summary .what-you-get li {
        /*padding-left: 1.3em;*/
    }

    .purchase-summary .what-you-get li:before {
        /*content: "\f00c";*/
        /* FontAwesome Unicode */
        /*font-family: FontAwesome;*/
        /*display: inline-block;*/
        /*margin-left: -1.3em;*/
        /* same as padding-left set on li */
        /*width: 1.3em;*/
        /* same as padding-left set on li */
    }



    .purchase-summary .license-sec:hover {
        background-color: #3AAAE1;
        /* border-radius: 8px; */
        -ms-transform: scale(1.02);
        -webkit-transform: scale(1.02);
        transform: scale(1.02);
        transition: all 0.5s ease-in-out;
        cursor: pointer !important;
        color: #fff !important;
    }

    .purchase-summary .license-sec-active .custom-control-label,
    .license-sec-active .pc-currencySymbol,
    .purchase-summary .license-sec-active p,
    .purchase-summary .license-sec:hover .custom-control-label,
    .purchase-summary .license-sec:hover .pc-currencySymbol,
    .purchase-summary .license-sec:hover p {
        /* color: #212529 !important;*/
        font-weight: 400;
        color: #ffffff !important;
    }


    @media screen and (max-width: 374px) and (min-width: 320px) {
        .head-cart {
            margin-left: 15px;
        }

        .list-bg {
            padding: 15px 0px;
        }

        .header-search {
            padding: 10px 10px;
        }

        .company-logo {
            /* width: 116px !important;
height: 40px !important; */
            width: 100% !important;
            height: 100% !important;
        }

        .logo-col {
            order: 1;
        }

        .currency-cart {
            order: 2;
        }

        .search-col {
            /* order: 3;
margin-top: 10px; */
        }

        .clientcurrency,
        .head-cart {
            padding: 0px;
        }

        .head-cart {
            margin-left: 8px;
        }

        .banner-bg {
            padding: 25px 10px !important;
        }

        .business-section {
            padding: 100px 10px 30px;
        }

        .banner-bg h1 {
            font-size: 19px;
        }

        .banner-bg h1 span {
            font-size: 25px;
        }

        .banner-bg a {
            font-size: 12px;
        }

        .details-section {
            padding: 15px 15px;
        }

        .details-section .details .details-head h1 {
            font-size: 15px;
        }

        .section-body {
            padding: 15px 30px;
        }

        .btn-mdf-button {
            font-size: 12px;
        }

        .about-us-content {
            padding: 15px 20px;
        }

        .contact-section,
        .accordion-sections {
            padding: 15px 5px;
        }

        .latest-blog .blog-card p {
            color: #ffffff;
        }

        .purchase-summary .currency-sec .custom-control-label,
        .purchase-summary .license-sec .custom-control-label {
            font-size: 12px !important;
        }
    }
    
    .pc-currencySymbol{
        color: #000;
    }
</style>



<div id="product-<?php the_ID(); ?>" class="<?php echo esc_attr($post_class), !$skeleton_lazyload ? '' : ' skeleton-loading'; ?>">
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12">
            <div id="rep-desc-card" class="card text-left pt-lg-3 pb-lg-3 position-relative">
                <div class="details-head">
                    <div class="col-md-12">
                        <h2 class="reportexcerpt">
                            <?php echo     $reportDescription =   get_the_excerpt(); ?>
                        </h2>
                        <?php 
                        // echo do_shortcode('[display-map id="10992"]'); 
                        
                        ?>
                    </div>
                    <hr>
                    <div class="row my-70">
                            <div class="col-md-6 col-sm-6">
                                <p class="ij-report-meta"> <strong>
                                    Report Code:
                                </strong>
                                <?php echo      'CMI' . $productid; ?>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p class="ij-report-meta"> <strong>
                                Published Date:
                            </strong>
                            <?php echo      reportpublishedDate($productid); ?>
                        </p>
                        
                    </div>
                    
                </div>
                <div class="row my-70">
                        <div class="col-md-6 col-sm-6">
                            <p class="ij-report-meta"> <strong>
                                    Pages:
                                </strong>
                                <?php echo      $reportPublishedDate =  get_field('report_pages', $productid);  ?>
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p class="ij-report-meta"> <strong>
                                    Category:
                                </strong>
                                <?php echo ij_get_report_category_name($productid); ?>
                            </p>
                        </div>

                    </div>

                    <div class="row d-inline">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs flex spaceEqual" id="myTab" role="tablist">
                                <li class="nav-item " role="presentation">
                                    <button class="nav-link active product-description" id="home-tab" data-bs-toggle="tab" data-bs-target="#product-description" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fa-solid fa-chart-simple"></i>Product Description</button>
                                </li>
                                <li class="nav-item " role="presentation">
                                    <button class="nav-link table-of-contents" id="profile-tab" data-bs-toggle="tab" data-bs-target="#table-of-contents" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="fa-solid fa-money-bill-trend-up"></i>Table of Contents</button>
                                </li>
                                <!--
						   <li class="nav-item " role="presentation">
                                <button class="nav-link segmentation" id="contact-tab" data-bs-toggle="tab" data-bs-target="#segmentation" type="button" role="tab" aria-controls="contact" aria-selected="false"><i class="fa-solid fa-chart-pie"></i>Segmentation</button>
                            </li>-->
                                <li class="nav-item " role="presentation">
                                    <button class="nav-link methodology" id="contact-tab" data-bs-toggle="tab" data-bs-target="#methodology" type="button" role="tab" aria-controls="contact" aria-selected="false"><i class="fa-solid fa-sitemap"></i>Methodology</button>
                                </li>
                                <li class="nav-item " role="presentation">
                                    <button class="nav-link request-a-free-sample" id="free-sample-report-tab" data-bs-toggle="tab" data-bs-target="#request-a-free-sample" type="button" role="tab" aria-controls="contact" aria-selected="false"><i class="fa-solid fa-coins"></i>Key Players</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active limitContent" id="product-description" role="tabpanel" aria-labelledby="home-tab">
                                    <?php echo     $reportDescription =  get_field('reports_description', $productid); ?>
                                </div>
                                <!-- <a href="javascript:;" class="expandContent-product-description readmoreorlessbtn">Read more</a>-->
                                <!-- <a href="javascript:;" class="showless-product-description hide readmoreorlessbtn">Show Less</a> -->


                                <div class="tab-pane fade limitContent" id="table-of-contents" role="tabpanel" aria-labelledby="profile-tab">
                                    <?php echo     $reportTableofContents =  get_field('table_of_contents', $productid); ?>
                                </div>
                                <!-- <a href="javascript:;" class="expandContent-table-of-contents hide readmoreorlessbtn">Read more</a>-->
                                <!--<a href="javascript:;" class="showless-table-of-contents hide readmoreorlessbtn">Show Less</a>-->


                                <div class="tab-pane fade limitContent" id="segmentation" role="tabpanel" aria-labelledby="contact-tab">
                                    <?php echo     $reportSegmentation =  get_field('segmentation', $productid); ?>

                                </div>
                                <!-- <a href="javascript:;" class="expandContent-segmentation hide readmoreorlessbtn">Read more</a> -->
                                <!-- <a href="javascript:;" class="showless-segmentation hide readmoreorlessbtn">Show Less</a>-->

                                <div class="tab-pane fade limitContent" id="methodology" role="tabpanel" aria-labelledby="contact-tab">
                                    <?php echo     $reportMethodology =  get_field('methodology', $productid); ?>

                                </div>
                                <!-- <a href="javascript:;" class="expandContent-methodology hide readmoreorlessbtn">Read more</a> -->
                                <!-- <a href="javascript:;" class="showless-methodology hide readmoreorlessbtn">Show Less</a>-->
                                <div class="tab-pane fade" id="request-a-free-sample" role="tabpanel" aria-labelledby="contact-tab">
                                    <?php //echo     $free_sample_copy =  get_field('free_sample_copy', $productid); 
                                    ?>
                                    <?php

                                   // echo do_shortcode('[ij_ones_who_trusted_us]');
                                   // echo do_shortcode('[contact-form-7 id="551" title="Free Report Form]');
                                   //  echo do_shortcode('[elementor-template id="16535"]');

                                    ?>
									  <?php echo     $reportkey_players=  get_field('key_players', $productid); ?>
									<!-- <iframe src="https://custommarketinsights.formstack.com/forms/custommarketinsights" title="custommarketinsights" width="850" height="1100" style="overflow:hidden;"></iframe> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container-accordion">
                <h3 class="slider-title">FAQs</h3>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php
                    $faqvalues = get_field('faqs');
                    $number = 1;
                    if ($faqvalues)

                        foreach ($faqvalues as $value) {
                    ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading<?php echo numberToNumberName($number); ?>">
                                <h4 class="panel-title">
                                    <a style="color:#fff;" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo numberToNumberName($number); ?>" aria-expanded="false" aria-controls="collapse<?php echo numberToNumberName($number); ?>">
                                        <?php echo $number . ' . ' . $value['faq-title']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?php echo numberToNumberName($number) ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo numberToNumberName($number); ?>">
                                <div class="panel-body">
                                    <?php echo $value['faq_description']; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                            $number++;
                        } ?>
                </div>
            </div>

            <div id="relatedPosts" class="related-report-container">
                

                <?php



                /*
				$PublishedDate = substr( $reportPublishedDate , 3);
				$breakDate = explode (',', $PublishedDate);
				$Month	= $breakDate[0];
				$monthName = nameofmonth($Month);
				$Year	=  isset($breakDate[1])? $breakDate[1] : '';
				*/

                
				$cats =  wp_get_object_terms(get_the_ID(), 'product_cat');
				
				
				/*echo '<pre>';
				print_r($cats);
				echo '</pre>';
				*/
				$numberofCat  = count($cats);
				if( $numberofCat == 1 ){
					?>
					<h3 class="slider-title">Related Reports</h3>
					<?php
					
				
                $catArra = array();
				$reportid = get_the_ID();
				//echo 'D';
                foreach ($cats as $cat) {

                    $catArra[] = $cat->term_id;
                    
                }
                $relatedReports = ij_get_related_reports($catArra , $reportid);
				
				
				
				 		
                foreach ($relatedReports as $product) {
					
					$postid =  $product->ID;
					//print_r($product);
					/*$ReportCategoryId = get_field('report_category_id', $postid);
					$GetRelatedReportsByCatName = GetRelatedReportsByCatID($ReportCategoryId);
					// print_r($GetRelatedReportsByCatName);
					*/

               // foreach ($GetRelatedReportsByCatName as $report) {
					//$reportid =  $report->ID;
					//print_r($report);
					//var_dump($showinRelatedReport);
					$showinRelatedReport = get_field('added_in_related_report_section', $postid);
					 //if($showinRelatedReport  ){
                ?>
                    <div class="flex related-reports-item">
                        <div class="col-md-8 col-sm-12 paddingzero marginzero" style="padding: 0px;">
                            <p class="report-title"><a href="<?php echo  get_permalink( $postid);?>"  target="blank" ><?php echo  $product->post_title; ?></a></p>
							<p><?php //echo $product->post_excerpt; ?></p>
                        </div>
                        <div class="col-md-4 col-sm-12 text-right">
                            <a class="related_sample-download-btn" href="<?php echo home_url();  ?>/request-for-free-sample/?reportid=<?php echo  $product->ID; ?>" target="blank"><span class="report-publish-date"> <?php //echo $reportPublishedDate;  
                                                                                                                                                                                                                        ?></span>Download Sample </a>
                        </div>
                    </div>
                <?php 
					//}
					//}
				}
				}
			
			?>

            </div>
        </div>
        <!-- right side -->


        <div class=" purchase-summary  ij-purchase-option ps-data-card mt-lg-0 mt-md-4 col-xl-4 col-lg-4 col-md-12">
		 <div class="ij-purchasing-options card"> 
            <div class="card-header p-2 border-bottom">
                <h5 class="text-center capitalize mb-0">PURCHASE OPTIONS</h5>
            </div>
            <div class="card-body pt-2 pl-2 pr-2 pb-0" style="flex: 0.2 0 auto;">
                <div class="currency-sec pt-2 pb-2" style="display: flex;justify-content: space-between; align-items: center;">
                    <div class="form-group my-auto">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="currencyRadio1" name="currencyRadio" class="custom-control-input pc_currency_type_radio_btn" value="1" checked="checked">
                            <label class="custom-control-label currency-label" for="currencyRadio1">$ USD</label>
                        </div>
                    </div>
                    <div class="form-group my-auto">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="currencyRadio2" name="currencyRadio" class="custom-control-input pc_currency_type_radio_btn" value="0.95">
                            <label class="custom-control-label currency-label" for="currencyRadio2">€ EUR</label>
                        </div>
                    </div>
                    <div class="form-group my-auto">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="currencyRadio3" name="currencyRadio" class="custom-control-input pc_currency_type_radio_btn" value="130.39">
                            <label class="custom-control-label currency-label" for="currencyRadio3">¥ JPY</label>
                        </div>
                    </div>
                    <div class="form-group my-auto">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="currencyRadio4" name="currencyRadio" class="custom-control-input pc_currency_type_radio_btn" value="82.11">
                            <label class="custom-control-label currency-label" for="currencyRadio4">₹ INR</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="card-body p-2 ml-2 mr-2 border-bottom" style="flex: 0.2 0 auto;">
                <div class="row license-sec license-sec-active" data-packagerow="single">
                    <div class="col-md-5 col-5 py-2 pr-0">
                        <div class="form-group my-auto">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="licenseRadio" class="custom-control-input license_type_radio_btn sl-val" value="<?php 
                               // echo get_field('single_price', $productid); 
                                echo productprice($productid); ?>" checked="">
                                <label class="custom-control-label pl-0 pr-0" for="customRadio1">Single User</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-4 " style="padding: 6px 0;">
                        <figure class="mb-0" style="display:inline-flex;align-items: center;"> 
						<i class="fa-solid fa-file-pdf" style="color:#f1c40f; font-size:1rem; margin: 0 5px 0 0;"></i>
						
						 
						</figure>
                    </div>
                    <div class="col-md-3 col-3 py-2 px-0"> <span class="pc-currencySymbol">$</span>
                        <p class="sl-report-price mb-0" style="display:inline-block;" id="sg-license-cost"><?php 
                       // echo get_field('single_price', $productid);  
                       echo productprice($productid); ?></p>
                    </div>
                </div>
                <hr class="m-0">
                <div class="row license-sec" data-packagerow="team">
                    <div class="col-md-5 col-5 py-2 pr-0">
                        <div class="form-group my-auto">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="licenseRadio" class="custom-control-input license_type_radio_btn tl-val" value="<?php echo get_field('team_price', $productid); ?>">
                                <label class="custom-control-label pl-0 pr-0" for="customRadio2">Team</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-4 " style="padding: 6px 0;">
                        <figure class="mb-0 vertical-alignment" style="display:inline-flex;align-items: center;"> 
						<i class="fa-solid fa-file-pdf" style="color:#f1c40f; font-size:1rem; margin: 0 5px 0 0;"></i>
						<i class="fa-solid fa-file-excel" style="color: #2ecc71;"></i>
						</figure>
                    </div>
                    <div class="col-md-3 col-3 py-2 px-0"> <span class="pc-currencySymbol">$</span>
                        <p class="tl-report-price mb-0" id="tm-license-cost" style="display:inline-block;"><?php echo get_field('team_price', $productid); ?></p>
                    </div>
                </div>
               
				 <hr class="m-0">
                <div class="row license-sec"  data-packagerow="enterprise">
                    <div class="col-md-5 col-5 py-2 pr-0">
                        <div class="form-group my-auto">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="licenseRadio" class="custom-control-input license_type_radio_btn el-val" value="<?php echo get_field('enterprise_price', $productid); ?>">
                                <label class="custom-control-label pl-0 pr-0" for="customRadio3">Enterprise</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-4 " style="padding: 6px 0;">
                        <figure class="mb-0 vertical-alignment" style="display:inline-flex;align-items: center;"> 
							<i class="fa-solid fa-file-pdf" style="color:#f1c40f; font-size:1rem; margin: 0 5px 0 0;"></i>
							<i class="fa-solid fa-file-excel" style="color: #2ecc71;"></i>
							<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAACXBIWXMAAAsTAAALEwEAmpwYAAAADUlEQVR4nGO4sYRnCQAGDQItJOibXwAAAABJRU5ErkJggg==">
							<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAABRUlEQVR4nL2TsS8EURDGNxQqEoVEIyK0xL5ZV+h0FEThOi1/g8pFQ4dLjtx8u/Qu0UgI0anEf6DUUGBn7hAXhZWX2D3r9hJyyb3kS14mb36Zme+N4/w6U6XXQbess8S6RixHhuWWWHecVodYFgmyaSBnBLknaNQkVp4OHnvH97X/p/KVqNvJTMgAEOtVRhztAo7/AZAZYs3HMqy1BoCl5JbDeXt3/XDCQAsEvZs8qA38sQK5JtZRgr7ZYXkcLhDLucfVuRhgY8bX1VgEfUkAhuV9rBj1EOTCPnSDcNhaZ1jXY4BhOSVomIjlMzUDLxDX9avLBNnLQUYIskSsJ0kLkA2CVhqSegpgICvWWwO5scm54lOfgTwkFUC3DfQyFkE+0i6w8ncbdYJseYfPQx20ER35SJkAbmuZnELU1bSdmesM3W21zl8J10TMHNrPcAAAAABJRU5ErkJggg==">
						</figure>
                    </div>
                    <div class="col-md-3 col-3 py-2 px-0"> <span class="pc-currencySymbol">$</span>
                        <p class="el-report-price mb-0" id="et-license-cost" style="display:inline-block;"><?php echo get_field('enterprise_price', $productid); ?></p>
                    </div>
                </div>
                
                <hr class="m-0">
                <div class="row license-sec" data-packagerow="data">
                    <div class="col-md-5 col-5 py-2 pr-0">
                        <div class="form-group my-auto">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio4" name="licenseRadio" class="custom-control-input license_type_radio_btn dp-val" value="<?php echo get_field('data_pack', $productid); ?>">
                                <label class="custom-control-label pl-0" for="customRadio4">Data Pack</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-4 vertical-alignment" style="padding: 6px 0;">
                        <figure class="mb-0" style="display:inline-flex;align-items: center;"> 
						
						<i class="fa-solid fa-file-excel" style="color: #2ecc71;"></i>
						</figure>
                    </div>
                    <div class="col-md-3 col-3 py-2 px-0"> <span class="pc-currencySymbol">$</span>
                        <p class="dp-report-price mb-0" style="display:inline-block; " id="dp-license-cost"><?php echo get_field('data_pack', $productid); ?></p>
                    </div>
                </div>
				<hr class="m-0">
				<div style="position:relative;">
				<a href="https://www.custommarketinsights.com/cmi-explorer/" target="blank" style="    color: #fff;  position: absolute;  top: 8px;  left: 32%;  z-index: 999;"> <i class="fa-sharp fa-solid fa-circle-info"></i></a> 
				</div>
                <div class="row license-sec" data-packagerow="powerbi">
                    <div class="col-md-5 col-5 py-2 pr-0">
                        <div class="form-group my-auto">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio5" name="licenseRadio" class="custom-control-input license_type_radio_btn el-val" value="<?php echo get_field('powerbi_price', $productid); ?>">
                                <label class="custom-control-label pl-0 pr-0" for="customRadio5">Power BI 
								
								</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-4 vertical-alignment" style="padding: 6px 0;">
                        <figure class="mb-0" style="display:inline-flex;align-items: center;"> 
							<i class="fa-solid fa-file-pdf" style="color:#f1c40f; font-size:1rem; margin: 0 5px 0 0;"></i>
							<i class="fa-solid fa-file-excel" style="color: #2ecc71;"></i>		
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/market-research/powerbi.png" alt="powerbi" style="width:20px;padding-right:4px"> 
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/market-research/ms-power-bi.png" alt="pdf" style="width:20px;padding-right:4px"> 
							<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAACXBIWXMAAAsTAAALEwEAmpwYAAAADUlEQVR4nGO4sYRnCQAGDQItJOibXwAAAABJRU5ErkJggg==">
							
						</figure>
                    </div>
                    <div class="col-md-3 col-3 py-2 px-0"> <span class="pc-currencySymbol">$</span>
                        <p class="el-report-price mb-0" id="bi-license-cost" style="display:inline-block; "><?php echo get_field('powerbi_price', $productid); ?></p>
                    </div>
                </div>
                <input type="hidden" name="license_type" class="license_type" value="SL" />
                <input type="hidden" name="currencySymbol" class="currencySymbol" value="£" />
                <input type="hidden" name="price" class="report-price" value="3447" />
                <input type="hidden" class="report-link" value="<?php echo get_permalink(); ?>" />
                <input type="hidden" name="reporttitle" class="report-title" value="<?php echo RemoveSpecialChar(get_the_title()); ?>" />
                <input type="hidden" name="reportID" class="report-id" id="thiisreportid" value="<?php echo get_the_ID(); ?>" />
                <input type="hidden" name="report-slug" class="report-slug" value="<?php echo get_the_permalink(); ?>" /> 
            </div>
            <div class="card-body p-2 ml-2 what-you-get">
                <p><b>What You Get :</b></p>
				 
				
				<?php the_field('what_you_get_with_single_user_license', 'option'); ?>
				<?php the_field('what_you_get_with_team_user_license', 'option'); ?>
				<?php the_field('what_you_get_with_enterprise_user_license', 'option'); ?>
				<?php the_field('what_you_get_with_data_pack_user_license', 'option'); ?>
				<?php the_field('what_you_get_with_power_bi_user_license', 'option'); ?>
				
				
				
                <div class="col-lg-12 col-md-12 col-12 text-center pb-3 productid-<?php echo $productid; ?>">
                    <?php echo do_shortcode('[add_to_cart_form id="' . $productid . '" hide_quantity="true" show_price="false"]'); ?>
                </div>
            </div>



            <div class="request-for-customization ij-cta hide">


                <div id="accordion " class="cta-container">
                     
                    <!-- <div class="card mt-3 customization-sec" style="cursor:pointer;">
                        <div class="card-body sticky-card-body pt-2 pb-2 pl-1 pr-1">
                            <p class="mb-0 text-center">Didn’t find what you’re looking for?<br> <b>TALK TO OUR TEAM</b></p>
                            <div class="row p-2">
                                <div class="col-md-12 col-12 my-auto" id="headingOne">
                                    <a href="/request-for-free-sample/?reportid=<?php //echo $productid; ?>" target="blank" class="text-decoration-none">
                                        <button class="text-center btn cid-btn-bg slide_from_left col-lg-12 col-12 rd-fixed-side-nav-btns" type="submit">
                                            <figure class="mb-0">
                                                <img src="<?php //echo get_stylesheet_directory_uri(); ?>/images/customer-service.png" alt="customer-support" style="width:30px;">
                                            </figure>
                                            <span class="pl-2 text-color">ASK FOR CUSTOMIZATION</span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="card mt-3 discount-sec" style="cursor:pointer;">
                        <div class="card-body sticky-card-body pt-2 pb-2 pl-1 pr-1">
                            <p class="mb-0 text-center">Want to customize this report?<br> <b>100% FREE CUSTOMIZATION!</b><br></p>
                            <div class="row p-2">
                                
  <!--                              
<a href="/inquire-for-discount/?reportid=<?php echo $productid; ?>" target="blank" class="text-decoration-none">
<button class="text-center btn col-lg-12 col-12 rd-fixed-side-nav-btns" type="submit">
<figure class="mb-0">
<i class="fa-solid fa-wand-magic-sparkles"></i>
</figure>
<span class="pl-3 text-color">Request for Customization</span>
</button>
</a>
-->

								<a class="customizationRequestbtn" href="/inquire-for-discount/?reportid=<?php echo $productid; ?>" target="blank" class="text-decoration-none">
								    <figure class="mb-0">
                                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                                            </figure>
                                            <span class="pl-3 text-color">Request for Customization</span>
                                         
                                    </a>
                                <div class="col-md-12 col-12 my-auto" id="headingTwo">
                                    <!-- <a href="/inquire-for-discount/?reportid=<?php echo $productid; ?>" target="blank" class="text-decoration-none">
                                        <button class="text-center btn cid-btn-bg slide_from_left col-lg-12 col-12 rd-fixed-side-nav-btns" type="submit">
                                            <figure class="mb-0">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/tag.png" alt="tag" style="width:30px;">
                                            </figure> 
											<i class="fa-solid fa-tags"></i>
                                            <span class="pl-3 text-color">Request for Customization</span>
                                        </button>
                                    </a>
									-->
									
									
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 download-sec breathingbtn" style="cursor:pointer; background-color: #f04c23;">
                        <a href="/request-for-free-sample/?reportid=<?php echo $productid; ?>" target="blank" class="text-decoration-none">
                            <button class="text-center btn col-lg-12 col-12 rd-fixed-side-nav-btns" type="submit">
                                <figure class="mb-0">
								<i class="fa fa-download" style="color:#fff;"></i>
                                    
                                </figure>
                                <span class="pl-3 text-color">DOWNLOAD FREE SAMPLE</span>
                            </button>
                        </a>
                    </div>
						<div class='row chart-utils' style='margin: 20px 0 0 0; justify-content: center;'>
					<a target='blank' onclick=facebooksharing(); class='facebook'><i class=' fa fa-facebook facebook' style='color: #2980b9;'></i></a>
					<a target='blank' onclick=twittersharing();  class='twitter'><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg></a>
					<a target='blank'  onclick=redditsharing();  class='reddit'><i class=' fa fa-reddit reddit' style='color: #c0392b;'></i></a>
					<a target='blank'  onclick=linkedsharing();  class='linkedin'><i class=' fa fa-linkedin linkedin' style='color: #1e90ff;'></i></a>
					<a  target='blank'  onclick=whatsappsharing();  class='whatsapp'><i class=' fa fa-whatsapp whatsapp' style='color: #2ecc71;'></i></a>
					<a  target='blank'  onclick=telegramsharing();  class='telegram'><i class=' fa fa-telegram telegram' style='color: #2980b9;'></i></a>
		</div>
                </div>

            </div>


        </div>
        </div>
        </div>