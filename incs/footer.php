<?php 
/*
$menu_name = 'footer-research-area-col-one'; //menu slug
$menu = wp_get_nav_menu_object( $menu_name  );
$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
*/
 global $post , $product;
$menu_findhelp = 'footer-findhelp-menu'; //menu slug
$menu_findhelp = wp_get_nav_menu_object( $menu_findhelp  );
$menuitems_findhelp = wp_get_nav_menu_items( $menu_findhelp->term_id, array( 'order' => 'DESC' ) );

$menu_about = 'footer-about-menu'; //menu slug
$menuabout = wp_get_nav_menu_object( $menu_about  );
$menuitemsabout = wp_get_nav_menu_items( $menuabout->term_id, array( 'order' => 'DESC' ) );


$menu_productandservice = 'footer-productandservice-menu'; //menu slug
$productandservice  = wp_get_nav_menu_object( $menu_productandservice  );
$menuitemsmenuproductandservices = wp_get_nav_menu_items( $productandservice ->term_id, array( 'order' => 'DESC' ) );


$menu_contact = 'footer-policy-menu'; //menu slug
$menucontact = wp_get_nav_menu_object( $menu_contact  );
$menuitemsmenucontact = wp_get_nav_menu_items( $menucontact->term_id, array( 'order' => 'DESC' ) );




$menu_newsletter = 'footer-industry-newsletter-options'; //menu slug
$menunewsletter = wp_get_nav_menu_object( $menu_newsletter  );
$menuitemsmenunewsletter = wp_get_nav_menu_items( $menunewsletter->term_id, array( 'order' => 'DESC' ) );
	global $porto_settings, $porto_layout;
 $copyrights = isset($porto_settings['footer-copyright'])? $porto_settings['footer-copyright'] : 'Copyright 2024 . All Rights Reserved.';
 $copryrightposition =  isset($porto_settings['footer-copyright-pos']) ? $porto_settings['footer-copyright-pos'] :'center';
 //ij_printr($porto_settings);
?>
<!-- 
<section class="research-footer-section container-fluid elementor-top-section">
<h4>Research Area</h4>
<div class="research-area-overlay elementor-section elementor-section-boxed">
<div class="row elementor-container" >

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-xl-0 mt-md-5">
            <h5 class="">Reports By Industry</h5>
            <div class="row">
			<?php 
					//foreach( $menuitems as $menusitem ){
			?>
                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="row">
                                <ul class="list-inline list-unstyled">
                                    <li class="list-unstyled">
                                        <i class="fa fa-arrow-circle-right grayicon" aria-hidden="true"></i><a href="<?php //echo $menusitem->url;?>" class="research-area-links text-decoration-none"><?php //echo $menusitem->title;?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
					<?php //} ?>
                 </div>
        </div>
