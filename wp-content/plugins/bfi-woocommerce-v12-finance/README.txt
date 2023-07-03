=== Plugin Name ===
Contributors: wearebfi.co.uk
Donate link: http://www.wearebfi.co.uk/
Tags:
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License URI: http://www.wearebfi.co.uk/terms/

BFI integration for Woocommerce to V12 Finance Applications

== Description ==

This plugin handles the integration between Woocommerce and V12 Finance.


== Installation & setup ==

We recommend testing the V12 plugin on a non-live development environment, before deploying on a live site.

1. 	*** If you don?t already have one, you?ll need an approved V12 account so you can use the plug-in.***
	When applying for a new V12 account there may be an account set up fee, see v12retailfinance.com for contact details to apply. V12 work
	exclusively with ActSmart subscribers for the cycle and outdoor sectors (See Actsmart.biz to join), but ActSmart retailers do not have
	to pay a set up fee to V12 when applying for an account and have access to preferential rates.

2.	Make sure your WooCommerce plugin is active, and that your WooCommerce & WordPress installations are up to date.

3.	Once you've downloaded the BFI Woocommerce V12 Finance plugin ZIP, log in to your WordPress admin, go to Plugins > Add New > Upload plugin and upload the ZIP.
	Uploading via the admin ensures all file permissions are correctly set.

4.	In your WordPress admin, go to go to Plugins > All plugins and click "Check for updates" against the BFI Woocommerce V12 Finance plugin, and update to the
	latest version if necessary.

5. 	In your WordPress admin, go to WooCommerce > Settings > Checkout (tab) > V12 Retail Finance:

		a) Enter the licence key from your order email

		b) V12 will have given you some account details when you joined (usually in a spreadsheet). Enter these in the relevant admin fields, then click "Save changes":

			* Authentication Key
			* Retailer Guid
			* Retailer Id

		You'll have some test credentials to test with first. Remember to update these when you go live.

6. 	In the same V12 settings screen, click "Update Finance Products from V12" to retrive the available rates on your account via the V12 API.

		a) Review the rates you wish to enable, along with the Min/Max value & discounts.

		b) Review the remaining settings including the customer email messages that are iinserted into order emails, then activate the plugin (checkbox at the top) then "Save changes"


== Adding & styling the front-end elements ==

	a) Styling V12 checkout section to fit with your theme

		The general styling fits in with the existing WooCommerce checkout sections, so will fit with your theme well out-of-the-box.

		The font colour of the titles chan be changed to suit your theme with one rule:

		.payment_method_v12retailfinance .required {
    		color: #XXXXXX;
		}


	b) Adding "From ?x/month" to the *category* pages

		Please contact us for an additional free plugin if you'd like this feature.



	c) Adding "From ?x/month" to the *product* pages

		(Feature coming soon, for grouped, simple & variable product types)




	d) Adding the finance calculator to the product pages

		Please contact us for an additional free plugin if you'd like this feature.



== Preventing a finance rate from being offered on discounted products ==

	a) In your WordPress admin, go to WooCommerce > Settings > Checkout (tab) > V12 Retail Finance

	b) In the table of Finance products, use the min / max discount columns to set the allowed discount amount on a product
	to be eligable for the finance product.

	For example:
	For ALL products to be included (regardless of discounts), use:
	Min: 0 & Max 100

	To exclude discounted products entirely use (finance will only be available for items without a discount):
	Min: 0 & Max 0

	To include products that are discounted to half price, use:
	Min: 50 & Max 100


== Changelog ==

= 1.3.0 =
* Added option to stop finance when using a Coupon Code (default off)

= 1.2.0 =
* Upgraded PUC Updater

= 1.1.1 =
* Fixed finance to allow for different min / max values in products

= 1.1.0 =
* Fixed issue where order total was above finance amount
* Added filter: bfi_v12_checkout_finance_products - allowing changes to finance products in checkout

= 1.0.10 =
* Tweaks to e-mails and Readme

= 1.0.9 =
* Tweaks to e-mails / status list

= 1.0.8 =
* Corrected typo and removed un-used prepare statement

= 1.0.7 =
* Changed error message in basket

= 1.0.6 =
* Added V12 Status Map

= 1.0.5 =
* Updates to Minimum Value validation within the admin area

= 1.0.4 =
* Added compatibility with the BFI Finance Calculator plugin
* Altered the calculator logic to take the minimum finance amount in to consideration
* Added V12 to Woo status map

= 1.0.3 =
* Added description as a required field

= 1.0.2 =
* Added check in basket to only show V12 if all config settings are correct and there are active finance products
* Added notification to admin when V12 not configured

= 1.0.1 =
* Added link to update finance products from V12 via Admin

= 1.0.0 =
* Initial V12 Finance Module Release

