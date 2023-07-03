(function($) {

    // ENABLE OR DISABLE DEBUGGING
    var smtwDebug = false; 
	
	// Form AJAX processor
    // --------------------------------------------------
    
    var send_smtw_form_ajax = function( form ) {

        // Capture the button text, we'll be modifying this so need its value to return to original state if form fails
        var submit_btn_value = $('#smtw-submit').text();

        // Save the dom element of our server messages for later use
        var server_messages_container = $('#server-messages');

        // Get our form data
        var form_data = new FormData( $(form)[0] );

        // Add our form action (the PHP function to prcess our form data)
        form_data.append('action', 'smtw_ajax_request' );

        // Submit the form via AJAX
        $.ajax({
            type: 'post',
            url: tux_smtw_ajax_data.ajax_url,
            dataType: 'json',
            data: form_data,
            contentType:false,
            processData:false,
            beforeSend: function() {

                server_messages_container.hide();

                // Find our submit button and add ".submitting class"
                $('#smtw-submit').addClass('submitting');

                // Update text to read "submitting"
                $('#smtw-submit').text('Submitting - can take upto 60 seconds');

            },

            success: function( response ) { 

                // Form submitted
                if( response.status == 'success' ) {

                    // Debugging
                    if(smtwDebug) {
	                
	                   window.console.log('success ' + JSON.stringify(response));

                    }

                    // Update the UI to inform user form was submitted

                        // Fade out the form and intructions, then remove from dom and fade in the feedback message
                        $('#smtw-entry-form').fadeOut(1000, function(){

                            // Remove the smtw rentry section from the DOM
                            $(this).remove();

                            // Show the smtw feedback message
                            $('.smtw-submit-feedback').fadeIn(1000);

                        });

                    // Reset the form
                    $(form).trigger("reset");

                }  

                // Form failed to submit
                else if ( response.status == 'error' ) {

                    // Debugging
                    if(smtwDebug) {
	                
	                   window.console.log('validation error ' + JSON.stringify(response) );

                    }

                    //Show the server messages block and insert error text
                    server_messages_container.find('.alert-message-body').text(response.server_message);
                    server_messages_container.show();

                    // Scroll to the server message (if off viewport) - we reduce this by 300 to accomodate for the sticky nav
                    $('html, body').animate({
                        scrollTop: $("#server-messages").offset().top-300
                    }, 1000);

                }  

            },

            error: function( response ) {

                // Debugging
                if(smtwDebug) {
	            
	               window.console.log('AJAX error ' + JSON.stringify(response) );

                }

                 //Show the server messages block and insert error text
                server_messages_container.find('.alert-message-body').text('Oh no, this is a little embarrassing as there was a problem submitting your entry. Would you mind trying again later?');
                server_messages_container.show();

                // Scroll to the server message (if off viewport) - we reduce this by 300 to accomodate for the sticky nav
                $('html, body').animate({
                    scrollTop: $("#server-messages").offset().top-300
                }, 1000);


            },

            complete: function( response ) {

                // Debugging
                if(smtwDebug) {
	            
	               window.console.log('complete ' + JSON.stringify(response));

                }

                // Find our submit button and remove ".submitting class"
                $('#smtw-submit').removeClass('submitting');

                // Update text to read "Submit Your Entry"
                $('#smtw-submit').text(submit_btn_value);

            }
        });

    } // End "send_smtw_form_ajax" function

	// --------------------------------------------------
	// Scripts for our smtw page
	// ------
	// Form validation
	// --------------------------------------------------
    $('#smtw-entry-form').validate({

        // Set the validate rules
        rules: {

            smtwfirstname: {
                required: true,
            },
            smtwlastname: {
                required: true,
            },
            smtwfacebookid: {
                required: true,
            },
            smtwemail: {
                required: true,
                email: true,
            },

        },

        // Define the error messages to be displayed
        messages: {
            smtwfirstname: {
            	required: "Please enter your first name",
            },
            smtwlastname: {
            	required: "Please enter your last name",
            },
            smtwfacebookid: {
                required: "Please enter your Facebook ID"
            },
            smtwemail: {
                required: "Please enter your email address",
                email: "Incorrect format for email address",
            },
        },

        // Error highlight validation class and element placement
        highlight: function (element) {
            jQuery(element).closest('.form-group').addClass('has-error');
        },

        // Sucess highlight remove
        unhighlight: function (element) {
            jQuery(element).closest('.form-group').removeClass('has-error');
        },
        success: function (element) {
            jQuery(element).closest('.form-group').removeClass('has-error');
        },

        // DOM element to place error message
        errorPlacement: function (error, element) {
            element.closest('.form-group').find('.help-block').html(error.text());
        },

     // Form submission
        submitHandler: function(form) {

            // Check if honeypot is empty if true fire FB share
            if( jQuery('#honeypottest').val().length === 0 ) {  
                        
                // Submit the form
                send_smtw_form_ajax(form);        
    
            } // End conditional check for honeypot spam test

        } // End submitHandler

    }); // End form validation
			
})(jQuery);