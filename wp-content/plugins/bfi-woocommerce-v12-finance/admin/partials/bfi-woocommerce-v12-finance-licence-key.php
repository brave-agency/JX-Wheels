<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.6
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>


<div class="wrap">
	<h2>V12 Retail Finance</h2>
	<h3>Licence Key</h3>
	<div id="welcome-panel" class="welcome-panel">
		<div class="welcome-panel-content">

			<?php if ( ! empty($error) ): ?>
			<div class="notice notice-error is-dismissible">
				<p><?php echo $error; ?></p>
			</div>
			<?php endif; ?>
			<?php if ( ! empty($message) ): ?>
			<div class="notice notice-success is-dismissible">
				<p><?php echo $message; ?></p>
			</div>
			<?php endif; ?>

			<?php if ($is_activated == true): ?>
				<p>Your licence is activated, please keep a record of these details.</p>
				<ul>
					<li>V12 Plugin Order E-mail Address: <?php echo $v12_order_email; ?></li>
					<li>V12 Plugin Licence Key: <?php echo $v12_licence_key; ?></li>
				</ul>
				<form method="post">
					<input type="submit" value="Deactivate Licence" name="submit" />
				</form>
			<?php else: ?>
				<p>To activate your licence, please enter the e-mail address and licence key from your order e-mail.</p>
				<form method="post">
					<fieldset style="border: 1px solid silver; padding: 20px; display: inline-block;">
						<label for="v12_order_email">V12 Plugin Order E-mail Address:</label>
						<input type="text" value="<?php if (isset($_POST['v12_order_email'])) { echo htmlspecialchars($_POST['v12_order_email']) ; } else { echo $v12_order_email; }  ?>" name="v12_order_email" id="v12_order_email">
						<br>
						<label for="v12_licence_key">V12 Plugin Licence Key:</label>
						<input type="text" value="<?php if (isset($_POST['v12_licence_key'])) { echo htmlspecialchars($_POST['v12_licence_key']) ; } else { echo $v12_licence_key; }  ?>" name="v12_licence_key" id="v12_licence_key">
						<br>
						<input type="submit" value="Save and Activate" name="submit" />
					</fieldset>
				</form>
				<p>If you have any problems activating this licence, please contact <a href="https://www.wearebfi.co.uk/">BFI</a>.</p>
			<?php endif; ?>

		</div>
		<p>&nbsp;</p>
	</div>

</div>