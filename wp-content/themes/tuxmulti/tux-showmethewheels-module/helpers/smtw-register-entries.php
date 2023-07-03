<?php

// Functions to register our competition entries

// Initiate our MailChimp Class, we'll need this to submit our form data to MailChimp using the API
use \DrewM\MailChimp\MailChimp;

// ----------------------------------------------------------------------------------------------
// Main logic wrapper - accepts incoming AJAX data and fires nessesary functions to process data
// ----------------------------------------------------------------------------------------------
function smtw_ajax_request() {

	// Check we've received our form data and the nonce is okay
	if ( isset($_POST) && isset($_FILES) && !empty($_FILES) ) :

		// Define our MailChimp API key
		$mc_api_key = get_field( 'smtw_mc_api_key', 'options' );

		// Define our MailChimp list ID - we'll be sumitting form data to this later see function "add_smtw_entry_to_mailchimp"
		$smtw_mc_list_id = get_field( 'smtw_mc_list_id', 'options' );

		// Check our security nonce, return error message and die if verification failed, else continue on
		if( wp_verify_nonce( $_POST['smtw_nonce'], 'smtw_form_action' ) ) :

			// ----------------------------------------------
			// Data validation
			// ----------------------------------------------

				// Validate form data (minus images). Will return array of form data if successfull, else returns false on error
				$validated_form_data = validate_smtw_form( $_POST );

				// Validate image data. Will return array of image data if successfull, else return false on error
				$validated_form_images = validate_smtw_form_images( $_FILES['smtwimage'] );

			// Form failed to validate
			if( !$validated_form_data || !$validated_form_images ) :

				// Build our error message
				$response = array(
					'status' => 'error', 
					'server_message' => 'Sorry, the information you\'ve given us is not quite right, please check that you have completed all required fields marked with an Asterix and try again.',
				);

				// Return our response message and exit
				echo json_encode($response);
				die(); // Bounce

			// Form validated okay
			else :

				// ----------------------------------------------
				// Post creation
				// ----------------------------------------------

					// Define our post args for creation of new post
					$smtw_postargs = array(
						'post_title' => 'SMTW Entry - '.$validated_form_data['smtwemail'],
						'post_status' => 'publish',
						'post_type' => 'showmethewheels',
					);

					// Create the new post, save result to variable - returns post ID if successfull, false on failure
					$smtw_new_post_id = wp_insert_post( $smtw_postargs );

				// ----------------------------------------------	
				// Add image to WP media library
				// ----------------------------------------------

					// Call function to save image to WP media library = returns image attachement ID
					$image_attachement_id = add_image_to_media_library( $_FILES, $smtw_new_post_id );

				// ----------------------------------------------	
				// Add our data to our new post ACF fields
				// ----------------------------------------------

					// Define our post meta data (ACF field key => data)
					$smtw_post_meta_data = array(
						'field_5787b51f5c20e' => $validated_form_data['smtwfirstname'], // First name
						'field_57890ef150418' => $validated_form_data['smtwlastname'], // Last name
						'field_57890f0a50419' => $validated_form_data['smtwfacebookid'], // Facebook ID
						'field_57890f315041a' => $validated_form_data['smtwemail'], //Email address
						'field_57890d4f50417' => $image_attachement_id // Image attachment ID
					);

					// Itterate over each 'smtw_post_meta_data' saving data to ACF field
					foreach ($smtw_post_meta_data as $key => $value) :

						update_field( $key, $value, $smtw_new_post_id );

					endforeach; // End adding saving our data to ACF

				// ----------------------------------------------
				// Create MailChimp entry
				// ----------------------------------------------

					// Add data to mailchimp
					$smtw_mailchimp_data = add_smtw_entry_to_mailchimp( $validated_form_data, $mc_api_key, $smtw_mc_list_id );


				// Build our success message
				$response = array(
					'status' => 'success', 
					'server_message' => 'Form validated okay'
 				);

				// Return our response message and exit
				echo json_encode($response);
				die(); // Bounce

			endif; // End conditional check for form validation

		// Nonce validation failed	
		else :

			// Build our error message
			$response = array(
				'status' => 'error', 
				'server_message' => 'Oh no, this is a little embarrassing as there was a problem submitting your entry. Would you mind trying again later?',
			);

			// Return our response message and exit
			echo json_encode($response);
			die(); // Bounce

		endif; // End validation check of security nonce

	
	// Error recieving form data	
	else:

		// Build our error message
		$response = array(
			'status' => 'error', 
			'server_message' => 'Oh no, this is a little embarrassing as there was a problem submitting your entry. Would you mind trying again later?',
		);

		// Return our response message and exit
		echo json_encode($response);
		die(); // Bounce


	endif; // End conditional check we've received our form data

	die(); // Let's get out of here!

} // End function ajax_request

