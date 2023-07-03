<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// run via: /usr/local/bin/wp eval-file wp-content/plugins/bfi-woocommerce-v12-finance/crons/import_products.php

echo "\n\n";

echo "Import Products:\n";

do_action('bfi_v12_import_products');

echo "\n\n";
