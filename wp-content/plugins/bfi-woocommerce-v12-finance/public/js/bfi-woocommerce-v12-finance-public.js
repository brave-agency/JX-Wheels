jQuery(function ($) {
	function number_format(number, decimals, dec_point, thousands_sep) {
	    //  discuss at: http://phpjs.org/functions/number_format/
	    // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
	    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	    // improved by: davook
	    // improved by: Brett Zamir (http://brett-zamir.me)
	    // improved by: Brett Zamir (http://brett-zamir.me)
	    // improved by: Theriault
	    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	    // bugfixed by: Michael White (http://getsprink.com)
	    // bugfixed by: Benjamin Lupton
	    // bugfixed by: Allan Jensen (http://www.winternet.no)
	    // bugfixed by: Howard Yeend
	    // bugfixed by: Diogo Resende
	    // bugfixed by: Rival
	    // bugfixed by: Brett Zamir (http://brett-zamir.me)
	    //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
	    //  revised by: Luke Smith (http://lucassmith.name)
	    //    input by: Kheang Hok Chin (http://www.distantia.ca/)
	    //    input by: Jay Klehr
	    //    input by: Amir Habibi (http://www.residence-mixte.com/)
	    //    input by: Amirouche
	    //   example 1: number_format(1234.56);
	    //   returns 1: '1,235'
	    //   example 2: number_format(1234.56, 2, ',', ' ');
	    //   returns 2: '1 234,56'
	    //   example 3: number_format(1234.5678, 2, '.', '');
	    //   returns 3: '1234.57'
	    //   example 4: number_format(67, 2, ',', '.');
	    //   returns 4: '67,00'
	    //   example 5: number_format(1000);
	    //   returns 5: '1,000'
	    //   example 6: number_format(67.311, 2);
	    //   returns 6: '67.31'
	    //   example 7: number_format(1000.55, 1);
	    //   returns 7: '1,000.6'
	    //   example 8: number_format(67000, 5, ',', '.');
	    //   returns 8: '67.000,00000'
	    //   example 9: number_format(0.9, 0);
	    //   returns 9: '1'
	    //  example 10: number_format('1.20', 2);
	    //  returns 10: '1.20'
	    //  example 11: number_format('1.20', 4);
	    //  returns 11: '1.2000'
	    //  example 12: number_format('1.2000', 3);
	    //  returns 12: '1.200'
	    //  example 13: number_format('1 000,50', 2, '.', ' ');
	    //  returns 13: '100 050.00'
	    //  example 14: number_format(1e-8, 8, '.', '');
	    //  returns 14: '0.00000001'

	    number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
	    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                .toFixed(prec);
            };
	    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
	    if (s[0].length > 3) {
	        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	    }
	    if ((s[1] || '')
            .length < prec) {
	        s[1] = s[1] || '';
	        s[1] += new Array(prec - s[1].length + 1)
                .join('0');
	    }
	    return s.join(dec);
	}

	function str_replace(search, replace, subject, count) {
	    //  discuss at: http://phpjs.org/functions/str_replace/
	    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	    // improved by: Gabriel Paderni
	    // improved by: Philip Peterson
	    // improved by: Simon Willison (http://simonwillison.net)
	    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	    // improved by: Onno Marsman
	    // improved by: Brett Zamir (http://brett-zamir.me)
	    //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
	    // bugfixed by: Anton Ongson
	    // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	    // bugfixed by: Oleg Eremeev
	    //    input by: Onno Marsman
	    //    input by: Brett Zamir (http://brett-zamir.me)
	    //    input by: Oleg Eremeev
	    //        note: The count parameter must be passed as a string in order
	    //        note: to find a global variable in which the result will be given
	    //   example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
	    //   returns 1: 'Kevin.van.Zonneveld'
	    //   example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
	    //   returns 2: 'hemmo, mars'

	    var i = 0,
            j = 0,
            temp = '',
            repl = '',
            sl = 0,
            fl = 0,
            f = [].concat(search),
            r = [].concat(replace),
            s = subject,
            ra = Object.prototype.toString.call(r) === '[object Array]',
            sa = Object.prototype.toString.call(s) === '[object Array]';
	    s = [].concat(s);
	    if (count) {
	        this.window[count] = 0;
	    }

	    for (i = 0, sl = s.length; i < sl; i++) {
	        if (s[i] === '') {
	            continue;
	        }
	        for (j = 0, fl = f.length; j < fl; j++) {
	            temp = s[i] + '';
	            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
	            s[i] = (temp)
                    .split(f[j])
                    .join(repl);
	            if (count && s[i] !== temp) {
	                this.window[count] += (temp.length - s[i].length) / f[j].length;
	            }
	        }
	    }
	    return sa ? s : s[0];
	}

	function update_finance() {
	    var user_deposit = $('#v12-deposit-amount').val();
	    var user_product = $('#v12-finance-option').val();

        // check user has picked a valid product
	    if (user_product in v12_products) {
			var min_amount = v12_settings['order_total'] - v12_products[user_product]['wc_max_loan'];
			if ( min_amount < 0) {
				min_amount = v12_settings.deposit.min_amount;
			}
			var max_amount = v12_settings['order_total'] - v12_products[user_product]['wc_min_loan'];
			if ( max_amount < 0) {
				max_amount = v12_settings.deposit.max_amount;
			}
			$('#v12-min-deposit').html(min_amount.toFixed(2));
			$('#v12-max-deposit').html(max_amount.toFixed(2));

	        // check if the deposit is within range
	        if (user_deposit >= min_amount && user_deposit <= max_amount) {
    	        // work out the new values and update the page
	            var apr = v12_products[user_product]['apr'];

	            var loan_total = v12_settings.order_total - user_deposit;
	            var interest_rate = number_format(v12_products[user_product]['monthly_rate'] * 12, 2);

	            var interest = 0;
	            var monthly_payment = 0;
	            if (v12_products[user_product]['apr'] == 0) {
	                // Interest Free
	                monthly_payment = number_format(loan_total / v12_products[user_product]['months'], 2);

	                // allow for any discrepencies
	                if ( monthly_payment * v12_products[user_product]['months'] > loan_total ) {
	                    var payment_total = monthly_payment * (v12_products[user_product]['months'] - 1);
	                    monthly_payment = number_format(loan_total - payment_total, 2);
	                }
	            }
	            else {
	                // APR rate
	                monthly_payment = number_format(loan_total * v12_products[user_product]['calculation_factor'], 2);
	                interest = (monthly_payment * v12_products[user_product]['months']) - loan_total;
	            }

                // set the appropriate values in the description
	            var fdescription = v12_products[user_product]['description'];
	            var total_term = parseInt(v12_products[user_product]['deferred_period']) + parseInt(v12_products[user_product]['months']);
                var tokens = {
                    'LOAN'              : number_format(loan_total, 2),
                    'INTEREST_RATE'     : interest_rate,
                    'INSTALMENT'        : monthly_payment,
                    'TERM'              : v12_products[user_product]['months'],
                    'CHARGE_FOR_CREDIT' : number_format(interest, 2),
                    'TOTAL_PAYABLE'     : number_format(loan_total + interest, 2),
                    'APR'               : number_format(v12_products[user_product]['apr'], 2),
                    'BNPLPeriod'        : v12_products[user_product]['deferred_period'],
                    'TOTALTERM'         : total_term,
                    'ARRANGEMENTFEE'    : number_format(v12_products[user_product]['service_fee'], 2),
                    'SETTLEMENTFEE'     : number_format(v12_products[user_product]['settlement_fee'], 2)
                };

                if (v12_products[user_product]['deferred_period'] > 0) {
                    tokens['BNPLPeriod'] = v12_products[user_product]['deferred_period'];
                    tokens['BNPL_ARRANGEMENT_FEEE'] = number_format(v12_products[user_product]['service_fee'], 2);
                }
                for (var token in tokens) {
                    fdescription = str_replace("$" + token + "$", tokens[token], fdescription);
                }

                $('#v12-apr').html(number_format(v12_products[user_product]['apr'], 2) + '%');
	            $('#v12-monthly-payment').html(monthly_payment);
	            $('#v12-months').html(v12_products[user_product]['months']);
	            $('#v12-interest').html(number_format(interest, 2));
	            $('#v12-deposit').html(number_format(user_deposit, 2));

	            $('#v12-product-desc').html(fdescription);
	        }
	        else {
	            alert('Please enter a deposit between ' + min_amount.toFixed(2) + ' and ' + max_amount.toFixed(2));
	        }
	    }
	    else {
	        alert('Please choose a valid Finance Product');
	    }
    }

    // now update the amounts based on changes to product / deposit
    $('#v12-finance-option').on('change', function (e) {
        update_finance();
    });

    $('#v12-refresh').on('click', function (e) {
        update_finance();
    });

    $('body').on('updated_checkout', function () {
        $('#v12-finance-option').on('change', function (e) {
            update_finance();
        });

        $('#v12-refresh').on('click', function (e) {
            update_finance();
        });
    });
});