</div>
</div>
</section>
-->
<footer class="container-fluid footer-bg-dark tb-padding-big">
    <!-- <h4 class="text-greyblue text-center">"We Think Through Different Layers, We Work Across Different Verticals."</h4>         -->
    <div class="row  mx-md-4 ">
        <div class="col-lg-2 col-md-6 col-sm-12 mt-4">
            <label class="footer-sub-heading">About</label>
            <ul class="pl-md-0 list-unstyled">
			<?php 
            if( !empty($menuitemsabout) )
					foreach( $menuitemsabout as $menusitem ){
			?>
                <li class="mt-2">
                    <a href="<?php echo $menusitem->url;?>" class="text-pinkish-grey mt-2"><?php echo $menusitem->title;?></a>
                </li>
					<?php } ?>
            </ul>
            
			<div class="payment-secure-trust-seal "> 
					<script type="text/javascript" referrerpolicy="origin" src="https://seal.securetrust.com/seal.js?style=normal"></script>
			</div> 
			
        </div>
        <div class="col-lg-2 col-md-6 col-sm-12 mt-4">
            <label class="footer-sub-heading">Find Help</label>
            <ul class="pl-md-0 list-unstyled">
			<?php 
            if( !empty( $menuitems_findhelp ) )
					foreach( $menuitems_findhelp as $menusitem ){
			?>
                <li class="mt-2">
                    <a href="<?php echo $menusitem->url;?>" class="text-pinkish-grey mt-2"><?php echo $menusitem->title;?></a>
                </li>
                <?php } ?>
            </ul>
            <div class="payment-gateway-icons ">
            <!-- <label class="footer-sub-heading"></label> -->
				<img src="<?php echo get_stylesheet_directory_uri().'/images/footer-images/fully_secured.png'; ?>" alt="custom market insights" />
			</div> 
        </div>
        <div class="col-lg-2 col-md-6 mt-sm-12 mt-4">
            <label class="footer-sub-heading">Our Products & Services</label>
            <ul class="pl-md-0 list-unstyled">
			<?php 

                     if( !empty( $menuitemsmenuproductandservices ) )   
					foreach( $menuitemsmenuproductandservices as $menusitem ){
			?>
                <li class="mt-2">
                    <a href="<?php echo $menusitem->url;?>" class="text-pinkish-grey mt-2"><?php echo $menusitem->title;?></a>
                </li>
                   <?php } ?>
            </ul>
            <div class="payment-gateway-icons ">
            <label class="footer-sub-heading">We Accept</label>
				<img src="<?php echo get_stylesheet_directory_uri().'/images/footer-images/footer-payment-new.png'; ?>" alt="custom market insights" />
			</div> 
        </div>
        <div class="col-lg-2 col-md-6 mt-sm-12 mt-4">
            <label class="footer-sub-heading">Contact</label>
            <ul class="pl-md-0 list-unstyled">
			<?php 

                     if( !empty( $menuitemsmenucontact ) )   
					foreach( $menuitemsmenucontact as $menusitem ){
			?>
                <li class="mt-2">
                    <a href="<?php echo $menusitem->url;?>" class="text-pinkish-grey mt-2"><?php echo $menusitem->title;?></a>
                </li>
                   <?php } ?>
            </ul>
            <div class="payment-gateway-icons ">
            <!-- <label class="footer-sub-heading"></label> -->
				<img src="<?php echo get_stylesheet_directory_uri().'/images/footer-images/best_price.webp'; ?>" alt="custom market insights" />
                <br>
                  <br>
                <a href="https://www.dnb.com/business-directory/company-profiles.cmi_market_research_private_limited.d9cc96a81d700f1bce20fbd1e93026b0.html" rel=nofollow><img src="<?php echo get_stylesheet_directory_uri().'/images/footer-images/dnbseal.png'; ?>" alt="DUNS NO.:93-027-1398" /></a>
                DUNS:93-027-1398
			</div>              
        </div>
        <div class="col-lg-4 col-md-6 mt-sm-4 mt-4">
            <label class="footer-sub-heading">Industry Newsletters</label>
			<?php echo do_shortcode('[wpforms id="17645"]'); ?>
               <!-- <form method="post" id="newsletterForm">
						  <select name="newsletter" id="newsletter" class="ind-button w-75 mb-3">
						<?php 

                        //if( !empty( $menuitemsmenunewsletter ) )
						// foreach( $menuitemsmenunewsletter as $optioin ){
						?>
							<option value="<?php //echo strtolower( str_replace( " " , "-" , $optioin->title )) ; ?>"><?php //echo $optioin->title;?></option>
					<?php //} ?>
						</select>  
                    <div class="input-group subscribe-input">
                        <input type="email" class="form-control" name="newsletter_email" placeholder="Enter your Email" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                        <div class="input-group-append">
                            <button id="submit" class="btn btn-outline-secondary" type="submit" value="Submit">Subscribe</button>
                        </div>
                    </div>
                    <p id="newsletter-error" class="invisible mb-0" style="color:#ff3333;">Please enter email</p>
                    <p id="newsletter-success" class="invisible" style="color:#00908d;">You are Subscribed</p>
                </form> -->
				 
               <?php
			   echo do_shortcode('[grw id="22133"]');
			   ?>
            </div>
			
        </div>
 </div>
    <div class="row">
        <div class="col-lg-12  col-sm-12 text-<?php echo $copryrightposition; ?>  mt-md-5 mt-lg-0 mb-3">
        <p class="text-color-white"><?php echo $copyrights; ?></p>
        <p class="text-color-white">Powered by : <a href="http://bit.ly/3RyXkc4" target="blank">CMI Consulting</a></p>
    </div>
    </div>
     
