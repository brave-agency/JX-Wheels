"use strict";(globalThis.webpackChunkcomplianz_gdpr=globalThis.webpackChunkcomplianz_gdpr||[]).push([[3452],{33452:(s,i,n)=>{n.r(i),n.d(i,{default:()=>o});var e=n(30809),l=n(524),t=n(93396),a=n(61744);const o=(0,e.Su)(((s,i)=>({loaded:!1,plugins:[{slug:"complianz-terms-conditions",description:(0,t.__)("Need Terms & Conditions? Configure now.","complianz-gdpr"),status:"not-installed",processing:!1},{slug:"burst-statistics",premium:"burst-pro",description:(0,t.__)("Privacy-Friendly Analytics? Here you go!","complianz-gdpr"),status:"not-installed",processing:!1},{slug:"really-simple-ssl",description:(0,t.__)("Really Simple Security? Install now!","complianz-gdpr"),status:"not-installed",processing:!1}],isUpgrade:!1,processing:!0,email:"",includeTips:!1,sendTestEmail:!0,actionStatus:"",modalVisible:!0,setIncludeTips:i=>{s((s=>({includeTips:i})))},setSendTestEmail:i=>{s((s=>({sendTestEmail:i})))},setEmail:i=>{s((s=>({email:i})))},dismissModal:()=>{const i=new URL(window.location.href);i.searchParams.delete("onboarding"),window.history.pushState({},"",i.href),s((s=>({modalVisible:!1})))},saveEmail:async()=>{let n={};n.email=i().email,n.includeTips=i().includeTips,n.sendTestEmail=i().sendTestEmail,s((s=>({processing:!0}))),await a.doAction("update_email",n).then((s=>s)),s((()=>({processing:!1})))},getRecommendedPluginsStatus:async()=>{const n={};n.plugins=i().plugins;const{plugins:e,isUpgrade:l}=await a.doAction("get_recommended_plugins_status",n).then((async s=>s));s({processing:!1,plugins:e,isUpgrade:l,loaded:!0})},setProcessing:(i,n)=>{s((0,l.Ut)((s=>{const e=s.plugins.findIndex((s=>s.slug===i));-1!==e&&(s.plugins[e].processing=n)})))},pluginAction:async(n,e)=>{const l={};l.slug=n,l.plugins=i().plugins,i().setProcessing(n,!0);const{plugins:t}=await a.doAction(e,l).then((async s=>s));s({plugins:t})}})))}}]);