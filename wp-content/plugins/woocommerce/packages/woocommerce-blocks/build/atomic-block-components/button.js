(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[8],{261:function(t,o,c){"use strict";c.r(o);var e=c(5),n=c.n(e),a=c(0),d=(c(10),c(4)),r=c.n(d),l=c(1),b=c(60),u=c(355),i=c(14),s=c(29),p=c(54);c(301);const _=t=>{let{product:o}=t;const{id:c,permalink:e,add_to_cart:d,has_options:s,is_purchasable:p,is_in_stock:_}=o,{dispatchStoreEvent:k}=Object(b.a)(),{cartQuantity:w,addingToCart:m,addToCart:j}=Object(u.a)(c),O=Number.isFinite(w)&&w>0,C=!s&&p&&_,E=Object(i.decodeEntities)((null==d?void 0:d.description)||""),h=O?Object(l.sprintf)(
/* translators: %s number of products in cart. */
Object(l._n)("%d in cart","%d in cart",w,'woocommerce'),w):Object(i.decodeEntities)((null==d?void 0:d.text)||Object(l.__)("Add to cart",'woocommerce')),f=C?"button":"a",g={};return C?g.onClick=()=>{j(),k("cart-add-item",{product:o})}:(g.href=e,g.rel="nofollow",g.onClick=()=>{k("product-view-link",{product:o})}),Object(a.createElement)(f,n()({"aria-label":E,className:r()("wp-block-button__link","add_to_cart_button","wc-block-components-product-button__button",{loading:m,added:O}),disabled:m},g),h)},k=()=>Object(a.createElement)("button",{className:r()("wp-block-button__link","add_to_cart_button","wc-block-components-product-button__button","wc-block-components-product-button__button--placeholder"),disabled:!0});o.default=Object(p.withProductDataContext)(t=>{let{className:o}=t;const{parentClassName:c}=Object(s.useInnerBlockLayoutContext)(),{product:e}=Object(s.useProductDataContext)();return Object(a.createElement)("div",{className:r()(o,"wp-block-button","wc-block-components-product-button",{[c+"__product-add-to-cart"]:c})},e.id?Object(a.createElement)(_,{product:e}):Object(a.createElement)(k,null))})},301:function(t,o){}}]);