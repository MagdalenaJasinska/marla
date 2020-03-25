jQuery( function() {
	jQuery(document).ajaxStart(function(){
	    if(jQuery( document.activeElement ).hasClass('btn-contact-submission')){
			jQuery('.contact-form-content .ajax-loader').attr({style: 'display: inline-block !important;'});
		}
	});
	jQuery(document).ajaxComplete(function(){
	    if(jQuery( document.activeElement ).hasClass('btn-contact-submission')){
			jQuery('.contact-form-content .ajax-loader').attr({style: 'display: none !important;'});
		}
	});

	if(jQuery( ".advent-dates" ).length > 0){
		jQuery( ".advent-dates" ).datepicker({minDate: new Date(), gotoCurrent: true});
	}
});