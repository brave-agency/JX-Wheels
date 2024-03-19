"use strict";(globalThis.webpackChunkcomplianz_gdpr=globalThis.webpackChunkcomplianz_gdpr||[]).push([[1132],{92160:(r,e,t)=>{t.d(e,{c:()=>D});var a=t(95656),o=t(45072),n=t(51280),i=t(65456),l=t(53864);let c=0;const p=n["useId".toString()];var s=t(73068),d=t(63252),u=t(37616),h=t(76968),m=t(826),g=t(44404),x=t(60888),v=t(40608);function f(r){return(0,v.cp)("MuiDialog",r)}const b=(0,x.c)("MuiDialog",["root","scrollPaper","scrollBody","container","paper","paperScrollPaper","paperScrollBody","paperWidthFalse","paperWidthXs","paperWidthSm","paperWidthMd","paperWidthLg","paperWidthXl","paperFullWidth","paperFullScreen"]);var y=t(88736),W=t(55084),S=t(42592),w=t(17624);const k=["aria-describedby","aria-labelledby","BackdropComponent","BackdropProps","children","className","disableEscapeKeyDown","fullScreen","fullWidth","maxWidth","onBackdropClick","onClose","open","PaperComponent","PaperProps","scroll","TransitionComponent","transitionDuration","TransitionProps"],B=(0,g.cp)(W.c,{name:"MuiDialog",slot:"Backdrop",overrides:(r,e)=>e.backdrop})({zIndex:-1}),M=(0,g.cp)(d.c,{name:"MuiDialog",slot:"Root",overridesResolver:(r,e)=>e.root})({"@media print":{position:"absolute !important"}}),P=(0,g.cp)("div",{name:"MuiDialog",slot:"Container",overridesResolver:(r,e)=>{const{ownerState:t}=r;return[e.container,e[`scroll${(0,s.c)(t.scroll)}`]]}})((({ownerState:r})=>(0,o.c)({height:"100%","@media print":{height:"auto"},outline:0},"paper"===r.scroll&&{display:"flex",justifyContent:"center",alignItems:"center"},"body"===r.scroll&&{overflowY:"auto",overflowX:"hidden",textAlign:"center","&::after":{content:'""',display:"inline-block",verticalAlign:"middle",height:"100%",width:"0"}}))),C=(0,g.cp)(h.c,{name:"MuiDialog",slot:"Paper",overridesResolver:(r,e)=>{const{ownerState:t}=r;return[e.paper,e[`scrollPaper${(0,s.c)(t.scroll)}`],e[`paperWidth${(0,s.c)(String(t.maxWidth))}`],t.fullWidth&&e.paperFullWidth,t.fullScreen&&e.paperFullScreen]}})((({theme:r,ownerState:e})=>(0,o.c)({margin:32,position:"relative",overflowY:"auto","@media print":{overflowY:"visible",boxShadow:"none"}},"paper"===e.scroll&&{display:"flex",flexDirection:"column",maxHeight:"calc(100% - 64px)"},"body"===e.scroll&&{display:"inline-block",verticalAlign:"middle",textAlign:"left"},!e.maxWidth&&{maxWidth:"calc(100% - 64px)"},"xs"===e.maxWidth&&{maxWidth:"px"===r.breakpoints.unit?Math.max(r.breakpoints.values.xs,444):`max(${r.breakpoints.values.xs}${r.breakpoints.unit}, 444px)`,[`&.${b.paperScrollBody}`]:{[r.breakpoints.down(Math.max(r.breakpoints.values.xs,444)+64)]:{maxWidth:"calc(100% - 64px)"}}},e.maxWidth&&"xs"!==e.maxWidth&&{maxWidth:`${r.breakpoints.values[e.maxWidth]}${r.breakpoints.unit}`,[`&.${b.paperScrollBody}`]:{[r.breakpoints.down(r.breakpoints.values[e.maxWidth]+64)]:{maxWidth:"calc(100% - 64px)"}}},e.fullWidth&&{width:"calc(100% - 64px)"},e.fullScreen&&{margin:0,width:"100%",maxWidth:"100%",height:"100%",maxHeight:"none",borderRadius:0,[`&.${b.paperScrollBody}`]:{margin:0,maxWidth:"100%"}}))),D=n.forwardRef((function(r,e){const t=(0,m.c)({props:r,name:"MuiDialog"}),d=(0,S.c)(),g={enter:d.transitions.duration.enteringScreen,exit:d.transitions.duration.leavingScreen},{"aria-describedby":x,"aria-labelledby":v,BackdropComponent:b,BackdropProps:W,children:D,className:T,disableEscapeKeyDown:$=!1,fullScreen:R=!1,fullWidth:N=!1,maxWidth:j="sm",onBackdropClick:A,onClose:F,open:E,PaperComponent:I=h.c,PaperProps:K={},scroll:z="paper",TransitionComponent:X=u.c,transitionDuration:Y=g,TransitionProps:_}=t,G=(0,a.c)(t,k),H=(0,o.c)({},t,{disableEscapeKeyDown:$,fullScreen:R,fullWidth:N,maxWidth:j,scroll:z}),L=(r=>{const{classes:e,scroll:t,maxWidth:a,fullWidth:o,fullScreen:n}=r,i={root:["root"],container:["container",`scroll${(0,s.c)(t)}`],paper:["paper",`paperScroll${(0,s.c)(t)}`,`paperWidth${(0,s.c)(String(a))}`,o&&"paperFullWidth",n&&"paperFullScreen"]};return(0,l.c)(i,f,e)})(H),O=n.useRef(),J=function(r){if(void 0!==p){const e=p();return null!=r?r:e}return function(r){const[e,t]=n.useState(r),a=r||e;return n.useEffect((()=>{null==e&&(c+=1,t(`mui-${c}`))}),[e]),a}(r)}(v),q=n.useMemo((()=>({titleId:J})),[J]);return(0,w.jsx)(M,(0,o.c)({className:(0,i.c)(L.root,T),closeAfterTransition:!0,components:{Backdrop:B},componentsProps:{backdrop:(0,o.c)({transitionDuration:Y,as:b},W)},disableEscapeKeyDown:$,onClose:F,open:E,ref:e,onClick:r=>{O.current&&(O.current=null,A&&A(r),F&&F(r,"backdropClick"))},ownerState:H},G,{children:(0,w.jsx)(X,(0,o.c)({appear:!0,in:E,timeout:Y,role:"presentation"},_,{children:(0,w.jsx)(P,{className:(0,i.c)(L.container),onMouseDown:r=>{O.current=r.target===r.currentTarget},ownerState:H,children:(0,w.jsx)(C,(0,o.c)({as:I,elevation:24,role:"dialog","aria-describedby":x,"aria-labelledby":J},K,{className:(0,i.c)(L.paper,K.className),ownerState:H,children:(0,w.jsx)(y.c.Provider,{value:q,children:D})}))})}))}))}))},88736:(r,e,t)=>{t.d(e,{c:()=>a});const a=t(51280).createContext({})},49774:(r,e,t)=>{t.d(e,{c:()=>P});var a=t(45072),o=t(95656),n=t(51280),i=t(65456),l=t(53864),c=t(6544),p=t(94328);const s=["sx"];var d=t(44404),u=t(826),h=t(73068),m=t(60888),g=t(40608);function x(r){return(0,g.cp)("MuiTypography",r)}(0,m.c)("MuiTypography",["root","h1","h2","h3","h4","h5","h6","subtitle1","subtitle2","body1","body2","inherit","button","caption","overline","alignLeft","alignRight","alignCenter","alignJustify","noWrap","gutterBottom","paragraph"]);var v=t(17624);const f=["align","className","component","gutterBottom","noWrap","paragraph","variant","variantMapping"],b=(0,d.cp)("span",{name:"MuiTypography",slot:"Root",overridesResolver:(r,e)=>{const{ownerState:t}=r;return[e.root,t.variant&&e[t.variant],"inherit"!==t.align&&e[`align${(0,h.c)(t.align)}`],t.noWrap&&e.noWrap,t.gutterBottom&&e.gutterBottom,t.paragraph&&e.paragraph]}})((({theme:r,ownerState:e})=>(0,a.c)({margin:0},"inherit"===e.variant&&{font:"inherit"},"inherit"!==e.variant&&r.typography[e.variant],"inherit"!==e.align&&{textAlign:e.align},e.noWrap&&{overflow:"hidden",textOverflow:"ellipsis",whiteSpace:"nowrap"},e.gutterBottom&&{marginBottom:"0.35em"},e.paragraph&&{marginBottom:16}))),y={h1:"h1",h2:"h2",h3:"h3",h4:"h4",h5:"h5",h6:"h6",subtitle1:"h6",subtitle2:"h6",body1:"p",body2:"p",inherit:"p"},W={primary:"primary.main",textPrimary:"text.primary",secondary:"secondary.main",textSecondary:"text.secondary",error:"error.main"},S=n.forwardRef((function(r,e){const t=(0,u.c)({props:r,name:"MuiTypography"}),n=(r=>W[r]||r)(t.color),d=function(r){const{sx:e}=r,t=(0,o.c)(r,s),{systemProps:n,otherProps:i}=(r=>{var e,t;const a={systemProps:{},otherProps:{}},o=null!=(e=null==r||null==(t=r.theme)?void 0:t.unstable_sxConfig)?e:p.c;return Object.keys(r).forEach((e=>{o[e]?a.systemProps[e]=r[e]:a.otherProps[e]=r[e]})),a})(t);let l;return l=Array.isArray(e)?[n,...e]:"function"==typeof e?(...r)=>{const t=e(...r);return(0,c.o)(t)?(0,a.c)({},n,t):n}:(0,a.c)({},n,e),(0,a.c)({},i,{sx:l})}((0,a.c)({},t,{color:n})),{align:m="inherit",className:g,component:S,gutterBottom:w=!1,noWrap:k=!1,paragraph:B=!1,variant:M="body1",variantMapping:P=y}=d,C=(0,o.c)(d,f),D=(0,a.c)({},d,{align:m,color:n,className:g,component:S,gutterBottom:w,noWrap:k,paragraph:B,variant:M,variantMapping:P}),T=S||(B?"p":P[M]||y[M])||"span",$=(r=>{const{align:e,gutterBottom:t,noWrap:a,paragraph:o,variant:n,classes:i}=r,c={root:["root",n,"inherit"!==r.align&&`align${(0,h.c)(e)}`,t&&"gutterBottom",a&&"noWrap",o&&"paragraph"]};return(0,l.c)(c,x,i)})(D);return(0,v.jsx)(b,(0,a.c)({as:T,ref:e,ownerState:D,className:(0,i.c)($.root,g)},C))}));var w=t(25132),k=t(88736);const B=["className","id"],M=(0,d.cp)(S,{name:"MuiDialogTitle",slot:"Root",overridesResolver:(r,e)=>e.root})({padding:"16px 24px",flex:"0 0 auto"}),P=n.forwardRef((function(r,e){const t=(0,u.c)({props:r,name:"MuiDialogTitle"}),{className:c,id:p}=t,s=(0,o.c)(t,B),d=t,h=(r=>{const{classes:e}=r;return(0,l.c)({root:["root"]},w.G,e)})(d),{titleId:m=p}=n.useContext(k.c);return(0,v.jsx)(M,(0,a.c)({component:"h2",className:(0,i.c)(h.root,c),ownerState:d,ref:e,variant:"h6",id:null!=p?p:m},s))}))},25132:(r,e,t)=>{t.d(e,{G:()=>n,c:()=>i});var a=t(60888),o=t(40608);function n(r){return(0,o.cp)("MuiDialogTitle",r)}const i=(0,a.c)("MuiDialogTitle",["root"])},73068:(r,e,t)=>{t.d(e,{c:()=>a});const a=t(82368).c}}]);