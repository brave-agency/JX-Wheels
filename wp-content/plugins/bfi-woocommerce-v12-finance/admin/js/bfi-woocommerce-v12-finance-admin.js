jQuery(function ($) {
	$(".bfi_min_value").change(function(){ 
		var min_value = $(this).val();
		if(min_value <= 250){
			$(this).val('250.00');	
			alert('The Minimum Value can not be less the 250.00');
		}
	
	});
});