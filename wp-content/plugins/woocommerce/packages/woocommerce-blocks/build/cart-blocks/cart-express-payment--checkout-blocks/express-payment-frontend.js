(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[6],{30:function(e,t,n){"use strict";n.d(t,"a",(function(){return c}));var s=n(0),o=n(13),a=n.n(o);function c(e){const t=Object(s.useRef)(e);return a()(e,t.current)||(t.current=e),t.current}},302:function(e,t,n){"use strict";n.d(t,"a",(function(){return l}));var s=n(1),o=n(7),a=n(3),c=n(31),r=n(11),i=n(43);const l=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";const{cartCoupons:t,cartIsLoading:n}=Object(i.a)(),{createErrorNotice:l}=Object(o.useDispatch)("core/notices"),{createNotice:p}=Object(o.useDispatch)("core/notices"),{setValidationErrors:u}=Object(o.useDispatch)(a.VALIDATION_STORE_KEY),{isApplyingCoupon:d,isRemovingCoupon:m}=Object(o.useSelect)(e=>{const t=e(a.CART_STORE_KEY);return{isApplyingCoupon:t.isApplyingCoupon(),isRemovingCoupon:t.isRemovingCoupon()}},[l,p]),{applyCoupon:h,removeCoupon:b,receiveApplyingCoupon:g}=Object(o.useDispatch)(a.CART_STORE_KEY),y=t=>{h(t).then(n=>{!0===n&&Object(r.__experimentalApplyCheckoutFilter)({filterName:"showApplyCouponNotice",defaultValue:!0,arg:{couponCode:t,context:e}})&&p("info",Object(s.sprintf)(
/* translators: %s coupon code. */
Object(s.__)('Coupon code "%s" has been applied to your cart.',"woocommerce"),t),{id:"coupon-form",type:"snackbar",context:e})}).catch(e=>{u({coupon:{message:Object(c.decodeEntities)(e.message),hidden:!1}}),g("")})},v=t=>{b(t).then(n=>{!0===n&&Object(r.__experimentalApplyCheckoutFilter)({filterName:"showRemoveCouponNotice",defaultValue:!0,arg:{couponCode:t,context:e}})&&p("info",Object(s.sprintf)(
/* translators: %s coupon code. */
Object(s.__)('Coupon code "%s" has been removed from your cart.',"woocommerce"),t),{id:"coupon-form",type:"snackbar",context:e})}).catch(t=>{l(t.message,{id:"coupon-form",context:e}),g("")})};return{appliedCoupons:t,isLoading:n,applyCoupon:y,removeCoupon:v,isApplyingCoupon:d,isRemovingCoupon:m}}},303:function(e,t){},307:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return l}));var s=n(30),o=n(18),a=n(7),c=n(3);const r=function(){let e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];const{paymentMethodsInitialized:t,expressPaymentMethodsInitialized:n,availablePaymentMethods:r,availableExpressPaymentMethods:i}=Object(a.useSelect)(e=>{const t=e(c.PAYMENT_STORE_KEY);return{paymentMethodsInitialized:t.paymentMethodsInitialized(),expressPaymentMethodsInitialized:t.expressPaymentMethodsInitialized(),availableExpressPaymentMethods:t.getAvailableExpressPaymentMethods(),availablePaymentMethods:t.getAvailablePaymentMethods()}}),l=Object.values(r).map(e=>{let{name:t}=e;return t}),p=Object.values(i).map(e=>{let{name:t}=e;return t}),u=Object(o.getPaymentMethods)(),d=Object(o.getExpressPaymentMethods)(),m=Object.keys(u).reduce((e,t)=>(l.includes(t)&&(e[t]=u[t]),e),{}),h=Object.keys(d).reduce((e,t)=>(p.includes(t)&&(e[t]=d[t]),e),{}),b=Object(s.a)(m),g=Object(s.a)(h);return{paymentMethods:e?g:b,isInitialized:e?n:t}},i=()=>r(!1),l=()=>r(!0)},321:function(e,t,n){"use strict";var s=n(15),o=n.n(s),a=n(0),c=n(6),r=n.n(c);const i=e=>"wc-block-components-payment-method-icon wc-block-components-payment-method-icon--"+e;var l=e=>{let{id:t,src:n=null,alt:s=""}=e;return n?Object(a.createElement)("img",{className:i(t),src:n,alt:s}):null},p=n(37);const u=[{id:"alipay",alt:"Alipay",src:p.m+"payment-methods/alipay.svg"},{id:"amex",alt:"American Express",src:p.m+"payment-methods/amex.svg"},{id:"bancontact",alt:"Bancontact",src:p.m+"payment-methods/bancontact.svg"},{id:"diners",alt:"Diners Club",src:p.m+"payment-methods/diners.svg"},{id:"discover",alt:"Discover",src:p.m+"payment-methods/discover.svg"},{id:"eps",alt:"EPS",src:p.m+"payment-methods/eps.svg"},{id:"giropay",alt:"Giropay",src:p.m+"payment-methods/giropay.svg"},{id:"ideal",alt:"iDeal",src:p.m+"payment-methods/ideal.svg"},{id:"jcb",alt:"JCB",src:p.m+"payment-methods/jcb.svg"},{id:"laser",alt:"Laser",src:p.m+"payment-methods/laser.svg"},{id:"maestro",alt:"Maestro",src:p.m+"payment-methods/maestro.svg"},{id:"mastercard",alt:"Mastercard",src:p.m+"payment-methods/mastercard.svg"},{id:"multibanco",alt:"Multibanco",src:p.m+"payment-methods/multibanco.svg"},{id:"p24",alt:"Przelewy24",src:p.m+"payment-methods/p24.svg"},{id:"sepa",alt:"Sepa",src:p.m+"payment-methods/sepa.svg"},{id:"sofort",alt:"Sofort",src:p.m+"payment-methods/sofort.svg"},{id:"unionpay",alt:"Union Pay",src:p.m+"payment-methods/unionpay.svg"},{id:"visa",alt:"Visa",src:p.m+"payment-methods/visa.svg"},{id:"wechat",alt:"WeChat",src:p.m+"payment-methods/wechat.svg"}];var d=n(23);n(303),t.a=e=>{let{icons:t=[],align:n="center",className:s}=e;const c=(e=>{const t={};return e.forEach(e=>{let n={};"string"==typeof e&&(n={id:e,alt:e,src:null}),"object"==typeof e&&(n={id:e.id||"",alt:e.alt||"",src:e.src||null}),n.id&&Object(d.a)(n.id)&&!t[n.id]&&(t[n.id]=n)}),Object.values(t)})(t);if(0===c.length)return null;const i=r()("wc-block-components-payment-method-icons",{"wc-block-components-payment-method-icons--align-left":"left"===n,"wc-block-components-payment-method-icons--align-right":"right"===n},s);return Object(a.createElement)("div",{className:i},c.map(e=>{const t={...e,...(n=e.id,u.find(e=>e.id===n)||{})};var n;return Object(a.createElement)(l,o()({key:"payment-method-icon-"+e.id},t))}))}},365:function(e,t){},366:function(e,t,n){"use strict";var s=n(17),o=n.n(s),a=n(0),c=n(1),r=n(8),i=n(2),l=n(11),p=n(38);class u extends r.Component{constructor(){super(...arguments),o()(this,"state",{errorMessage:"",hasError:!1})}static getDerivedStateFromError(e){return{errorMessage:e.message,hasError:!0}}render(){const{hasError:e,errorMessage:t}=this.state,{isEditor:n}=this.props;if(e){let e=Object(c.__)("We are experiencing difficulties with this payment method. Please contact us for assistance.","woocommerce");(n||i.CURRENT_USER_IS_ADMIN)&&(e=t||Object(c.__)("There was an error with this payment method. Please verify it's configured correctly.","woocommerce"));const s=[{id:"0",content:e,isDismissible:!1,status:"error"}];return Object(a.createElement)(l.StoreNoticesContainer,{additionalNotices:s,context:p.d.PAYMENTS})}return this.props.children}}u.defaultProps={isEditor:!1},t.a=u},397:function(e,t){},398:function(e,t,n){"use strict";var s=n(0),o=n(1),a=n(307),c=n(457),r=n(46),i=n(22),l=n.n(i),p=n(7),u=n(366),d=n(108);t.a=()=>{const{isEditor:e}=Object(r.a)(),{activePaymentMethod:t,paymentMethodData:n}=Object(p.useSelect)(e=>{const t=e(d.a);return{activePaymentMethod:t.getActivePaymentMethod(),paymentMethodData:t.getPaymentMethodData()}}),{__internalSetActivePaymentMethod:i,__internalSetPaymentStarted:m,__internalSetPaymentPristine:h,__internalSetPaymentError:b,__internalSetPaymentMethodData:g,__internalSetExpressPaymentError:y}=Object(p.useDispatch)(d.a),{paymentMethods:v}=Object(a.a)(),O=Object(c.a)(),j=Object(s.useRef)(t),E=Object(s.useRef)(n),P=Object(s.useCallback)(e=>()=>{j.current=t,E.current=n,m(),i(e)},[t,n,i,m]),S=Object(s.useCallback)(()=>{h(),i(j.current,E.current)},[i,h]),_=Object(s.useCallback)(e=>{b(),g(e),y(e),i(j.current,E.current)},[i,b,g,y]),f=Object(s.useCallback)((function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";l()("Express Payment Methods should use the provided onError handler instead.",{alternative:"onError",plugin:"woocommerce-gutenberg-products-block",link:"https://github.com/woocommerce/woocommerce-gutenberg-products-block/pull/4228"}),e?_(e):y("")}),[y,_]),C=Object.entries(v),k=C.length>0?C.map(t=>{let[n,o]=t;const a=e?o.edit:o.content;return Object(s.isValidElement)(a)?Object(s.createElement)("li",{key:n,id:"express-payment-method-"+n},Object(s.cloneElement)(a,{...O,onClick:P(n),onClose:S,onError:_,setExpressPaymentError:f})):null}):Object(s.createElement)("li",{key:"noneRegistered"},Object(o.__)("No registered Payment Methods","woocommerce"));return Object(s.createElement)(u.a,{isEditor:e},Object(s.createElement)("ul",{className:"wc-block-components-express-payment__event-buttons"},k))}},433:function(e,t,n){"use strict";var s=n(0),o=n(12);const a=Object(s.createElement)(o.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(s.createElement)(o.Path,{fillRule:"evenodd",d:"M5.5 9.5v-2h13v2h-13zm0 3v4h13v-4h-13zM4 7a1 1 0 011-1h14a1 1 0 011 1v10a1 1 0 01-1 1H5a1 1 0 01-1-1V7z",clipRule:"evenodd"}));t.a=a},457:function(e,t,n){"use strict";n.d(t,"a",(function(){return T}));var s=n(1),o=n(44),a=n(0),c=n(6),r=n.n(c),i=n(12),l=Object(a.createElement)(i.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(a.createElement)("g",{fill:"none",fillRule:"evenodd"},Object(a.createElement)("path",{d:"M0 0h24v24H0z"}),Object(a.createElement)("path",{fill:"#000",fillRule:"nonzero",d:"M17.3 8v1c1 .2 1.4.9 1.4 1.7h-1c0-.6-.3-1-1-1-.8 0-1.3.4-1.3.9 0 .4.3.6 1.4 1 1 .2 2 .6 2 1.9 0 .9-.6 1.4-1.5 1.5v1H16v-1c-.9-.1-1.6-.7-1.7-1.7h1c0 .6.4 1 1.3 1 1 0 1.2-.5 1.2-.8 0-.4-.2-.8-1.3-1.1-1.3-.3-2.1-.8-2.1-1.8 0-.9.7-1.5 1.6-1.6V8h1.3zM12 10v1H6v-1h6zm2-2v1H6V8h8zM2 4v16h20V4H2zm2 14V6h16v12H4z"}),Object(a.createElement)("path",{stroke:"#000",strokeLinecap:"round",d:"M6 16c2.6 0 3.9-3 1.7-3-2 0-1 3 1.5 3 1 0 1-.8 2.8-.8"}))),p=Object(a.createElement)(i.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(a.createElement)(i.Path,{fillRule:"evenodd",d:"M18.646 9H20V8l-1-.5L12 4 5 7.5 4 8v1h14.646zm-3-1.5L12 5.677 8.354 7.5h7.292zm-7.897 9.44v-6.5h-1.5v6.5h1.5zm5-6.5v6.5h-1.5v-6.5h1.5zm5 0v6.5h-1.5v-6.5h1.5zm2.252 8.81c0 .414-.334.75-.748.75H4.752a.75.75 0 010-1.5h14.5a.75.75 0 01.749.75z",clipRule:"evenodd"})),u=Object(a.createElement)(i.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(a.createElement)(i.Path,{d:"M3.25 12a8.75 8.75 0 1117.5 0 8.75 8.75 0 01-17.5 0zM12 4.75a7.25 7.25 0 100 14.5 7.25 7.25 0 000-14.5zm-1.338 4.877c-.314.22-.412.452-.412.623 0 .171.098.403.412.623.312.218.783.377 1.338.377.825 0 1.605.233 2.198.648.59.414 1.052 1.057 1.052 1.852 0 .795-.461 1.438-1.052 1.852-.41.286-.907.486-1.448.582v.316a.75.75 0 01-1.5 0v-.316a3.64 3.64 0 01-1.448-.582c-.59-.414-1.052-1.057-1.052-1.852a.75.75 0 011.5 0c0 .171.098.403.412.623.312.218.783.377 1.338.377s1.026-.159 1.338-.377c.314-.22.412-.452.412-.623 0-.171-.098-.403-.412-.623-.312-.218-.783-.377-1.338-.377-.825 0-1.605-.233-2.198-.648-.59-.414-1.052-1.057-1.052-1.852 0-.795.461-1.438 1.052-1.852a3.64 3.64 0 011.448-.582V7.5a.75.75 0 011.5 0v.316c.54.096 1.039.296 1.448.582.59.414 1.052 1.057 1.052 1.852a.75.75 0 01-1.5 0c0-.171-.098-.403-.412-.623-.312-.218-.783-.377-1.338-.377s-1.026.159-1.338.377z"})),d=n(433),m=n(76),h=n(23),b=n(20);n(365);const g={bank:p,bill:u,card:d.a,checkPayment:l};var y=e=>{let{icon:t="",text:n=""}=e;const s=!!t,o=Object(a.useCallback)(e=>s&&Object(h.a)(e)&&Object(b.b)(g,e),[s]),c=r()("wc-block-components-payment-method-label",{"wc-block-components-payment-method-label--with-icon":s});return Object(a.createElement)("span",{className:c},o(t)?Object(a.createElement)(m.a,{icon:g[t]}):t,n)},v=n(321),O=n(2),j=n(22),E=n.n(j),P=n(149),S=n(7),_=n(3),f=n(11),C=n(43),k=n(302),w=n(38),M=n(88),R=n(123),x=n(89);const A=(e,t)=>{const n=[],o=(t,n)=>{const s=n+"_tax",o=Object(b.b)(e,n)&&Object(h.a)(e[n])?parseInt(e[n],10):0;return{key:n,label:t,value:o,valueWithTax:o+(Object(b.b)(e,s)&&Object(h.a)(e[s])?parseInt(e[s],10):0)}};return n.push(o(Object(s.__)("Subtotal:","woocommerce"),"total_items")),n.push(o(Object(s.__)("Fees:","woocommerce"),"total_fees")),n.push(o(Object(s.__)("Discount:","woocommerce"),"total_discount")),n.push({key:"total_tax",label:Object(s.__)("Taxes:","woocommerce"),value:parseInt(e.total_tax,10),valueWithTax:parseInt(e.total_tax,10)}),t&&n.push(o(Object(s.__)("Shipping:","woocommerce"),"total_shipping")),n};var I=n(121);const T=()=>{const{onCheckoutBeforeProcessing:e,onCheckoutValidationBeforeProcessing:t,onCheckoutAfterProcessingWithSuccess:n,onCheckoutAfterProcessingWithError:c,onSubmit:r}=Object(M.b)(),{isCalculating:i,isComplete:l,isIdle:p,isProcessing:u,customerId:d}=Object(S.useSelect)(e=>{const t=e(_.CHECKOUT_STORE_KEY);return{isComplete:t.isComplete(),isIdle:t.isIdle(),isProcessing:t.isProcessing(),customerId:t.getCustomerId(),isCalculating:t.isCalculating()}}),{paymentStatus:m,activePaymentMethod:h,shouldSavePayment:b}=Object(S.useSelect)(e=>{const t=e(_.PAYMENT_STORE_KEY);return{paymentStatus:{isPristine:t.isPaymentPristine(),isStarted:t.isPaymentStarted(),isProcessing:t.isPaymentProcessing(),isFinished:t.isPaymentFinished(),hasError:t.hasPaymentError(),hasFailed:t.isPaymentFailed(),isSuccessful:t.isPaymentSuccess(),isDoingExpressPayment:t.isExpressPaymentMethodActive()},activePaymentMethod:t.getActivePaymentMethod(),shouldSavePayment:t.getShouldSavePaymentMethod()}}),{__internalSetExpressPaymentError:g}=Object(S.useDispatch)(_.PAYMENT_STORE_KEY),{onPaymentProcessing:j}=Object(R.b)(),{shippingErrorStatus:T,shippingErrorTypes:z,onShippingRateSuccess:D,onShippingRateFail:N,onShippingRateSelectSuccess:V,onShippingRateSelectFail:F}=Object(x.b)(),{shippingRates:Y,isLoadingRates:B,selectedRates:L,isSelectingRate:H,selectShippingRate:K,needsShipping:W}=Object(I.a)(),{billingAddress:G,shippingAddress:U}=Object(S.useSelect)(e=>e(_.CART_STORE_KEY).getCustomerData()),{setShippingAddress:J}=Object(S.useDispatch)(_.CART_STORE_KEY),{cartItems:q,cartFees:Q,cartTotals:X,extensions:Z}=Object(C.a)(),{appliedCoupons:$}=Object(k.a)(),ee=Object(a.useRef)(A(X,W)),te=Object(a.useRef)({label:Object(s.__)("Total","woocommerce"),value:parseInt(X.total_price,10)});Object(a.useEffect)(()=>{ee.current=A(X,W),te.current={label:Object(s.__)("Total","woocommerce"),value:parseInt(X.total_price,10)}},[X,W]);const ne=Object(a.useCallback)((function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";E()("setExpressPaymentError should only be used by Express Payment Methods (using the provided onError handler).",{alternative:"",plugin:"woocommerce-gutenberg-products-block",link:"https://github.com/woocommerce/woocommerce-gutenberg-products-block/pull/4228"}),g(e)}),[g]);return{activePaymentMethod:h,billing:{appliedCoupons:$,billingAddress:G,billingData:G,cartTotal:te.current,cartTotalItems:ee.current,currency:Object(o.getCurrencyFromPriceResponse)(X),customerId:d,displayPricesIncludingTax:Object(O.getSetting)("displayCartPricesIncludingTax",!1)},cartData:{cartItems:q,cartFees:Q,extensions:Z},checkoutStatus:{isCalculating:i,isComplete:l,isIdle:p,isProcessing:u},components:{LoadingMask:P.a,PaymentMethodIcons:v.a,PaymentMethodLabel:y,ValidationInputError:f.ValidationInputError},emitResponse:{noticeContexts:w.d,responseTypes:w.e},eventRegistration:{onCheckoutAfterProcessingWithError:c,onCheckoutAfterProcessingWithSuccess:n,onCheckoutBeforeProcessing:e,onCheckoutValidationBeforeProcessing:t,onPaymentProcessing:j,onShippingRateFail:N,onShippingRateSelectFail:F,onShippingRateSelectSuccess:V,onShippingRateSuccess:D},onSubmit:r,paymentStatus:m,setExpressPaymentError:ne,shippingData:{isSelectingRate:H,needsShipping:W,selectedRates:L,setSelectedRates:K,setShippingAddress:J,shippingAddress:U,shippingRates:Y,shippingRatesLoading:B},shippingStatus:{shippingErrorStatus:T,shippingErrorTypes:z},shouldSavePayment:b}}}}]);