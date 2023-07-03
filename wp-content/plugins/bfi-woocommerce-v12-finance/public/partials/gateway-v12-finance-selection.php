<?php
/**
 * Handle the HTML for the V12 gateway selection during payment
 *
 * @link       http://www.wearebfi.co.uk
 * @since      1.0.0
 *
 * @package    BFI_Woocommerce_V12_Finance
 * @subpackage BFI_Woocommerce_V12_Finance/public/partials
 */

// set the selected item (or first item)
list($selected_fprod) = array_keys($finance_products);
?>

<label for="v12-finance-option" class="required"><em>*</em><?php echo __('Finance Option', 'woocommerce_v12retailfinance'); ?></label>
<select name="v12_finance_option" id="v12-finance-option">
<?php foreach ($finance_products as $fkey => $fproduct): ?>
	<option value="<?php echo $fkey; ?>"<?php if ( $selected_fprod == $fkey ): ?> selected<?php endif; ?>><?php echo $fproduct->name; ?></option>
<?php endforeach; ?>
</select>

<?php 
// work out the bits we need for finance
$loan_total = $order_total - $deposit_amount;
$interest_rate = number_format($finance_products[$selected_fprod]->monthly_rate * 12, 2, '.', '');

if( $finance_products[$selected_fprod]->apr == 0 ) {
	// Interest Free
	$interest = 0;
	$monthly_payment = number_format($loan_total / $finance_products[$selected_fprod]->months, 2, '.', '');

	// allow for any discrepencies
	if ( $monthly_payment * $finance_products[$selected_fprod]->months > $loan_total ) {
		$payment_total = $monthly_payment * ($finance_products[$selected_fprod]->months - 1);
		$monthly_payment = number_format($loan_total - $payment_total, 2, '.', '');
	}
}
else {
	// APR rate
	$monthly_payment = number_format($loan_total * $finance_products[$selected_fprod]->calculation_factor, 2, '.', '');
	$interest = ($monthly_payment * $finance_products[$selected_fprod]->months) - $loan_total;
}

// set the appropriate values in the description
$fdescription = $finance_products[$selected_fprod]->description;

$tokens = array(
	'LOAN'              => number_format($loan_total, 2, '.', ''),
	'INTEREST_RATE'     => $interest_rate,
	'INSTALMENT'        => $monthly_payment,
	'TERM'              => $finance_products[$selected_fprod]->months,
	'CHARGE_FOR_CREDIT' => number_format($interest, 2, '.', ''),
	'TOTAL_PAYABLE'     => number_format($loan_total + $interest, 2, '.', ''),
	'APR'               => number_format($finance_products[$selected_fprod]->apr, 2, '.', ''),
	'BNPLPeriod'        => $finance_products[$selected_fprod]->deferred_period,
	'TOTALTERM'         => $finance_products[$selected_fprod]->deferred_period + $finance_products[$selected_fprod]->months,
	'ARRANGEMENTFEE'    => number_format($finance_products[$selected_fprod]->service_fee, 2, '.', ''),
	'SETTLEMENTFEE'     => number_format($finance_products[$selected_fprod]->settlement_fee, 2, '.', ''),
);
if ( ! empty($finance_products[$selected_fprod]->deferred_period) ) {
	$tokens['BNPLPeriod']     = $finance_products[$selected_fprod]->deferred_period;
	$tokens['BNPL_ARRANGEMENT_FEEE']    = number_format($finance_products[$selected_fprod]->service_fee, 2, '.', '');
}
foreach($tokens as $token => $value) {
	$fdescription = str_replace("$".$token."$", $value, $fdescription);
}
?>
<div id="v12_option_desc-container">
        <div id="v12-product-desc"><?php echo $fdescription; ?></div>
        <table>
            <tr>
                <td class="label"><strong>APR</strong></td>
                <td><span id="v12-apr"> <?php echo number_format($finance_products[$selected_fprod]->apr, 2, '.', ''); ?>%</span></td>
			</tr>
			<tr>
				<td class="label"><strong>Installment Amount</strong></td>
                <td><?php echo get_woocommerce_currency_symbol(); ?><span id="v12-monthly-payment"><?php echo $monthly_payment; ?></span>/<?php echo __('month', 'woocommerce_v12retailfinance'); ?></td>
            </tr>
            <tr>
                <td class="label"><strong>Repayment Term</strong></td>
                <td><span id="v12-months"><?php echo $finance_products[$selected_fprod]->months; ?></span> <?php echo __('months', 'woocommerce_v12retailfinance'); ?></td>
            </tr>
            <tr>
                <td class="label"><strong>Total Interest Charged</strong></td>
                <td><?php echo get_woocommerce_currency_symbol(); ?><span id="v12-interest"><?php echo number_format($interest, 2, '.', ''); ?></span></td>
            </tr>
			<tr>
                <td class="label"><strong>Deposit Amount</strong></td>
                <td><?php echo get_woocommerce_currency_symbol(); ?><span id="v12-deposit"><?php echo number_format($deposit_amount, 2, '.', ''); ?></span></td>
            </tr>
        </table>
   </div>

<?php
$v12_min_deposit = $order_total - $finance_products[$selected_fprod]->wc_max_loan;
if ( $v12_min_deposit < 0) {
	$v12_min_deposit = $min_deposit_amount;
}
$v12_max_deposit = $order_total - $finance_products[$selected_fprod]->wc_min_loan;
if ( $v12_max_deposit < 0) {
	$v12_max_deposit = $max_deposit_amount;
}
$display_deposit_amount = $deposit_amount;
if ( $deposit_amount > $v12_max_deposit || $deposit_amount < $v12_min_deposit) {
	$display_deposit_amount = $v12_min_deposit;
}
?>

<?php if ( isset( $variable_deposit ) && $variable_deposit == 'yes' ): ?>
<p>Please specify the deposit amount that you wish to pay. The accepted value is between <strong><?php echo get_woocommerce_currency_symbol(); ?><span  id="v12-min-deposit"><?php echo number_format($v12_min_deposit, 2, '.', ''); ?></span></strong> and <strong><?php echo get_woocommerce_currency_symbol(); ?><span  id="v12-max-deposit"><?php echo number_format($v12_max_deposit, 2); ?></span></strong>.</p>

<p><label for="v12_deposit_amount" class="required"><em>*</em>Deposit Amount (<?php echo get_woocommerce_currency_symbol(); ?>):</label>
<input type="text" name="v12_deposit_amount" id="v12-deposit-amount" value="<?php echo number_format($display_deposit_amount, 2, '.', ''); ?>"> <button type="button" id="v12-refresh">Update</button></p>
<?php else: ?>
<input type="hidden" name="v12_deposit_amount" id="v12-deposit-amount" value="<?php echo number_format($display_deposit_amount, 2, '.', ''); ?>">
<?php endif; ?>