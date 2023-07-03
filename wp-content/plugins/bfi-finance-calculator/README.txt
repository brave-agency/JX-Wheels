=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: http://www.wearebfi.co.uk/
Tags: finance
Requires at least: 3.0.1
Tested up to: 4.8
Stable tag: 4.3
License URI: http://www.wearebfi.co.uk/terms/

BFI Finance Calculator for Woocommerce V12

== Description ==

This plugin handles the the finance calculator shown on applicable products when V12 is active

== Changelog ==

= 1.2.2 =
* Fixed issue with minimum payment not displaying correctly
* Changed to get_price() to get the product price

= 1.2.1 =
* Updated Upgrade Library to latest version

= 1.1.2 =
* Fixed issue where parent product didn't get child price, so tab not displayed

= 1.1.1 =
* Applied fix from V12: Fixed finance to allow for different min / max values in products

= 1.1.0 =
* Matched version to V12 version
* Fixed number_format without commas
* Added filter: bfi_finance_calc_products to change products
* Added filter: bfi_finance_calc_tab_priority to change tab priority (default: 50)
* Fixed display to show finance on higher value product (as per V12 plugin fix)

= 1.0.5 =
* Wrapped the review section within in a DIV tag
* Fixed Validation for minimum deposit amount

= 1.0.4 =
* Fixed issues with Parent Sale products not showing correct finance options / amounts
* Added filters (bfi_finance_calc_payment & bfi_finance_calc_display_shop) to change text for "finance from" text
* Added action to show finance calculator in specific place (only when tab is off via: Enable V12 Retail Finance Calculator option)

= 1.0.3 =
* Fixing issue with Wordpress Prepare statement in class-bfi-finance-calculator-public.php

= 1.0.2 =
* Amendment to the plugin description

= 1.0.1 =
* Added "Finance Available From" to the single product page
* Altered the sum for the finance available from

= 1.0.0 =
* Initial V12 Finance Calculator Release

