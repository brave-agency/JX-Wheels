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

$deposit_amount = filter_input(INPUT_POST, 'v12_deposit_amount') ? filter_input(INPUT_POST, 'v12_deposit_amount') : $deposit_amount;

?>

<script src="<?php echo BRAVE_WC_V12_API_URL_NO_PORT; ?>/js_api/FinanceDetails.js.php?api_key=<?php echo BRAVE_WC_V12_API_KEY; ?>"></script>

<div id="finance-calculator" class="finance-calculator">

<div class="columns">

    <div class="group">

    <div class="finance-calculator__options">

        <label class="select">
            Deposit Amount
            <select @change="updateDeposit" v-model.number="userFinanceDeposit">
                <option value="10">10%</option>
                <option value="15">15%</option>
                <option value="20">20%</option>
                <option value="25">25%</option>
                <option value="30">30%</option>
                <option value="35">35%</option>
                <option value="40">40%</option>
                <option value="45">45%</option>
                <option value="50">50%</option>
                <option value="55">55%</option>
                <option value="60">60%</option>
                <option value="65">65%</option>
                <option value="70">70%</option>
                <option value="75">75%</option>
            </select>
        </label>

        <label class="select">
            Term Length
            <select ref="userFinanceLength" @change="updateLength" v-model.number="userFinanceLength">
                 <?php foreach ($finance_products as $fkey => $fproduct): ?>
                    <option data-product-type="<?php echo $fproduct->product_id; ?>" data-id="<?php echo $fproduct->id; ?>" value="<?php echo $fproduct->months; ?>"><?php echo $fproduct->custom_label; ?></option>
                <?php endforeach;?>
            </select>
        </label>

    </div>

    <div class="finance-calculator__figures">
        <table>
            <tr>
                <td>Deposit Amount</td>
                <td>{{financeDepositAmount | currency }}</td>
            </tr>
            <tr>
                <td>Installment Amount</td>
                <td>{{m_inst | currency }}</td>
            </tr>
            <tr>
                <td>Repayment Term</td>
                <td>{{term}} Months</td>
            </tr>
            <tr>
                <td>APR</td>
                <td>{{rate_of_interest}}</td>
            </tr>
            <tr>
                <td>Total Interest Charged</td>
                <td>{{l_cost | currency }}</td>
            </tr>
        </table>
    </div>

    </div>




    <div class="finance-calculator__summary">

        <p>This is a {{l_amount | currency}} loan, your monthly repayments will be {{m_inst | currency}} for {{term}} months.<br/>The&nbsp;total amount payable is {{total | currency}} .</p>

        <p>The cost for credit (interest and charges) is {{l_cost | currency}}. APR {{rate_of_interest}}.</p>

        <?php if (!is_checkout()): ?>
            <p><strong>To apply for finance, please select this option at checkout.</strong></p>
        <?php endif;?>

        <p>Please note these figures are offered as a guideline. Your actual rates and repayments may differ depending on circumstance.</p>

    </div>

</div>
		<input type='hidden' v-model.number="userFinanceAmount">
        <input type="hidden" name="v12_deposit_amount" id="v12-deposit-amount" v-model.number="financeDepositAmount">
        <input type="hidden" name="v12_finance_option" id="v12-finance-option" v-model.number="financeID">
</div>






<?php
if (is_checkout()):
    $vuePrice = WC()->cart->total;
else:
    $vuePrice = $product->price;
endif;
?>


<script>
Vue.filter("currency", function(money) {
    return accounting.formatMoney(money, "£", 2);
});

Vue.filter("number", function(number) {
    return accounting.formatNumber(number, 0, ",");
});

var financecalculator = new Vue({
    el: "#finance-calculator",
    data: {
        userFinanceAmount: <?php echo $vuePrice; ?>,
        userFinanceDeposit: 20,
        userFinanceLength: 24,
        userFinanceProductValue: '',
        financeID: '',
        apr: '',
        d_amount: '',
        d_pc: '',
        factor: '',
        fees: '',
        first_repayment: '',
        goods_val: '',
        l_amount: '',
        l_cost: '',
        l_max: '',
        l_min: '',
        l_repay: '',
        l_truecost: '',
        last_repayment: '',
        lender_min_fee: '',
        m_full_inst: '',
        m_inst: '',
        p4l_min_fee: '',
        p_name: '',
        r_subsidy: '',
        rate_of_interest: '',
        subsidy_lower: '',
        subsidy_upper: '',
        term: '',
        total: '',
    },
    mounted: function() {
        this.financeID = this.$refs.userFinanceLength.selectedOptions["0"].dataset.id;
        this.updateDeposit();
    },
    methods: {
        updateDeposit: function(event) {
            this.userFinanceProductValue = this.$refs.userFinanceLength.selectedOptions["0"].dataset.productType;
            let my_fd_object = new FinanceDetails(this.userFinanceProductValue, this.userFinanceAmount, this.userFinanceDeposit, this.financeDepositAmount);

            for (var name in my_fd_object) {
                this[name] = my_fd_object[name];
            }
        },
        updateLength: function(event) {

            this.financeID = event.target.options[event.target.options.selectedIndex].dataset.id;
            this.userFinanceProductValue = event.target.options[event.target.options.selectedIndex].dataset.productType;
            let my_fd_object = new FinanceDetails(this.userFinanceProductValue, this.userFinanceAmount, this.userFinanceDeposit, this.financeDepositAmount);


            for (var name in my_fd_object) {
                this[name] = my_fd_object[name];
            }
        }
    },
    computed: {
        financeDepositAmount: function() {
            return (this.userFinanceAmount / 100) * this.userFinanceDeposit;
        }
    }
});
</script>