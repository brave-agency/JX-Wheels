this.wc=this.wc||{},this.wc.blocks=this.wc.blocks||{},this.wc.blocks["product-best-sellers"]=function(e){function t(t){for(var r,l,a=t[0],i=t[1],s=t[2],b=0,d=[];b<a.length;b++)l=a[b],Object.prototype.hasOwnProperty.call(n,l)&&n[l]&&d.push(n[l][0]),n[l]=0;for(r in i)Object.prototype.hasOwnProperty.call(i,r)&&(e[r]=i[r]);for(u&&u(t);d.length;)d.shift()();return o.push.apply(o,s||[]),c()}function c(){for(var e,t=0;t<o.length;t++){for(var c=o[t],r=!0,a=1;a<c.length;a++){var i=c[a];0!==n[i]&&(r=!1)}r&&(o.splice(t--,1),e=l(l.s=c[0]))}return e}var r={},n={21:0},o=[];function l(t){if(r[t])return r[t].exports;var c=r[t]={i:t,l:!1,exports:{}};return e[t].call(c.exports,c,c.exports,l),c.l=!0,c.exports}l.m=e,l.c=r,l.d=function(e,t,c){l.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:c})},l.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l.t=function(e,t){if(1&t&&(e=l(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var c=Object.create(null);if(l.r(c),Object.defineProperty(c,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)l.d(c,r,function(t){return e[t]}.bind(null,r));return c},l.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return l.d(t,"a",t),t},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},l.p="";var a=window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[],i=a.push.bind(a);a.push=t,a=a.slice();for(var s=0;s<a.length;s++)t(a[s]);var u=i;return o.push([444,0]),c()}({0:function(e,t){e.exports=window.wp.element},1:function(e,t){e.exports=window.wp.i18n},100:function(e,t,c){"use strict";c.d(t,"a",(function(){return _}));var r=c(6),n=c.n(r),o=c(0),l=c(1),a=c(3),i=c(79),s=c(518),u=c(4),b=c.n(u),d=c(11),m=c(19),g=c(38),p=c(517),h=c(18);const E=e=>{let{id:t,label:c,popoverContents:r,remove:n,screenReaderLabel:s,className:u=""}=e;const[m,g]=Object(o.useState)(!1),O=Object(d.useInstanceId)(E);if(s=s||c,!c)return null;c=Object(h.decodeEntities)(c);const w=b()("woocommerce-tag",u,{"has-remove":!!n}),j="woocommerce-tag__label-"+O,f=Object(o.createElement)(o.Fragment,null,Object(o.createElement)("span",{className:"screen-reader-text"},s),Object(o.createElement)("span",{"aria-hidden":"true"},c));return Object(o.createElement)("span",{className:w},r?Object(o.createElement)(a.Button,{className:"woocommerce-tag__text",id:j,onClick:()=>g(!0)},f):Object(o.createElement)("span",{className:"woocommerce-tag__text",id:j},f),r&&m&&Object(o.createElement)(a.Popover,{onClose:()=>g(!1)},r),n&&Object(o.createElement)(a.Button,{className:"woocommerce-tag__remove",onClick:n(t),label:Object(l.sprintf)(// Translators: %s label.
Object(l.__)("Remove %s","woocommerce"),c),"aria-describedby":j},Object(o.createElement)(i.a,{icon:p.a,size:20,className:"clear-icon"})))};var O=E;const w=e=>Object(o.createElement)(g.b,e),j=e=>{const{list:t,selected:c,renderItem:r,depth:l=0,onSelect:a,instanceId:i,isSingle:s,search:u}=e;return t?Object(o.createElement)(o.Fragment,null,t.map(t=>{const b=-1!==c.findIndex(e=>{let{id:c}=e;return c===t.id});return Object(o.createElement)(o.Fragment,{key:t.id},Object(o.createElement)("li",null,r({item:t,isSelected:b,onSelect:a,isSingle:s,search:u,depth:l,controlId:i})),Object(o.createElement)(j,n()({},e,{list:t.children,depth:l+1})))})):null},f=e=>{let{isLoading:t,isSingle:c,selected:r,messages:n,onChange:i,onRemove:s}=e;if(t||c||!r)return null;const u=r.length;return Object(o.createElement)("div",{className:"woocommerce-search-list__selected"},Object(o.createElement)("div",{className:"woocommerce-search-list__selected-header"},Object(o.createElement)("strong",null,n.selected(u)),u>0?Object(o.createElement)(a.Button,{isLink:!0,isDestructive:!0,onClick:()=>i([]),"aria-label":n.clear},Object(l.__)("Clear all","woocommerce")):null),u>0?Object(o.createElement)("ul",null,r.map((e,t)=>Object(o.createElement)("li",{key:t},Object(o.createElement)(O,{label:e.name,id:e.id,remove:s})))):null)},y=e=>{let{filteredList:t,search:c,onSelect:r,instanceId:n,...a}=e;const{messages:u,renderItem:b,selected:d,isSingle:m}=a,g=b||w;return 0===t.length?Object(o.createElement)("div",{className:"woocommerce-search-list__list is-not-found"},Object(o.createElement)("span",{className:"woocommerce-search-list__not-found-icon"},Object(o.createElement)(i.a,{icon:s.a})),Object(o.createElement)("span",{className:"woocommerce-search-list__not-found-text"},c?Object(l.sprintf)(u.noResults,c):u.noItems)):Object(o.createElement)("ul",{className:"woocommerce-search-list__list"},Object(o.createElement)(j,{list:t,selected:d,renderItem:g,onSelect:r,instanceId:n,isSingle:m,search:c}))},_=e=>{const{className:t="",isCompact:c,isHierarchical:r,isLoading:l,isSingle:i,list:s,messages:u=m.a,onChange:g,onSearch:p,selected:h,debouncedSpeak:E}=e,[O,w]=Object(o.useState)(""),j=Object(d.useInstanceId)(_),x=Object(o.useMemo)(()=>({...m.a,...u}),[u]),k=Object(o.useMemo)(()=>Object(m.c)(s,O,r),[s,O,r]);Object(o.useEffect)(()=>{E&&E(x.updated)},[E,x]),Object(o.useEffect)(()=>{"function"==typeof p&&p(O)},[O,p]);const v=Object(o.useCallback)(e=>()=>{i&&g([]);const t=h.findIndex(t=>{let{id:c}=t;return c===e});g([...h.slice(0,t),...h.slice(t+1)])},[i,h,g]),S=Object(o.useCallback)(e=>()=>{-1===h.findIndex(t=>{let{id:c}=t;return c===e.id})?g(i?[e]:[...h,e]):v(e.id)()},[i,v,g,h]);return Object(o.createElement)("div",{className:b()("woocommerce-search-list",t,{"is-compact":c})},Object(o.createElement)(f,n()({},e,{onRemove:v,messages:x})),Object(o.createElement)("div",{className:"woocommerce-search-list__search"},Object(o.createElement)(a.TextControl,{label:x.search,type:"search",value:O,onChange:e=>w(e)})),l?Object(o.createElement)("div",{className:"woocommerce-search-list__list is-loading"},Object(o.createElement)(a.Spinner,null)):Object(o.createElement)(y,n()({},e,{search:O,filteredList:k,messages:x,onSelect:S,instanceId:j})))};Object(a.withSpokenMessages)(_)},11:function(e,t){e.exports=window.wp.compose},12:function(e,t){e.exports=window.wp.primitives},149:function(e,t,c){"use strict";c.d(t,"a",(function(){return n}));var r=c(0);const n=Object(r.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 230 250",style:{width:"100%"}},Object(r.createElement)("title",null,"Grid Block Preview"),Object(r.createElement)("rect",{width:"65.374",height:"65.374",x:".162",y:".779",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"47.266",height:"5.148",x:"9.216",y:"76.153",fill:"#E1E3E6",rx:"2.574"}),Object(r.createElement)("rect",{width:"62.8",height:"15",x:"1.565",y:"101.448",fill:"#E1E3E6",rx:"5"}),Object(r.createElement)("rect",{width:"65.374",height:"65.374",x:".162",y:"136.277",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"47.266",height:"5.148",x:"9.216",y:"211.651",fill:"#E1E3E6",rx:"2.574"}),Object(r.createElement)("rect",{width:"62.8",height:"15",x:"1.565",y:"236.946",fill:"#E1E3E6",rx:"5"}),Object(r.createElement)("rect",{width:"65.374",height:"65.374",x:"82.478",y:".779",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"47.266",height:"5.148",x:"91.532",y:"76.153",fill:"#E1E3E6",rx:"2.574"}),Object(r.createElement)("rect",{width:"62.8",height:"15",x:"83.882",y:"101.448",fill:"#E1E3E6",rx:"5"}),Object(r.createElement)("rect",{width:"65.374",height:"65.374",x:"82.478",y:"136.277",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"47.266",height:"5.148",x:"91.532",y:"211.651",fill:"#E1E3E6",rx:"2.574"}),Object(r.createElement)("rect",{width:"62.8",height:"15",x:"83.882",y:"236.946",fill:"#E1E3E6",rx:"5"}),Object(r.createElement)("rect",{width:"65.374",height:"65.374",x:"164.788",y:".779",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"47.266",height:"5.148",x:"173.843",y:"76.153",fill:"#E1E3E6",rx:"2.574"}),Object(r.createElement)("rect",{width:"62.8",height:"15",x:"166.192",y:"101.448",fill:"#E1E3E6",rx:"5"}),Object(r.createElement)("rect",{width:"65.374",height:"65.374",x:"164.788",y:"136.277",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"47.266",height:"5.148",x:"173.843",y:"211.651",fill:"#E1E3E6",rx:"2.574"}),Object(r.createElement)("rect",{width:"62.8",height:"15",x:"166.192",y:"236.946",fill:"#E1E3E6",rx:"5"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"13.283",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"21.498",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"29.713",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"37.927",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"46.238",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"95.599",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"103.814",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"112.029",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"120.243",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"128.554",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"177.909",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"186.124",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"194.339",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"202.553",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"210.864",y:"86.301",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"13.283",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"21.498",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"29.713",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"37.927",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"46.238",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"95.599",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"103.814",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"112.029",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"120.243",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"128.554",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"177.909",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"186.124",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"194.339",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"202.553",y:"221.798",fill:"#E1E3E6",rx:"3"}),Object(r.createElement)("rect",{width:"6.177",height:"6.177",x:"210.864",y:"221.798",fill:"#E1E3E6",rx:"3"}))},15:function(e,t){e.exports=window.wp.apiFetch},16:function(e,t){e.exports=window.wp.url},18:function(e,t){e.exports=window.wp.htmlEntities},19:function(e,t,c){"use strict";c.d(t,"a",(function(){return l})),c.d(t,"c",(function(){return i})),c.d(t,"d",(function(){return s})),c.d(t,"b",(function(){return u}));var r=c(0),n=c(8),o=c(1);const l={clear:Object(o.__)("Clear all selected items","woocommerce"),noItems:Object(o.__)("No items found.","woocommerce"),
/* Translators: %s search term */
noResults:Object(o.__)("No results for %s","woocommerce"),search:Object(o.__)("Search for items","woocommerce"),selected:e=>Object(o.sprintf)(
/* translators: Number of items selected from list. */
Object(o._n)("%d item selected","%d items selected",e,"woocommerce"),e),updated:Object(o.__)("Search results updated.","woocommerce")},a=function(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:e;const c=Object(n.groupBy)(e,"parent"),r=Object(n.keyBy)(t,"id"),o=["0"],l=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};if(!e.parent)return e.name?[e.name]:[];const t=l(r[e.parent]);return[...t,e.name]},a=e=>e.map(e=>{const t=c[e.id];return o.push(""+e.id),{...e,breadcrumbs:l(r[e.parent]),children:t&&t.length?a(t):[]}}),i=a(c[0]||[]);return Object.entries(c).forEach(e=>{let[t,c]=e;o.includes(t)||i.push(...a(c||[]))}),i},i=(e,t,c)=>{if(!t)return c?a(e):e;const r=new RegExp(t.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"),"i"),n=e.map(e=>!!r.test(e.name)&&e).filter(Boolean);return c?a(n,e):n},s=(e,t)=>{if(!t)return e;const c=new RegExp(`(${t.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&")})`,"ig");return e.split(c).map((e,t)=>c.test(e)?Object(r.createElement)("strong",{key:t},e):Object(r.createElement)(r.Fragment,{key:t},e))},u=e=>1===e.length?e.slice(0,1).toString():2===e.length?e.slice(0,1).toString()+" › "+e.slice(-1).toString():e.slice(0,1).toString()+" … "+e.slice(-1).toString()},2:function(e,t){e.exports=window.wc.wcSettings},20:function(e,t,c){"use strict";c.d(t,"o",(function(){return o})),c.d(t,"m",(function(){return l})),c.d(t,"l",(function(){return a})),c.d(t,"n",(function(){return i})),c.d(t,"j",(function(){return s})),c.d(t,"e",(function(){return u})),c.d(t,"g",(function(){return b})),c.d(t,"k",(function(){return d})),c.d(t,"c",(function(){return m})),c.d(t,"d",(function(){return g})),c.d(t,"h",(function(){return p})),c.d(t,"a",(function(){return h})),c.d(t,"i",(function(){return E})),c.d(t,"b",(function(){return O})),c.d(t,"f",(function(){return w}));var r,n=c(2);const o=Object(n.getSetting)("wcBlocksConfig",{buildPhase:1,pluginUrl:"",productCount:0,defaultAvatar:"",restApiRoutes:{},wordCountType:"words"}),l=o.pluginUrl+"images/",a=o.pluginUrl+"build/",i=o.buildPhase,s=null===(r=n.STORE_PAGES.shop)||void 0===r?void 0:r.permalink,u=n.STORE_PAGES.checkout.id,b=(n.STORE_PAGES.checkout.permalink,n.STORE_PAGES.privacy.permalink),d=(n.STORE_PAGES.privacy.title,n.STORE_PAGES.terms.permalink),m=(n.STORE_PAGES.terms.title,n.STORE_PAGES.cart.id),g=n.STORE_PAGES.cart.permalink,p=(n.STORE_PAGES.myaccount.permalink?n.STORE_PAGES.myaccount.permalink:Object(n.getSetting)("wpLoginUrl","/wp-login.php"),Object(n.getSetting)("shippingCountries",{})),h=Object(n.getSetting)("allowedCountries",{}),E=Object(n.getSetting)("shippingStates",{}),O=Object(n.getSetting)("allowedStates",{}),w=Object(n.getSetting)("localPickupEnabled",!1)},26:function(e,t,c){"use strict";c.d(t,"h",(function(){return s})),c.d(t,"e",(function(){return u})),c.d(t,"b",(function(){return b})),c.d(t,"i",(function(){return d})),c.d(t,"f",(function(){return m})),c.d(t,"c",(function(){return g})),c.d(t,"d",(function(){return p})),c.d(t,"g",(function(){return h})),c.d(t,"a",(function(){return E}));var r=c(16),n=c(15),o=c.n(n),l=c(8),a=c(2),i=c(20);const s=e=>{let{selected:t=[],search:c="",queryArgs:n={}}=e;const a=(e=>{let{selected:t=[],search:c="",queryArgs:n={}}=e;const o=i.o.productCount>100,l={per_page:o?100:0,catalog_visibility:"any",search:c,orderby:"title",order:"asc"},a=[Object(r.addQueryArgs)("/wc/store/v1/products",{...l,...n})];return o&&t.length&&a.push(Object(r.addQueryArgs)("/wc/store/v1/products",{catalog_visibility:"any",include:t,per_page:0})),a})({selected:t,search:c,queryArgs:n});return Promise.all(a.map(e=>o()({path:e}))).then(e=>Object(l.uniqBy)(Object(l.flatten)(e),"id").map(e=>({...e,parent:0}))).catch(e=>{throw e})},u=e=>o()({path:"/wc/store/v1/products/"+e}),b=()=>o()({path:"wc/store/v1/products/attributes"}),d=e=>o()({path:`wc/store/v1/products/attributes/${e}/terms`}),m=e=>{let{selected:t=[],search:c}=e;const n=(e=>{let{selected:t=[],search:c}=e;const n=Object(a.getSetting)("limitTags",!1),o=[Object(r.addQueryArgs)("wc/store/v1/products/tags",{per_page:n?100:0,orderby:n?"count":"name",order:n?"desc":"asc",search:c})];return n&&t.length&&o.push(Object(r.addQueryArgs)("wc/store/v1/products/tags",{include:t})),o})({selected:t,search:c});return Promise.all(n.map(e=>o()({path:e}))).then(e=>Object(l.uniqBy)(Object(l.flatten)(e),"id"))},g=e=>o()({path:Object(r.addQueryArgs)("wc/store/v1/products/categories",{per_page:0,...e})}),p=e=>o()({path:"wc/store/v1/products/categories/"+e}),h=e=>o()({path:Object(r.addQueryArgs)("wc/store/v1/products",{per_page:0,type:"variation",parent:e})}),E=(e,t)=>{if(!e.title.raw)return e.slug;const c=1===t.filter(t=>t.title.raw===e.title.raw).length;return e.title.raw+(c?"":" - "+e.slug)}},293:function(e){e.exports=JSON.parse('{"name":"woocommerce/product-best-sellers","title":"Best Selling Products","category":"woocommerce","keywords":["WooCommerce"],"description":"Display a grid of your all-time best selling products.","supports":{"align":["wide","full"],"html":false},"example":{"attributes":{"isPreview":true}},"attributes":{"columns":{"type":"number","default":3},"rows":{"type":"number","default":3},"alignButtons":{"type":"boolean","default":false},"contentVisibility":{"type":"object","default":{"image":true,"title":true,"price":true,"rating":true,"button":true},"properties":{"image":{"type":"boolean","default":true},"title":{"type":"boolean","default":true},"price":{"type":"boolean","default":true},"rating":{"type":"boolean","default":true},"button":{"type":"boolean","default":true}}},"categories":{"type":"array","default":[]},"catOperator":{"type":"string","default":"any"},"isPreview":{"type":"boolean","default":false},"stockStatus":{"type":"array"},"editMode":{"type":"boolean","default":true},"orderby":{"type":"string","enum":["date","popularity","price_asc","price_desc","rating","title","menu_order"],"default":"popularity"}},"textdomain":"woocommerce","apiVersion":2,"$schema":"https://schemas.wp.org/trunk/block.json"}')},3:function(e,t){e.exports=window.wp.components},30:function(e,t,c){"use strict";c.d(t,"a",(function(){return r}));const r=async e=>{if("function"==typeof e.json)try{const t=await e.json();return{message:t.message,type:t.type||"api"}}catch(e){return{message:e.message,type:"general"}}return{message:e.message,type:e.type||"general"}}},34:function(e,t,c){"use strict";var r=c(0),n=c(1),o=c(35);t.a=e=>{let{error:t}=e;return Object(r.createElement)("div",{className:"wc-block-error-message"},(e=>{let{message:t,type:c}=e;return t?"general"===c?Object(r.createElement)("span",null,Object(n.__)("The following error was returned","woocommerce"),Object(r.createElement)("br",null),Object(r.createElement)("code",null,Object(o.escapeHTML)(t))):"api"===c?Object(r.createElement)("span",null,Object(n.__)("The following error was returned from the API","woocommerce"),Object(r.createElement)("br",null),Object(r.createElement)("code",null,Object(o.escapeHTML)(t))):t:Object(n.__)("An error has prevented the block from being updated.","woocommerce")})(t))}},35:function(e,t){e.exports=window.wp.escapeHtml},38:function(e,t,c){"use strict";c.d(t,"a",(function(){return a}));var r=c(6),n=c.n(r),o=c(0),l=c(19);const a=e=>{let{countLabel:t,className:c,depth:r=0,controlId:a="",item:i,isSelected:s,isSingle:u,onSelect:b,search:d="",...m}=e;const g=null!=t&&void 0!==i.count&&null!==i.count,p=[c,"woocommerce-search-list__item"];p.push("depth-"+r),u&&p.push("is-radio-button"),g&&p.push("has-count");const h=i.breadcrumbs&&i.breadcrumbs.length,E=m.name||"search-list-item-"+a,O=`${E}-${i.id}`;return Object(o.createElement)("label",{htmlFor:O,className:p.join(" ")},u?Object(o.createElement)("input",n()({type:"radio",id:O,name:E,value:i.value,onChange:b(i),checked:s,className:"woocommerce-search-list__item-input"},m)):Object(o.createElement)("input",n()({type:"checkbox",id:O,name:E,value:i.value,onChange:b(i),checked:s,className:"woocommerce-search-list__item-input"},m)),Object(o.createElement)("span",{className:"woocommerce-search-list__item-label"},h?Object(o.createElement)("span",{className:"woocommerce-search-list__item-prefix"},Object(l.b)(i.breadcrumbs)):null,Object(o.createElement)("span",{className:"woocommerce-search-list__item-name"},Object(l.d)(i.name,d))),!!g&&Object(o.createElement)("span",{className:"woocommerce-search-list__item-count"},t||i.count))};t.b=a},444:function(e,t,c){e.exports=c(490)},490:function(e,t,c){"use strict";c.r(t);var r=c(0),n=c(8),o=c(79),l=c(547),a=c(9),i=c(293),s=c(5),u=c(3),b=c(57),d=c.n(b),m=c(149),g=c(1),p=c(63),h=c(2),E=c(64),O=c(58);const w=e=>{const{attributes:t,setAttributes:c}=e,{categories:n,catOperator:o,columns:l,contentVisibility:a,rows:i,alignButtons:b}=t;return Object(r.createElement)(s.InspectorControls,{key:"inspector"},Object(r.createElement)(u.PanelBody,{title:Object(g.__)("Layout","woocommerce"),initialOpen:!0},Object(r.createElement)(p.a,{columns:l,rows:i,alignButtons:b,setAttributes:c,minColumns:Object(h.getSetting)("min_columns",1),maxColumns:Object(h.getSetting)("max_columns",6),minRows:Object(h.getSetting)("min_rows",1),maxRows:Object(h.getSetting)("max_rows",6)})),Object(r.createElement)(u.PanelBody,{title:Object(g.__)("Content","woocommerce"),initialOpen:!0},Object(r.createElement)(E.a,{settings:a,onChange:e=>c({contentVisibility:e})})),Object(r.createElement)(u.PanelBody,{title:Object(g.__)("Filter by Product Category","woocommerce"),initialOpen:!1},Object(r.createElement)(O.a,{selected:n,onChange:function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:[];const t=e.map(e=>{let{id:t}=e;return t});c({categories:t})},operator:o,onOperatorChange:function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"any";return c({catOperator:e})}})))},j=e=>{const{attributes:t,name:c}=e;return t.isPreview?m.a:Object(r.createElement)("div",{className:"wc-block-product-best-sellers"},Object(r.createElement)(w,e),Object(r.createElement)(u.Disabled,null,Object(r.createElement)(d.a,{block:c,attributes:t})))};var f=c(74);Object(a.registerBlockType)(i,{icon:{src:Object(r.createElement)(o.a,{icon:l.a,className:"wc-block-editor-components-block-icon"})},attributes:{...f.a,...i.attributes},transforms:{from:[{type:"block",blocks:Object(n.without)(f.b,"woocommerce/product-best-sellers"),transform:e=>Object(a.createBlock)("woocommerce/product-best-sellers",e)}]},edit:e=>{const t=Object(s.useBlockProps)();return Object(r.createElement)("div",t,Object(r.createElement)(j,e))},save:()=>null})},5:function(e,t){e.exports=window.wp.blockEditor},57:function(e,t){e.exports=window.wp.serverSideRender},58:function(e,t,c){"use strict";var r=c(6),n=c.n(r),o=c(0),l=c(1),a=c(38),i=c(100),s=c(3),u=c(11),b=c(26),d=c(30),m=Object(u.createHigherOrderComponent)(e=>class extends o.Component{constructor(){super(...arguments),this.state={error:null,loading:!1,categories:[]},this.loadCategories=this.loadCategories.bind(this)}componentDidMount(){this.loadCategories()}loadCategories(){this.setState({loading:!0}),Object(b.c)().then(e=>{this.setState({categories:e,loading:!1,error:null})}).catch(async e=>{const t=await Object(d.a)(e);this.setState({categories:[],loading:!1,error:t})})}render(){const{error:t,loading:c,categories:r}=this.state;return Object(o.createElement)(e,n()({},this.props,{error:t,isLoading:c,categories:r}))}},"withCategories"),g=c(34),p=c(4),h=c.n(p);c(93);const E=e=>{let{categories:t,error:c,isLoading:r,onChange:u,onOperatorChange:b,operator:d,selected:m,isCompact:p,isSingle:E,showReviewCount:O}=e;const w={clear:Object(l.__)("Clear all product categories","woocommerce"),list:Object(l.__)("Product Categories","woocommerce"),noItems:Object(l.__)("Your store doesn't have any product categories.","woocommerce"),search:Object(l.__)("Search for product categories","woocommerce"),selected:e=>Object(l.sprintf)(
/* translators: %d is the count of selected categories. */
Object(l._n)("%d category selected","%d categories selected",e,"woocommerce"),e),updated:Object(l.__)("Category search results updated.","woocommerce")};return c?Object(o.createElement)(g.a,{error:c}):Object(o.createElement)(o.Fragment,null,Object(o.createElement)(i.a,{className:"woocommerce-product-categories",list:t,isLoading:r,selected:m.map(e=>t.find(t=>t.id===e)).filter(Boolean),onChange:u,renderItem:e=>{const{item:t,search:c,depth:r=0}=e,i=t.breadcrumbs.length?`${t.breadcrumbs.join(", ")}, ${t.name}`:t.name,s=O?Object(l.sprintf)(
/* translators: %1$s is the item name, %2$d is the count of reviews for the item. */
Object(l._n)("%1$s, has %2$d review","%1$s, has %2$d reviews",t.review_count,"woocommerce"),i,t.review_count):Object(l.sprintf)(
/* translators: %1$s is the item name, %2$d is the count of products for the item. */
Object(l._n)("%1$s, has %2$d product","%1$s, has %2$d products",t.count,"woocommerce"),i,t.count),u=O?Object(l.sprintf)(
/* translators: %d is the count of reviews. */
Object(l._n)("%d review","%d reviews",t.review_count,"woocommerce"),t.review_count):Object(l.sprintf)(
/* translators: %d is the count of products. */
Object(l._n)("%d product","%d products",t.count,"woocommerce"),t.count);return Object(o.createElement)(a.a,n()({className:h()("woocommerce-product-categories__item","has-count",{"is-searching":c.length>0,"is-skip-level":0===r&&0!==t.parent})},e,{countLabel:u,"aria-label":s}))},messages:w,isCompact:p,isHierarchical:!0,isSingle:E}),!!b&&Object(o.createElement)("div",{hidden:m.length<2},Object(o.createElement)(s.SelectControl,{className:"woocommerce-product-categories__operator",label:Object(l.__)("Display products matching","woocommerce"),help:Object(l.__)("Pick at least two categories to use this setting.","woocommerce"),value:d,onChange:b,options:[{label:Object(l.__)("Any selected categories","woocommerce"),value:"any"},{label:Object(l.__)("All selected categories","woocommerce"),value:"all"}]})))};E.defaultProps={operator:"any",isCompact:!1,isSingle:!1},t.a=m(E)},63:function(e,t,c){"use strict";var r=c(0),n=c(1),o=c(8),l=c(3);t.a=e=>{let{columns:t,rows:c,setAttributes:a,alignButtons:i,minColumns:s=1,maxColumns:u=6,minRows:b=1,maxRows:d=6}=e;return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(l.RangeControl,{label:Object(n.__)("Columns","woocommerce"),value:t,onChange:e=>{const t=Object(o.clamp)(e,s,u);a({columns:Number.isNaN(t)?"":t})},min:s,max:u}),Object(r.createElement)(l.RangeControl,{label:Object(n.__)("Rows","woocommerce"),value:c,onChange:e=>{const t=Object(o.clamp)(e,b,d);a({rows:Number.isNaN(t)?"":t})},min:b,max:d}),Object(r.createElement)(l.ToggleControl,{label:Object(n.__)("Align the last block to the bottom","woocommerce"),help:i?Object(n.__)("Align the last block to the bottom.","woocommerce"):Object(n.__)("The last inner block will follow other content.","woocommerce"),checked:i,onChange:()=>a({alignButtons:!i})}))}},64:function(e,t,c){"use strict";var r=c(0),n=c(1),o=c(3);t.a=e=>{let{onChange:t,settings:c}=e;const{image:l,button:a,price:i,rating:s,title:u}=c,b=!1!==l;return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(o.ToggleControl,{label:Object(n.__)("Product image","woocommerce"),checked:b,onChange:()=>t({...c,image:!b})}),Object(r.createElement)(o.ToggleControl,{label:Object(n.__)("Product title","woocommerce"),checked:u,onChange:()=>t({...c,title:!u})}),Object(r.createElement)(o.ToggleControl,{label:Object(n.__)("Product price","woocommerce"),checked:i,onChange:()=>t({...c,price:!i})}),Object(r.createElement)(o.ToggleControl,{label:Object(n.__)("Product rating","woocommerce"),checked:s,onChange:()=>t({...c,rating:!s})}),Object(r.createElement)(o.ToggleControl,{label:Object(n.__)("Add to Cart button","woocommerce"),checked:a,onChange:()=>t({...c,button:!a})}))}},74:function(e,t,c){"use strict";c.d(t,"b",(function(){return n}));var r=c(2);const n=["woocommerce/product-best-sellers","woocommerce/product-category","woocommerce/product-new","woocommerce/product-on-sale","woocommerce/product-top-rated"];t.a={columns:{type:"number",default:Object(r.getSetting)("default_columns",3)},rows:{type:"number",default:Object(r.getSetting)("default_rows",3)},alignButtons:{type:"boolean",default:!1},categories:{type:"array",default:[]},catOperator:{type:"string",default:"any"},contentVisibility:{type:"object",default:{image:!0,title:!0,price:!0,rating:!0,button:!0}},isPreview:{type:"boolean",default:!1},stockStatus:{type:"array",default:Object.keys(Object(r.getSetting)("stockStatusOptions",[]))}}},8:function(e,t){e.exports=window.lodash},9:function(e,t){e.exports=window.wp.blocks},93:function(e,t){}});