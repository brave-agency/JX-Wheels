(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[24],{221:function(e,t){},235:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var c=n(0),s=(n(8),n(160));n(221);const o=e=>{let{errorMessage:t="",propertyName:n="",elementId:o=""}=e;const{getValidationError:r,getValidationErrorId:a}=Object(s.b)();if(!t||"string"!=typeof t){const e=r(n)||{};if(!e.message||e.hidden)return null;t=e.message}return Object(c.createElement)("div",{className:"wc-block-components-validation-error",role:"alert"},Object(c.createElement)("p",{id:a(o)},t))}},238:function(e,t,n){"use strict";n.d(t,"b",(function(){return r})),n.d(t,"a",(function(){return a}));var c=n(17),s=n(204);const o=function(){let e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];const{paymentMethods:t,expressPaymentMethods:n,paymentMethodsInitialized:o,expressPaymentMethodsInitialized:r}=Object(s.b)(),a=Object(c.a)(t),i=Object(c.a)(n);return{paymentMethods:e?i:a,isInitialized:e?r:o}},r=()=>o(!1),a=()=>o(!0)},239:function(e,t){},240:function(e,t,n){"use strict";n.d(t,"a",(function(){return d}));var c=n(1),s=n(9),o=n(6),r=n(19),a=n(22),i=n(0),l=n(211),p=n(160),u=n(32);const d=()=>{const{cartCoupons:e,cartIsLoading:t}=Object(a.a)(),{addErrorNotice:n}=Object(u.a)(),{addSnackbarNotice:d}=(()=>{const{notices:e,createSnackbarNotice:t,removeSnackbarNotice:n,setIsSuppressed:c}=Object(l.b)(),s=Object(i.useRef)(e);Object(i.useEffect)(()=>{s.current=e},[e]);const o=Object(i.useMemo)(()=>({removeNotices:function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;s.current.forEach(t=>{null!==e&&t.status!==e||n(t.id)})},removeSnackbarNotice:n}),[n]),r=Object(i.useMemo)(()=>({addSnackbarNotice:function(e){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};t(e,n)}}),[t]);return{notices:e,...o,...r,setIsSuppressed:c}})(),{setValidationErrors:m}=Object(p.b)();return{appliedCoupons:e,isLoading:t,...Object(s.useSelect)((e,t)=>{let{dispatch:s}=t;const a=e(o.CART_STORE_KEY),i=a.isApplyingCoupon(),l=a.isRemovingCoupon(),{applyCoupon:p,removeCoupon:u,receiveApplyingCoupon:b}=s(o.CART_STORE_KEY);return{applyCoupon:e=>{p(e).then(t=>{!0===t&&d(Object(c.sprintf)(
/* translators: %s coupon code. */
Object(c.__)('Coupon code "%s" has been applied to your cart.','woocommerce'),e),{id:"coupon-form"})}).catch(e=>{m({coupon:{message:Object(r.decodeEntities)(e.message),hidden:!1}}),b("")})},removeCoupon:e=>{u(e).then(t=>{!0===t&&d(Object(c.sprintf)(
/* translators: %s coupon code. */
Object(c.__)('Coupon code "%s" has been removed from your cart.','woocommerce'),e),{id:"coupon-form"})}).catch(e=>{n(e.message,{id:"coupon-form"}),b("")})},isApplyingCoupon:i,isRemovingCoupon:l}},[n,d])}}},243:function(e,t,n){"use strict";var c=n(10),s=n.n(c),o=n(0),r=n(4),a=n.n(r);const i=e=>"wc-block-components-payment-method-icon wc-block-components-payment-method-icon--"+e;var l=e=>{let{id:t,src:n=null,alt:c=""}=e;return n?Object(o.createElement)("img",{className:i(t),src:n,alt:c}):null},p=n(66);const u=[{id:"alipay",alt:"Alipay",src:p.l+"payment-methods/alipay.svg"},{id:"amex",alt:"American Express",src:p.l+"payment-methods/amex.svg"},{id:"bancontact",alt:"Bancontact",src:p.l+"payment-methods/bancontact.svg"},{id:"diners",alt:"Diners Club",src:p.l+"payment-methods/diners.svg"},{id:"discover",alt:"Discover",src:p.l+"payment-methods/discover.svg"},{id:"eps",alt:"EPS",src:p.l+"payment-methods/eps.svg"},{id:"giropay",alt:"Giropay",src:p.l+"payment-methods/giropay.svg"},{id:"ideal",alt:"iDeal",src:p.l+"payment-methods/ideal.svg"},{id:"jcb",alt:"JCB",src:p.l+"payment-methods/jcb.svg"},{id:"laser",alt:"Laser",src:p.l+"payment-methods/laser.svg"},{id:"maestro",alt:"Maestro",src:p.l+"payment-methods/maestro.svg"},{id:"mastercard",alt:"Mastercard",src:p.l+"payment-methods/mastercard.svg"},{id:"multibanco",alt:"Multibanco",src:p.l+"payment-methods/multibanco.svg"},{id:"p24",alt:"Przelewy24",src:p.l+"payment-methods/p24.svg"},{id:"sepa",alt:"Sepa",src:p.l+"payment-methods/sepa.svg"},{id:"sofort",alt:"Sofort",src:p.l+"payment-methods/sofort.svg"},{id:"unionpay",alt:"Union Pay",src:p.l+"payment-methods/unionpay.svg"},{id:"visa",alt:"Visa",src:p.l+"payment-methods/visa.svg"},{id:"wechat",alt:"WeChat",src:p.l+"payment-methods/wechat.svg"}];var d=n(35);n(239),t.a=e=>{let{icons:t=[],align:n="center",className:c}=e;const r=(e=>{const t={};return e.forEach(e=>{let n={};"string"==typeof e&&(n={id:e,alt:e,src:null}),"object"==typeof e&&(n={id:e.id||"",alt:e.alt||"",src:e.src||null}),n.id&&Object(d.d)(n.id)&&!t[n.id]&&(t[n.id]=n)}),Object.values(t)})(t);if(0===r.length)return null;const i=a()("wc-block-components-payment-method-icons",{"wc-block-components-payment-method-icons--align-left":"left"===n,"wc-block-components-payment-method-icons--align-right":"right"===n},c);return Object(o.createElement)("div",{className:i},r.map(e=>{const t={...e,...(n=e.id,u.find(e=>e.id===n)||{})};var n;return Object(o.createElement)(l,s()({key:"payment-method-icon-"+e.id},t))}))}},255:function(e,t){},256:function(e,t,n){"use strict";var c=n(15),s=n.n(c),o=n(0),r=n(1),a=n(3),i=(n(8),n(2)),l=n(92);class p extends a.Component{constructor(){super(...arguments),s()(this,"state",{errorMessage:"",hasError:!1})}static getDerivedStateFromError(e){return{errorMessage:e.message,hasError:!0}}render(){const{hasError:e,errorMessage:t}=this.state,{isEditor:n}=this.props;if(e){let e=Object(r.__)("This site is experiencing difficulties with this payment method. Please contact the owner of the site for assistance.",'woocommerce');(n||i.CURRENT_USER_IS_ADMIN)&&(e=t||Object(r.__)("There was an error with this payment method. Please verify it's configured correctly.",'woocommerce'));const c=[{id:"0",content:e,isDismissible:!1,status:"error"}];return Object(o.createElement)(l.StoreNoticesContainer,{notices:c})}return this.props.children}}p.defaultProps={isEditor:!1},t.a=p},279:function(e,t){},280:function(e,t,n){"use strict";var c=n(0),s=n(1),o=n(305),r=n(238),a=n(18),i=n(204),l=n(30),p=n.n(l),u=n(256);t.a=()=>{const{isEditor:e}=Object(a.a)(),{setActivePaymentMethod:t,setExpressPaymentError:n,activePaymentMethod:l,paymentMethodData:d,setPaymentStatus:m}=Object(i.b)(),b=Object(o.a)(),{paymentMethods:h}=Object(r.a)(),g=Object(c.useRef)(l),v=Object(c.useRef)(d),j=Object(c.useCallback)(e=>()=>{g.current=l,v.current=d,m().started(),t(e)},[l,d,t,m]),O=Object(c.useCallback)(()=>{m().pristine(),t(g.current,v.current)},[t,m]),y=Object(c.useCallback)(e=>{m().error(e),n(e),t(g.current,v.current)},[t,m,n]),E=Object(c.useCallback)((function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";p()("Express Payment Methods should use the provided onError handler instead.",{alternative:"onError",plugin:"woocommerce-gutenberg-products-block",link:"https://github.com/woocommerce/woocommerce-gutenberg-products-block/pull/4228"}),e?y(e):n("")}),[n,y]),f=Object.entries(h),k=f.length>0?f.map(t=>{let[n,s]=t;const o=e?s.edit:s.content;return Object(c.isValidElement)(o)?Object(c.createElement)("li",{key:n,id:"express-payment-method-"+n},Object(c.cloneElement)(o,{...b,onClick:j(n),onClose:O,onError:y,setExpressPaymentError:E})):null}):Object(c.createElement)("li",{key:"noneRegistered"},Object(s.__)("No registered Payment Methods",'woocommerce'));return Object(c.createElement)(u.a,{isEditor:e},Object(c.createElement)("ul",{className:"wc-block-components-express-payment__event-buttons"},k))}},300:function(e,t,n){"use strict";var c=n(0),s=n(24);const o=Object(c.createElement)(s.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(c.createElement)("path",{fill:"none",d:"M0 0h24v24H0V0z"}),Object(c.createElement)("path",{fill:"currentColor",d:"M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"}));t.a=o},305:function(e,t,n){"use strict";n.d(t,"a",(function(){return R}));var c=n(1),s=n(40),o=n(0),r=n(4),a=n.n(r),i=n(24),l=Object(o.createElement)(i.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(o.createElement)("path",{fill:"none",d:"M0 0h24v24H0z"}),Object(o.createElement)("path",{d:"M4 10h3v7H4zM10.5 10h3v7h-3zM2 19h20v3H2zM17 10h3v7h-3zM12 1L2 6v2h20V6z"})),p=Object(o.createElement)(i.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24"},Object(o.createElement)("path",{fill:"none",d:"M0 0h24v24H0V0z"}),Object(o.createElement)("path",{d:"M11 17h2v-1h1c.55 0 1-.45 1-1v-3c0-.55-.45-1-1-1h-3v-1h4V8h-2V7h-2v1h-1c-.55 0-1 .45-1 1v3c0 .55.45 1 1 1h3v1H9v2h2v1zm9-13H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4V6h16v12z"})),u=n(300),d=Object(o.createElement)(i.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(o.createElement)("g",{fill:"none",fillRule:"evenodd"},Object(o.createElement)("path",{d:"M0 0h24v24H0z"}),Object(o.createElement)("path",{fill:"#000",fillRule:"nonzero",d:"M17.3 8v1c1 .2 1.4.9 1.4 1.7h-1c0-.6-.3-1-1-1-.8 0-1.3.4-1.3.9 0 .4.3.6 1.4 1 1 .2 2 .6 2 1.9 0 .9-.6 1.4-1.5 1.5v1H16v-1c-.9-.1-1.6-.7-1.7-1.7h1c0 .6.4 1 1.3 1 1 0 1.2-.5 1.2-.8 0-.4-.2-.8-1.3-1.1-1.3-.3-2.1-.8-2.1-1.8 0-.9.7-1.5 1.6-1.6V8h1.3zM12 10v1H6v-1h6zm2-2v1H6V8h8zM2 4v16h20V4H2zm2 14V6h16v12H4z"}),Object(o.createElement)("path",{stroke:"#000",strokeLinecap:"round",d:"M6 16c2.6 0 3.9-3 1.7-3-2 0-1 3 1.5 3 1 0 1-.8 2.8-.8"}))),m=n(98),b=n(35);n(255);const h={bank:l,bill:p,card:u.a,checkPayment:d};var g=e=>{let{icon:t="",text:n=""}=e;const c=!!t,s=Object(o.useCallback)(e=>c&&Object(b.d)(e)&&Object(b.e)(h,e),[c]),r=a()("wc-block-components-payment-method-label",{"wc-block-components-payment-method-label--with-icon":c});return Object(o.createElement)("span",{className:r},s(t)?Object(o.createElement)(m.a,{srcElement:h[t]}):t,n)},v=n(243),j=n(2),O=n(30),y=n.n(O),E=n(129),f=n(235),k=n(22),w=n(240),S=n(29),C=n(31),P=n(204),_=n(44),x=n(33);const M=(e,t)=>{const n=[],s=(t,n)=>{const c=n+"_tax",s=Object(b.e)(e,n)&&Object(b.d)(e[n])?parseInt(e[n],10):0;return{key:n,label:t,value:s,valueWithTax:s+(Object(b.e)(e,c)&&Object(b.d)(e[c])?parseInt(e[c],10):0)}};return n.push(s(Object(c.__)("Subtotal:",'woocommerce'),"total_items")),n.push(s(Object(c.__)("Fees:",'woocommerce'),"total_fees")),n.push(s(Object(c.__)("Discount:",'woocommerce'),"total_discount")),n.push({key:"total_tax",label:Object(c.__)("Taxes:",'woocommerce'),value:parseInt(e.total_tax,10),valueWithTax:parseInt(e.total_tax,10)}),t&&n.push(s(Object(c.__)("Shipping:",'woocommerce'),"total_shipping")),n},R=()=>{const{isCalculating:e,isComplete:t,isIdle:n,isProcessing:r,onCheckoutBeforeProcessing:a,onCheckoutValidationBeforeProcessing:i,onCheckoutAfterProcessingWithSuccess:l,onCheckoutAfterProcessingWithError:p,onSubmit:u,customerId:d}=Object(C.b)(),{currentStatus:m,activePaymentMethod:b,onPaymentProcessing:h,setExpressPaymentError:O,shouldSavePayment:R}=Object(P.b)(),{shippingErrorStatus:I,shippingErrorTypes:z,shippingRates:V,shippingRatesLoading:N,selectedRates:T,setSelectedRates:A,isSelectingRate:H,onShippingRateSuccess:B,onShippingRateFail:D,onShippingRateSelectSuccess:L,onShippingRateSelectFail:F,needsShipping:W}=Object(_.b)(),{billingData:G,shippingAddress:J,setShippingAddress:U}=Object(x.b)(),{cartItems:Y,cartFees:K,cartTotals:X,extensions:q}=Object(k.a)(),{appliedCoupons:Q}=Object(w.a)(),{noticeContexts:Z,responseTypes:$}=Object(S.c)(),ee=Object(o.useRef)(M(X,W)),te=Object(o.useRef)({label:Object(c.__)("Total",'woocommerce'),value:parseInt(X.total_price,10)});Object(o.useEffect)(()=>{ee.current=M(X,W),te.current={label:Object(c.__)("Total",'woocommerce'),value:parseInt(X.total_price,10)}},[X,W]);const ne=Object(o.useCallback)((function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";y()("setExpressPaymentError should only be used by Express Payment Methods (using the provided onError handler).",{alternative:"",plugin:"woocommerce-gutenberg-products-block",link:"https://github.com/woocommerce/woocommerce-gutenberg-products-block/pull/4228"}),O(e)}),[O]);return{activePaymentMethod:b,billing:{appliedCoupons:Q,billingData:G,cartTotal:te.current,cartTotalItems:ee.current,currency:Object(s.getCurrencyFromPriceResponse)(X),customerId:d,displayPricesIncludingTax:Object(j.getSetting)("displayCartPricesIncludingTax",!1)},cartData:{cartItems:Y,cartFees:K,extensions:q},checkoutStatus:{isCalculating:e,isComplete:t,isIdle:n,isProcessing:r},components:{LoadingMask:E.a,PaymentMethodIcons:v.a,PaymentMethodLabel:g,ValidationInputError:f.a},emitResponse:{noticeContexts:Z,responseTypes:$},eventRegistration:{onCheckoutAfterProcessingWithError:p,onCheckoutAfterProcessingWithSuccess:l,onCheckoutBeforeProcessing:a,onCheckoutValidationBeforeProcessing:i,onPaymentProcessing:h,onShippingRateFail:D,onShippingRateSelectFail:F,onShippingRateSelectSuccess:L,onShippingRateSuccess:B},onSubmit:u,paymentStatus:m,setExpressPaymentError:ne,shippingData:{isSelectingRate:H,needsShipping:W,selectedRates:T,setSelectedRates:A,setShippingAddress:U,shippingAddress:J,shippingRates:V,shippingRatesLoading:N},shippingStatus:{shippingErrorStatus:I,shippingErrorTypes:z},shouldSavePayment:R}}},398:function(e,t,n){"use strict";n.r(t);var c=n(0),s=n(22),o=n(4),r=n.n(o),a=n(1),i=n(238),l=n(29),p=n(31),u=n(204),d=n(87),m=n(129),b=n(280);n(279);var h=()=>{const{paymentMethods:e,isInitialized:t}=Object(i.a)(),{noticeContexts:n}=Object(l.c)(),{isCalculating:s,isProcessing:o,isAfterProcessing:r,isBeforeProcessing:h,isComplete:g,hasError:v}=Object(p.b)(),{currentStatus:j}=Object(u.b)();if(!t||t&&0===Object.keys(e).length)return null;const O=o||r||h||g&&!v;return Object(c.createElement)(c.Fragment,null,Object(c.createElement)(m.a,{isLoading:s||O||j.isDoingExpressPayment},Object(c.createElement)("div",{className:"wc-block-components-express-payment wc-block-components-express-payment--cart"},Object(c.createElement)("div",{className:"wc-block-components-express-payment__content"},Object(c.createElement)(d.a,{context:n.EXPRESS_PAYMENTS},Object(c.createElement)(b.a,null))))),Object(c.createElement)("div",{className:"wc-block-components-express-payment-continue-rule wc-block-components-express-payment-continue-rule--cart"},Object(a.__)("Or",'woocommerce')))};t.default=e=>{let{className:t}=e;const{cartNeedsPayment:n}=Object(s.a)();return n?Object(c.createElement)("div",{className:r()("wc-block-cart__payment-options",t)},Object(c.createElement)(h,null)):null}},92:function(e,t,n){},98:function(e,t,n){"use strict";var c=n(0);t.a=function(e){let{srcElement:t,size:n=24,...s}=e;return Object(c.isValidElement)(t)?Object(c.cloneElement)(t,{width:n,height:n,...s}):null}}}]);