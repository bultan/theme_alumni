
jQuery(document).ready(function($){
	$("#wpadminbar").appendTo('.site-branding').insertAfter('.logo');

	 $('#bps_shortcode72 select :first').text('Select Year');
	 $('#bps_shortcode76 select :first').text('Select Country');

	 $('#bps_shortcode167 #field_89 :first').text('Select Year');
	 $('#bps_shortcode167 select :first').text('Select Country');

	$('#bps_shortcode72 input[type=submit]').click(function(){
		var year = $('#bps_shortcode72 select :selected').val();
		if(year == ''){
			alert('Please Select Year');
			return false;
		}
		else {
			return true;
		}
		
	});

	$('#bps_shortcode76 input[type=submit]').click(function(){
		var country = $('#bps_shortcode76 select :selected').val();
		if(country == ''){
			alert('Please Select Country');
			return false;
		}
		else {
			return true;
		}
		
	});

});