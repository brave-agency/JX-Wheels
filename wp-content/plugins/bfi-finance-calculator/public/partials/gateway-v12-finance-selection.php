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
<div id="finance-option">
    <span id="finance-review-text">
        <p>Please use our calculator below to help you see what finance options are available. <strong>To apply for finance, please select this option at the checkout.</strong></p>
    </span>
    <div id="finance-option-container" class="clearfix">

        <!-- Step One -->

        <div id="step-1" class="finance-option first clearfix">

            <h6><span>Step 1:</span>Choose your finance option</h6>

            <p>Please specify the finance option that you wish to choose.</p>

            <label for="v12-finance-option" class="required"><?php echo __('Finance Option', 'woocommerce_v12retailfinance'); ?></label>
            <div class="input">
                <select name="v12_finance_option" id="v12-finance-option">
                    <?php foreach ($finance_products as $fkey => $fproduct): ?>
                        <option value="<?php echo $fkey; ?>"<?php if ( $selected_fprod == $fkey ): ?> selected<?php endif; ?>><?php echo $fproduct->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


        <!-- Step Two -->

        <div id="step-2" class="finance-option last clearfix">

            <h6><span>Step 2:</span>Choose your deposit amount</h6>

            <?php if ( isset( $variable_deposit ) && $variable_deposit == 'yes' ): ?>
                <p>Please specify the deposit amount that you wish to pay.</p>

                <label for="v12_deposit_amount" class="required">Deposit Amount (<?php echo get_woocommerce_currency_symbol(); ?>):</label>
                <div class="input">
                    <input type="text" name="v12_deposit_amount" id="v12-deposit-amount" value="<?php echo number_format($deposit_amount, 2, '.', ''); ?>"> <button type="button" id="v12-refresh">Update</button>
                </div>
            <?php else: ?>
                <div class="input">
                    <input type="hidden" name="v12_deposit_amount" id="v12-deposit-amount" value="<?php echo number_format($deposit_amount, 2, '.', ''); ?>">
                </div>
            <?php endif; ?>
            <p class="small-print">The accepted value is between <strong><?php echo get_woocommerce_currency_symbol(); ?><?php echo number_format($min_deposit_amount, 2, '.', ''); ?></strong> and <strong><?php echo get_woocommerce_currency_symbol(); ?><?php echo number_format($max_deposit_amount, 2); ?></strong></p>

        </div>

    </div>

    <p><strong>Please view the available finance details below.</strong></p>

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
                <td><span id="v12-apr"><?php echo number_format($finance_products[$selected_fprod]->apr, 2, '.', ''); ?>%</span></td>
            </tr>
            <tr class="even">
                <td class="label"><strong>Installment Amount</strong></td>
                <td><?php echo get_woocommerce_currency_symbol(); ?><span id="v12-monthly-payment"><?php echo $monthly_payment; ?></span>/<?php echo __('month', 'woocommerce_v12retailfinance'); ?></td>
            </tr>
            <tr>
                <td class="label"><strong>Repayment Term</strong></td>
                <td><span id="v12-months"><?php echo $finance_products[$selected_fprod]->months; ?></span> <?php echo __('months', 'woocommerce_v12retailfinance'); ?></td>
            </tr>
            <tr class="even">
                <td class="label"><strong>Total Interest Charged</strong></td>
                <td><?php echo get_woocommerce_currency_symbol(); ?><span id="v12-interest"><?php echo number_format($interest, 2, '.', ''); ?></span></td>
            </tr>
            <tr>
                <td class="label"><strong>Deposit Amount</strong></td>
                <td><?php echo get_woocommerce_currency_symbol(); ?><span id="v12-deposit"><?php echo number_format($deposit_amount, 2, '.', ''); ?></span></td>
            </tr>
        </table>

    </div>
</div>
