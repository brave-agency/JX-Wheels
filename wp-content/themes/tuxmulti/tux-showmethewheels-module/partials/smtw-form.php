<form id="smtw-entry-form" action="/" method="post" enctype="multipart/form-data">
	
	<!-- Personal details -->
	<div class="form-section">

		<div class="form-wrapper">
			<!-- Input (full name) -->
			<div class="form-group">
				<label class="control-label required" for="smtwfirstname">First name:</label>
				<input type="text" name="smtwfirstname" class="form-control" id="smtwfirstname" placeholder="Enter First Name*">
				<span class="help-block"></span>
			</div>

			<!-- Input (full name) -->
			<div class="form-group">
				<label class="control-label required" for="smtwlastname">Last name:</label>
				<input type="text" name="smtwlastname" class="form-control" id="smtwlastname" placeholder="Enter Surname*">
				<span class="help-block"></span>
			</div>
			
			<!-- Input (facebook ID) -->
			<div class="form-group">
				<label class="control-label" for="smtwlastname">Facebook ID:</label>
				<input type="text" name="smtwfacebookid" class="form-control" id="smtwfacebookid" placeholder="Enter Facebook ID*">
				<span class="help-block"></span>
			</div>

			<!-- Input (Email address) -->
			<div class="form-group">
				<label class="control-label required" for="smtwemail">Email address:</label>
				<input type="text" name="smtwemail" class="form-control" id="smtwemail" placeholder="Email address*">
				<span class="help-block"></span>
			</div>
		</div>
		
		<!-- Input (Image Upload) -->
		<div class="form-group">
			<section class="content-section" id="image-uploader">
				
				<div class="image-uploader-wrapper">
					
					<!-- Our UI template, used for jQuery to append more upload UI's on click of "add image" button -->
					<div class="image-upload-ui-wrapper">
						
						<div class="error-message"><small>Image file size too large. Images are limited to 3mb in size</small></div>
		
						<div class="image-upload-ui-left">
							<div class="image-upload-input-wrapper">
		
								<label class="image-upload-label"><span class="label-text">Upload Image</span>
									<input type="file" name="smtwimage" accept="image/jpeg" class="image-upload-input">
								</label>
		
							</div><!-- End image-upload-input-wrapper -->
						</div><!-- End image-upload-left -->
		
						<div class="image-upload-ui-right">
							<button class="remove-image"><span>Remove image</span></button>
						</div><!-- End image-upload-ui-right -->
						
					</div><!-- End image-upload-wrapper -->

				</div>

				<div class="image-upload-messages">
					<small>Image file type should be JPG.<br>Maximum size is limited to 3mb.</small>
				</div>
				
			</section>						
		</div>
		
		<div class="form-group honeypot hidden" style="display: none!important;">
			<label class="control-label required" for="cfhoneypottest">Your age:</label>
			<input type="text" name="cfhoneypottest" class="form-control" id="honeypottest" placeholder="Leave blank - spam test!">
		</div>
		
		
	</div><!-- End personal details -->

		<?php
			wp_nonce_field('smtw_form_action', 'smtw_nonce', true, true); 
		?>	
	
	<!-- Show Me The Wheels submission area -->
	<div class="form-section">

		<!-- Form submit -->
		<div class="smtw-submit-wrapper">

			<!-- Competition terms -->
			<div class="competition-terms">
				<p>By registering and entering you agree to the <a href="#" data-toggle="modal" data-target="#privacy-policy-modal">terms and conditions</a> of the privacy statement that govern how your information will be processed. You also consent to TUX Auto, its sponsors and its clients sending you information by post, telephone, email and SMS, about products and/or services that may be of interest to you. You also agree to the terms and conditions of the privacy statement that govern how your information will be processed.</p>
			</div><!-- End competition terms -->

			<!-- Opt in or out of marketing -->
			<div class="marketing-prefs">
				<label>
					<input type="checkbox" name="smtwacceptmarketing">
					I'm happy for you to contact me with regards to marketing
				</label>
			</div><!-- End checkbox -->

			<div class="g-recaptcha-error"></div>
			
			<script>
			grecaptcha.ready(function() {
				grecaptcha.execute('6LfklYMUAAAAANm4FUzUrRCj3T0JWjHD--Y_y16x', {action: 'action_name'})
				.then(function(token) {
				// Verify the token on the server.
				});
			});
			</script>
		
			<button id="smtw-submit" type="submit" name="smtw-submitted" class="site-button">Submit Wheels</button>

		</div><!-- End competition-submit-wrapper -->
	</div><!-- End competition submission area -->

</form><!-- End competition entry form -->