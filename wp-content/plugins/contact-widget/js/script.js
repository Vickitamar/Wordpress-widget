jQuery(document).ready(function() {
	//get form
	var form = jQuery('#ajax-contact');

	//messages
	var formMessages = jQuery('#form-messages');

	//form event handler
	jQuery(form).submit(function(event) {
		//stop browser from submitting the form
		event.preventDefault();
		console.log('contact form submitted');
		//serialize data
		var formData = jQuery(form).serialize();

		//submit with Ajax
		jQuery.ajax({
			type: 'POST',
			url: jQuery(form).attr('action'),
			data: formData
		}).done(function(response){
			//make sure message is success
			jQuery(formMessages).removeClass('error');
			jQuery(formMessages).addClass('success');

			//set message tect
			jQuery(formMessages).text(response);

			//clear form fields
			jQuery('#name').val('');
			jQuery('#email').val('');
			jQuery('#message').val('');

		}).fail(function(data){
			//make sure message is error
			jQuery(formMessages).removeClass('success');
			jQuery(formMessages).addClass('error');

			//set message text
			if(data.responseText !== '') {
				jQuery(formMessages).text(data.reponseText);
			} else {
				jQuery(formMessages).text('An error occured');
			}
		});

	});
});