// Register this function so we can call it via AJAX
add_action( 'wp_ajax_smtw_ajax_request', 'smtw_ajax_request' );
add_action( 'wp_ajax_nopriv_smtw_ajax_request', 'smtw_ajax_request' );

// ----------------------------------------------------------------------------------------------
// Validate and sanitize form data function
// ----------------------------------------------------------------------------------------------
function validate_smtw_form( $form_data ) {

	// Define our required data
	$required_fields = array(
		'smtwfirstname',
		'smtwlastname',
		'smtwfacebookid',
		'smtwemail',		
	);

	// Sanitize our data into a new array and test against required keys to see if value is empty

		// Create the array to store sanitized form data
		$sanitized_form_data = array();

		// Loop through each form data element and sanitize
		foreach ( $form_data as $key => $value) :
			
			$sanitized_form_data[ $key ] = sanitize_text_field($value);

			// Check if data is required and not empty
			if( ( in_array( $key, $required_fields ) && empty($value) ) ) :

				return false;

				// Break and return error
				break;

			endif; // End condtional check for required data

		endforeach; // End sanatizing data

	// Check if opt into marketing is in array, update to boolean depending on result
	if( array_key_exists( 'smtwacceptmarketing', $form_data ) ) :

		$sanitized_form_data['smtwacceptmarketing'] = 'subscribed';

	else :

		$sanitized_form_data['smtwacceptmarketing'] = 'unsubscribed';

	endif; // End conditional check for competition answer

	// Our form has validated successfully, now return sanitized form data
	return $sanitized_form_data;


} // End function validate competition form


// ----------------------------------------------------------------------------------------------
// Validate and sanitize form data function
// ----------------------------------------------------------------------------------------------
function validate_smtw_form_images( $form_images ) {


	// If error return false, else return true
	foreach ($form_images as $key => $value) {

	
		switch ($key) {

			// Empty or error
			case ($key == 'error' && $value > 0):
				return false;
				break;

			// Max file size (3mb)
			case ($key == 'size' && $value > 3000000):
				return false;
				break;

			// Mime Type (uses "wp_check_filetype_and_ext" which returns array of data including "type")
			case ($key == 'tmp_name' && wp_check_filetype_and_ext( $_FILES['smtwimage']['tmp_name'],$_FILES['smtwimage']['name'])['type'] != 'image/jpeg'):
				return false;
				break;
		}

	}

	// No errors, return true
	return true;

}

// ----------------------------------------------------------------------------------------------
// Add images to WP media library, if no post ID set will not associate with parent post
// ----------------------------------------------------------------------------------------------
function add_image_to_media_library($images, $post_id = 0) {

	// Require our dependencies
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

	// Let WordPress handle the upload
	$attachment_id = media_handle_upload( 'smtwimage', $post_id );

	// Check for errors
	if ( is_wp_error( $attachment_id ) ) :

		return 'Media library saving error';

	else :

		return $attachment_id;

	endif; // End conditional check for errors

}

// ----------------------------------------------------------------------------------------------
// Add entry details to Mailchimp
// ----------------------------------------------------------------------------------------------

function add_smtw_entry_to_mailchimp( $data, $mc_api_key, $mc_list_id ) {


	// Create a new instance of the class
	$MailChimp = new MailChimp( $mc_api_key );

	// Create a new entry and save result to var for debugging
	$result = $MailChimp->post("lists/$mc_list_id/members", [
        'email_address' 	=> $data['smtwemail'],
        'status'        	=> $data['smtwacceptmarketing'],
        'merge_fields'		=> [ 
        	'FNAME' 		=> $data['smtwfirstname'],
        	'LNAME' 		=> $data['smtwlastname'],
        ], 
    ]);

	return $result;

}