</footer>

<?php 

        $custom_post_type = get_post_type();
        $custom_post_type_data = get_post_type_object( $custom_post_type );
        
        $custom_post_type_name = $custom_post_type_data->name;
        /*echo '<pre>';
        print_r($custom_post_type_data);
        echo '</pre>';
        */
       // echo $custom_post_type_name;
       
       if($custom_post_type_name == 'press-releases'){
           
           ?>
           
           
<script>
jQuery( document ).ready( function(){
    
            var ogDes = jQuery("meta[property='og:description']").attr("content");
            var ogTitle = jQuery("meta[property='og:title']").attr("content"); 
            
            
            
            var xTitle = jQuery("meta[name='twitter:title']").attr("content"); 
            var xDes = jQuery("meta[name='twitter:description']").attr("content"); 
            var Des = jQuery("meta[name='description']").attr("content"); 
            
            
            var title = jQuery("title").text();
            
            var replaceword = 'Archive';
            var repDes = ogDes.replace(replaceword, '');
            var repTitle = ogTitle.replace(replaceword, '');  
            
            
            var xrepDes  = xTitle.replace(replaceword, '');
            var xrepTitle  = xDes.replace(replaceword, '');
            var repltitle  = title.replace(replaceword, '');
            
            var repTitle = ogTitle.replace(replaceword, '');  
    
            jQuery("meta[property='og:description']").attr("content", repDes );
            jQuery("meta[property='og:title']").attr("content", repTitle);
            
            jQuery("title").text(repltitle);
            
            
            jQuery("meta[name='twitter:title']").attr("content", xrepDes); 
            jQuery("meta[name='twitter:description']").attr("content", xrepTitle); 
            jQuery("meta[name='description']").attr("content", repNameDes); 
            
            
            
            
            
    
});

</script>
           
           
           <?php
           
       }

?>



<script>
jQuery( document ).ready( function(){
    

jQuery('.archive .price > .woocommerce-Price-amount').text('$3,490.00');
jQuery('.product_list_widget .woocommerce-Price-amount ').text('$3,490.00');




});
     document.addEventListener( 'wpcf7mailsent', function( event ) {

setTimeout(   window.location.href = "<?php echo home_url().'/thanks/'; ?>" , 5000 );

}, false );


</script>
 <?php 
if ( is_product() || is_page('994')){
?>




<script>

jQuery('.owl-carousel').owlCarousel({
    loop:true,

    touchDrag:true,
    mouseDrag:true,
    rewind:true,
    dots:false, 
    autoplay:true,
    slideTransition: 'linear',
    autoplaySpeed: 6000,
    smartSpeed: 2000,
    center: true,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:4
        },
        1000:{
            items:5
        }
    }
});
</script>

