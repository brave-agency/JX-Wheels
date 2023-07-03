<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// run via: /usr/local/bin/wp eval-file wp-content/plugins/bfi-woocommerce-v12-finance/crons/check_status.php

echo "\n\n";

echo "Checking Status:\n";

do_action('bfi_v12_check_status');

echo "\n\n";
