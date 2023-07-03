(function($) {


	// ----------------------------------------------------------------------
	// Script for quote estimator add image UI
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// Define our variables
	// ----------------------------------------------------------------------

	// Upload image UI wrapper, used for appending our cloned ui elements to
	var imageUploadWrapper = $('.image-uploader-wrapper');

	// Upload image ui template, we'll be using this later
	var imageUploadUi = $('.image-upload-ui-wrapper').clone(false);

	// Maximum image count allowed
	var maxImageCount = 1;

	// Current image count
	var currentImageCount = 1;

	// Add image ui button
	var addUploadUiButton = $('.add-extra-img');

	// Define max image upload size
	var maxImageUploadSize = 3.0;
	
	// Capture Upload Image text
	var uploadImageText = $('.label-text').text();
	

	// ----------------------------------------------------------------------
	// Function to append our image upload UI conent to a defined dom element
	// ----------------------------------------------------------------------
	var addImageUploadUI = function( wrapper, element ) {


		// Append our image upload UI to our defined wrapper and fade in
		wrapper.append( element.clone(false).fadeIn( 500 ) );

		// Increase our currentImageCount
		updateImageCount( true );	

		// If maxImageCount has been reached hide "add-extra-img" button
		if( checkImageCount() ) {

			addUploadUiButton.hide();	

		}

	} 

	// ----------------------------------------------------------------------
	// Function to update our image imput UI
	// ----------------------------------------------------------------------
	var showFileName = function( inputLabel, inputElement, removeImageUi, imageAddedClass ) {

		// Get the associated input label, we'll need this later
		var inputLabel = inputLabel;

		// Get the filename of the image
		var filename = inputElement.val().split('\\').pop();

		// Get the remove image button UI element
		var removeImageUi = removeImageUi;

		// Update class of "image-upload-label" 
		inputLabel.addClass(imageAddedClass);

		// Replace the label text with the filename
		inputLabel.find('.label-text').text(filename);

		// If has error remove error class from outer wrapper
		inputLabel.closest('.image-upload-ui-wrapper').removeClass('error')

		// Show the remove image button UI
		removeImageUi.fadeIn( 500 );

	} 

/*
		// ----------------------------------------------------------------------
		// Function to remove our image upload UI element
		// ----------------------------------------------------------------------
		var removeImageUploadUI = function(element) {
	
			// Fade out our UI element and on complete callback remove from dom
			element.fadeOut( 500, function(){
	
				// remove the element from the DOM
				element.remove();
	
			});
	
			// Decrease our currentImageCount
			updateImageCount( false );	
	
			// If maxImageCount has not been reached show "add-extra-img" button
			if( !checkImageCount() ) {
	
				addUploadUiButton.show();	
	
			}
	
		} 
*/

		// ----------------------------------------------------------------------
		// Function to remove our image upload UI element
		// ----------------------------------------------------------------------
		var removeImageUploadUI = function(element) {
			
			window.console.log('remove image clicked');
	
			// .removeClass of image-added //
			element.find('.image-upload-label').removeClass('image-added');
			
			// change text of upload image button - .text() //
			element.find('.label-text').text(uploadImageText);
		
			// .hide/.fade remove image button //
			element.find('.remove-image').fadeOut( 500 );
			
			// remove input value
			element.find('.image-upload-input').val('');
	
			// Decrease our currentImageCount
			updateImageCount( false );	
	
			// If maxImageCount has not been reached show "add-extra-img" button
			if( !checkImageCount() ) {
	
				addUploadUiButton.show();	
	
			}
	
		}
		
	// ----------------------------------------------------------------------
	// Function to increase or decrease our image count by 1 (true or false)
	// ----------------------------------------------------------------------
	var updateImageCount = function(increment) {

		if( increment ) {

			currentImageCount ++;

		} else {

			currentImageCount --;

		}

	}

	// ----------------------------------------------------------------------
	// Function to check if our max image count has been reached
	// ----------------------------------------------------------------------
	var checkImageCount = function() {

		// If current image count is greater than max image count return true, else return false
		if( currentImageCount >= maxImageCount ) {

			return true;

		} else {

			return false;
		}

	}

	// ----------------------------------------------------------------------
	// Function to get file size, returns number rounded to 2 decimal places
	// ----------------------------------------------------------------------
	var getImageSize = function(file) {

		// Get the file size
		var fileSize = file.files[0].size/1024/1024;

		// Round to 2 decimal places
		var fileSize = Math.round( fileSize *100 ) / 100;

		// Return the file size
		return fileSize;

	}

	// ----------------------------------------------------------------------
	// Function to check max file size limit is not exceeded on image 
	// ----------------------------------------------------------------------
	var checkImageSizeLimit = function(filesize, maxfilesize) {

		// Return true if file size is okay
		if( filesize < maxfilesize ) {

			return true;

		} 
		// Return false if file size is exceeded
		else {

			return false;

		}

	}

	// ----------------------------------------------------------------------
	/* 
	Onclick of "add image" button call our addImageUploadUI function only if 
	Image UI count is less than 4
	*/
	// ----------------------------------------------------------------------
	addUploadUiButton.click(function(event){

		// Prevent default
		event.preventDefault();

		// Run our addImageUploadUI function
		addImageUploadUI( imageUploadWrapper, imageUploadUi );

	});


	// ----------------------------------------------------------------------
	/* 
	Onclick of "remove image" button call our addImageUploadUI function only if 
	Image UI count is less than 4
	*/
	// ----------------------------------------------------------------------
	imageUploadWrapper.on('click', '.remove-image', function(event){

		// Prevent default
		event.preventDefault();

		// Get the parent element of the clicked button, we'll remove this from the DOM
		var uiElement = $(this).closest('.image-upload-ui-wrapper');

		// Run our addImageUploadUI function
		removeImageUploadUI( uiElement );

	});


	// ----------------------------------------------------------------------
	/* 
	Onclick of "upload image" button check the file size, if this does not
	exceed the max file size change button class and replace label text with
	file name
	*/
	// ----------------------------------------------------------------------
	imageUploadWrapper.on( 'change', '.image-upload-input', function(){

		// Get the file size
		var fileSize = getImageSize( this );

		// Check image file size is with given limits, if true update the UI
		if( checkImageSizeLimit( fileSize, maxImageUploadSize ) ) {

			window.console.log( 'file size okay' );

			// Get the outer "image-upload-ui-wrapper"
			// var parentWrapper = $(this).closest('.image-upload-ui-wrapper');

			// Get the input label element
			var inputLabel = $(this).parent('.image-upload-label');

			// Get the input element
			var inputElement = $(this);

			// Get the remove image button UI element
			var removeImageUi = $(this).closest('.image-upload-ui-wrapper').find('.remove-image');

			//Call our function to Update the image upload UI with the file name
			showFileName( inputLabel, inputElement, removeImageUi, 'image-added' );
			

		} else {

			window.console.log( 'file size too large' );

			// Add error class to our "image-upload-ui-wrapper"
			$(this).closest('.image-upload-ui-wrapper').addClass('error');

			// Update the label text
			$(this).parent('.image-upload-label').find('.label-text').text('Error - click to retry');

		}

	});

})(jQuery);