<?php

}


   




	if( is_product() ){

        $reportid =  !empty($post->ID) ? $post->ID : '';

 ?>
 
 <script>
 jQuery( document ).ready( function(){


    

    var sglisprice = jQuery('#sg-license-cost').text();
    var tmlisprice = jQuery('#tm-license-cost').text();
    var etlisprice = jQuery('#et-license-cost').text();
    var dplisprice = jQuery('#dp-license-cost').text();
    var bilisprice = jQuery('#bi-license-cost').text();
    
    jQuery("#packone").val(sglisprice);
    jQuery("#packtwo").val(tmlisprice);
    jQuery("#packthree").val(etlisprice);
    jQuery("#packfour").val(dplisprice);
    jQuery("#packfive").val(bilisprice);
    
    console.log('price updated')
    
    jQuery('.license-sec').on('click', function(){
        
        
        var packagename = jQuery(this).data('packagerow');
        var p = jQuery(this).find('.col-md-3 p').text();
        var pack = ''; 
        
        
        if(packagename == 'single'){
            
            pack = 'single';
            
            jQuery("#packone").val(p);
        }else if(packagename == 'team'){
            
            pack = 'team';
            jQuery("#packtwo").val(p);
        }else if(packagename == 'enterprise'){
            pack = 'enterprise';
            jQuery("#packthree").val(p);
        }else if(packagename == 'data'){
            pack = 'data';
            jQuery("#packfour").val(p);
        } else if(packagename == 'powerbi'){
            pack = 'powerbi';
            jQuery("#packfive").val(p);
        }
        
        
        
        console.log(pack);
    })



    const pagehash =  window.location.hash;
        if( pagehash == '#wpcf7-f551-p11534-o1' || pagehash == '#wpcf7-f551-o3'){

            setTimeout(   window.location.href = "<?php echo home_url().'/thanks/'; ?>" , 5000 );

        }
 
    const reportid = localStorage.getItem('free-sample-report-id');
    const reportlink = '<?php echo home_url();?>/request-for-free-sample/?reportid='+<?php echo $reportid; ?>;
	 
    console.log(reportlink);

	 jQuery('.ij-download-sample, .ij-contact-for-discount , .ij-chat-with-us').attr('href', reportlink);
	localStorage.removeItem('ij-report-title');
	
	/*setTimeout(
	
			triggerModal
		, 30000
	);
	*/
    jQuery('#myModal').on('hidden.bs.modal', function(){


        jQuery("html").animate({ scrollTop: 0 }, "slow");

    }); 
			
 jQuery('.ij-download-sample , .revealCTASection .breathingbtn a , #headingTwo a, #headingOne a').on( 'click' , function(){
	 
			const reportTitle = jQuery('.page-header-7 .page-title').text()
			
			if( reportTitle != null){
				
			    localStorage.setItem('ij-report-title', reportTitle);
			 
			}
	 
 } )
 
 
 
 const reportTitle = jQuery('.page-header-7 .page-title').text();
 jQuery('input[name="report-name"]').val(reportTitle);
 
 function triggerModal(){
	jQuery(".reportModal").trigger("click");
 }
 
                const ijreportid = jQuery('.report-id').val();
				const reporttitle = jQuery('.page-title').text();
				const reportexcerpt = jQuery('.reportexcerpt').text();
				const ijreportlink = jQuery('.report-link').val();
  
				localStorage.setItem("imran_reportid", ijreportid);
				localStorage.setItem("imran_reporttitle", reporttitle);
				localStorage.setItem("imran_reportexcerpt", reportexcerpt);
				localStorage.setItem("imran_reportlink", ijreportlink);
				
				
				
				
				localStorage.setItem("imran_singlelicense01", 3200);
				localStorage.setItem("imran_teamlicense01", 4200);
				localStorage.setItem("imran_enterpriselicense01", 5200);
				localStorage.setItem("imran_datapack01", 1800);
 



    


 });
 
 
 </script>
 
 
 <section class="fixedFooter">
		<div class="container">
				<div class="row" style="flex-direction: row-reverse;">
					<div class="col-md-12 col-sm-12 text-center">
						<a target="blank" href="<?php echo home_url(); ?>/request-for-free-sample/?reportid=<?php echo  $post->ID; ?>" target="black" class="ij-download-sample">Download Free Sample Report</a>
					</div>
					 
				</div>
		</div>
 </section>
 
 <button type="button" class="btn btn-info btn-lg reportModal" data-toggle="modal" data-target="#myModal">Open Modal</button>
 <!-- Modal -->
<div id="myModal"   class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
          <h4 class="modal-title text-center"><?php echo ij_get_product_title_id( $reportid ) ; ?></h4>
         <?php 
		//echo do_shortcode('[contact-form-7 id="551" title="Free Report Form"]'); 
		echo do_shortcode('[elementor-template id="780"]');
		 ?>
		 <!-- <iframe src="https://custommarketinsights.formstack.com/forms/custommarketinsights" title="custommarketinsights" width="600" height="400"></iframe> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" defer integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" defer integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<?php } ?>
	
    <?php 
	 global $post;
	if( $post->ID == 11386) {
		
		$getreportid = isset($_GET['reportid']) && !empty($_GET['reportid']) ? $_GET['reportid'] : '';
		$reportTtile = ij_get_product_title_id($getreportid);
		//echo $reportTtile;
 ?>
     
     
     
  <script>
 jQuery( document ).ready( function(){
	 
	 
		jQuery('.page-header-7 h1').append("<?php echo "<p>".$reportTtile."</p>"; ?>");
        jQuery('.page-id-11386 #wpcf7-f11388-p11386-o1  .reportname').val('<?php echo $reportTtile; ?>')
        jQuery('.page-id-11386 #wpcf7-f11388-p11386-o1  .reportid').val('<?php echo $getreportid; ?>')
	 
 })
 </script>
 
 
	<?php } 



 
	 global $post;
	if( $post->ID == 994) {
		
		$getreportid = isset($_GET['reportid']) && !empty($_GET['reportid']) ? $_GET['reportid'] : '';
		$reportTtile = ij_get_product_title_id($getreportid);
		echo $reportTtile;
 ?>
  <script>
 jQuery( document ).ready( function(){
	 
	 
		jQuery('.page-header-7 h1').after("<?php echo "<p>".$reportTtile."</p>"; ?>");
        jQuery('.page-id-994 #wpcf7-f551-p994-o1 .reportname').val('<?php echo $reportTtile; ?>')
        jQuery('.page-id-994 #wpcf7-f551-p994-o1 .reportid').val('<?php echo $getreportid; ?>')
	 
 })




 </script>
 
 
	<?php } 

    if(  is_shop() || is_product_category() ){
	?>

<script>

    function addDownloadBtn(){

                const productid  = jQuery(".reportMetaArchive").data('productid');
                const downloadBTN = '<a class="button" href="<?php echo home_url(); ?>/request-for-free-sample/?reportid='+productid+'">Download Sample</a>';
                jQuery(".add-links-wrap .add-links a.button").after(downloadBTN);

    }
   jQuery(document).ready(function() {

        jQuery('body.archive .breadcrumb li:nth-child(2) , .breadcrumb li:nth-child(3)').hide();
        jQuery(".widget_product_tag_cloud .widgettitle").text("Filter by Status");
        
        
        const products = jQuery(".reportMetaArchive");
        // const products = document.querySelector('.reportMetaArchive');
        console.log(products.length);
     
        // for( let i = 0; i < products.length; i++  ){

            // console.log(products[i]);
            
            // }

            // addDownloadBtn();
            jQuery(".page-numbers .next").on( 'click' ,  function(){
                
                // addDownloadBtn();
            } )
            

        

			//Menu working for woocommerce pages

	/*	jQuery(".archive #menu-1-9732115 li.menu-item-has-children > a").addClass("has-submenu");
		jQuery('.archive #menu-1-9732115 li.menu-item-has-children > a').next('ul').next().html('<span class="scroll-up" style="top: auto; left: 0px; margin-left: 0px; width: 278.672px; z-index: 4; margin-top: -272.969px; visibility: hidden; display: none;"><span class="scroll-up-arrow"></span></span>');
		jQuery('.archive #menu-1-9732115 li.menu-item-has-children > a').next('ul').next().html('<span class="scroll-down" style="display: block; top: auto; left: 0px; margin-left: 0px; width: 278.672px; z-index: 4; margin-top: 348.031px; visibility: visible;"><span class="scroll-down-arrow"></span></span>');
			console.log('menu working')
			
			
			jQuery('.archive #menu-1-9732115 li.menu-item-has-children a').next('ul').attr('id', 'sm-16890003406237656-2')    ;
            jQuery('.archive #menu-1-9732115 li.menu-item-has-children a').next('ul').attr('role', 'group')    ;
            
            jQuery('.archive #menu-1-9732115 li.menu-item-has-children a').next('ul').attr('aria-labelledby', 'sm-16890003406237656-2')    ; 
            
             jQuery('.archive #menu-1-9732115 li.menu-item-has-children a').next('ul').attr('aria-hidden', 'true')    ;
            jQuery('.archive #menu-1-9732115 li.menu-item-has-children a').next('ul').attr('aria-expanded', 'false')    ;
            
            
		jQuery(".archive #menu-1-9732115 li.menu-item-has-children a").hover(function(){


            jQuery(this).next('ul').attr('aria-hidden', 'false')    ;
            jQuery(this).next('ul').attr('aria-expanded', 'true')    ;
            
                jQuery( this ).next('ul').css({
                
                    "width": "auto",
                    "display": "block",
                    "top": "auto",
                    "left": "0",
                    "margin-left": "0",
                    "margin-top": "0",
                    "min-width": "10em",
                    "max-width": "1000px",
                    "z-index" : 3
                });
            
            
            
			jQuery(this).next('ul').addClass("showSubMenu");
			jQuery(this).addClass("highlighted");
   console.log("WooCommerce Page")
		}, function(){

			jQuery(this).removeClass("highlighted");
			jQuery(this).next('ul').removeClass("showSubMenu");
			jQuery(this).next('ul').hide(10000)
			 jQuery(this).next('ul').attr('aria-hidden', 'true')    ;
            jQuery(this).next('ul').attr('aria-expanded', 'false')    ;
            
             jQuery( this ).next('ul').css({
                
                    "width": "auto",

                    "top": "auto",
                    "left": "0",
                    "margin-left": "0",
                    "margin-top": "0",
                    "min-width": "10em",
                    "max-width": "1000px"
                });
		});
		
		*/

        console.log("Archive Page ready!");
        let parentid = jQuery(".archivepage").data('parentid');
        
        console.log(" Parent ID "+ parentid);
        const  ajaxlink = '<?php echo home_url(); ?>/wp-admin/admin-ajax.php'; 

		jQuery.post({  
					
						type: 'POST',  
						url: ajaxlink+'?action=fetch_child_categories',  
						data: 'parentid='+parentid,  
						success: function(res) {  
							
							 
							console.log(res); 
							jQuery('#block-5').empty()
							jQuery('#block-5').append(res)
							 
            
            
        } 
    });
	
	
});

 
</script>

<style>
/*Style for Product Archive Page*/
.showSubMenu {
    width: auto;
    display: block;
    top: auto;
    left: 0px;
    margin-left: 0px;
    margin-top: 0px;
    min-width: 10em;
    max-width: 1000px;
	z-index: 4;
}
</style>

<?php
	}

    if(   is_checkout() ){
		
		$siteurl = home_url();
        ?>
    
    <script>
       jQuery(document).ready(function() {


        //  jQuery(".add-links-wrap .add-links a.button").text("Request for Sample");

		const url =	jQuery(location).attr('href');
		const reportid = localStorage.getItem("imran_reportid");
		
		
		if(reportid){
				const urlready= 	url+reportid;
				history.pushState(null, "", urlready); 
 
		}
		
		else{
		
		//			jQuery(location).attr('href', '<?php echo $siteurl; ?>')
		
				const urlready= 	url+'5555';
				history.pushState(null, "", urlready); 
 
		
		}
		
		
       });
</script>
        <?php
    }
    ?>
	
	<?php if(is_product()){?>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js" defer></script> -->
 <script src="<?php echo get_stylesheet_directory_uri() ;?>/js/jspdf.js" defer></script>
<?php } ?>