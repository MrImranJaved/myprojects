<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />

	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php get_template_part( 'head' ); ?>
	<?php
$schema = get_post_meta(get_the_ID(), 'schema', true);
if(!empty($schema)) {
	echo $schema;
}
?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/62d2d7f5b0d10b6f3e7ca76b/1g83pn6ml';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>

<!--End of Tawk.to Script-->


</head>
<body  id="<?php echo get_the_ID(); ?>" <?php body_class(); ?>>
<?php get_template_part( 'header/header_before' ); 
	
 				global $post;
		    if ( $post->ID == 994 || 11386  ){ 
                //print_r($_REQUEST);
                $reportid = isset($_REQUEST['reportid'])?$_REQUEST['reportid'] :'';
                if($reportid){
					update_report_meta_on_download_report_sample($reportid);
                }
				?> 
				

				<?php
			} 
		
?>