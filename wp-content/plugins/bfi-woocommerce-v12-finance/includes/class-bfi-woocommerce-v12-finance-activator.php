<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/includes
 * @author     BFI <info@wearebfi.co.uk>
 */
class BFI_Woocommerce_V12_Finance_Activator {
	/**
	 * Activate Plugin.
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

		// create the database table(s)
		if ( $wpdb->get_var("show tables like '" . $wpdb->prefix . BFI_WC_V12_TABLE . "'") != $wpdb->prefix . BFI_WC_V12_TABLE )  {
			$sql = "CREATE TABLE " . $wpdb->prefix . BFI_WC_V12_TABLE . " (
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
				`apr` DECIMAL(10,4) UNSIGNED NOT NULL COMMENT 'APR',
				`calculation_factor` DECIMAL(10,6) UNSIGNED NOT NULL COMMENT 'Calculation Factor',
				`deferred_period` INT UNSIGNED NOT NULL COMMENT 'Deferred Period',
				`description` TEXT NOT NULL COMMENT 'Description',
				`document_fee` INT UNSIGNED NOT NULL COMMENT 'Document Fee',
				`document_fee_collection_month` INT UNSIGNED NOT NULL COMMENT 'Document Fee Collection Month',
				`document_fee_maximum` INT UNSIGNED NOT NULL COMMENT 'Document Fee Maximum',
				`document_fee_minimum` INT UNSIGNED NOT NULL COMMENT 'Document Fee Minimum',
				`document_fee_percentage` DECIMAL UNSIGNED NOT NULL COMMENT 'Document Fee Percentage',
				`max_loan` DECIMAL(10,4) UNSIGNED NOT NULL COMMENT 'Max Loan',
				`min_loan` DECIMAL(10,4) UNSIGNED NOT NULL COMMENT 'Min Loan',
				`monthly_rate` DECIMAL(10,4) UNSIGNED NOT NULL COMMENT 'Monthly Rate',
				`months` INT UNSIGNED NOT NULL COMMENT 'Months',
				`name` VARCHAR(255) NOT NULL COMMENT 'Name',
				`option_period` INT UNSIGNED NOT NULL COMMENT 'Option Period',
				`product_guid` VARCHAR(130) NOT NULL COMMENT 'Product Guid',
				`product_id` INT UNSIGNED NOT NULL COMMENT 'Product Id',
				`service_fee` DECIMAL(10,4) UNSIGNED NOT NULL COMMENT 'Service Fee',
				`settlement_fee` DECIMAL(10,4) UNSIGNED NOT NULL COMMENT 'Settlement Fee',
				`tag` VARCHAR(255) NOT NULL COMMENT 'Tag',
				`alt_tag` VARCHAR(255) NOT NULL COMMENT 'Alt Tag',
				`state` TINYINT(1) UNSIGNED NOT NULL COMMENT 'Active State' DEFAULT 1,
				`is_enabled` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Is Enabled in WC',
				`wc_min_loan` decimal(10,2) unsigned NOT NULL COMMENT 'User set - Min Loan Value',
				`wc_max_loan` decimal(10,2) unsigned NOT NULL COMMENT 'User set - Max Loan Value',
				`wc_min_discount` decimal(10,2) unsigned NOT NULL COMMENT 'User set - Min Discount on products',
				`wc_max_discount` decimal(10,2) unsigned NOT NULL COMMENT 'User set - Max Discount on products',
				PRIMARY KEY (`id`),
				UNIQUE KEY `UNQ_product_id` (`product_id`)
			);";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}

		// Run plugin to create product import cronjob
		$plugin = new BFI_Woocommerce_V12_Finance();
		$plugin->run();
		wp_schedule_event( time(), 'daily', 'bfi_v12_import_products' );
		wp_schedule_event( time(), 'daily', 'bfi_v12_check_status' );
	}


}
