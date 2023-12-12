<script>

jQuery( document ).ready(function() {
  
 jQuery('.buynowbtn').on('click', function (e) { 
		
		e.preventDefault;
	  	
        var license_type = jQuery('.license_type').val();
        var currencySymbol = jQuery('.currencySymbol').val();
        var reportprice = jQuery('.report-price').val();
        var reportid = jQuery('.report-id').val();
        var reporttitle = jQuery('.report-title').val();
	  
		console.log( "license type  " + license_type + "   currency Symbol   " + currencySymbol + "   report price  " + reportprice + "   report id  " + reportid + "  report title  " + reporttitle );
	  
		 jQuery.ajax({
         type : "post",
         dataType : "json",
         url : ijAjax.ajaxurl,
         data : {action: "wdm_add_user_custom_data_options_callback", license_type : license_type, currencySymbol: currencySymbol , reportprice : reportprice , reportid : reportid, reporttitle: reporttitle},
		//console.log(data)
	   success: function(response) {
            if(response.type == "success") {
              // jQuery("#vote_counter").html(response.vote_count)
            console.log("Success")
			}
            else {
               alert("Failed")
            }
         }
      }) 
	  })
});
</script>