import{J as c}from"./JigLayout-C42nlb8G.js";import{I as m}from"./InertiaButton-CgApzWcp.js";import p from"./ShowForm-dIDhVfKv.js";import{_ as f}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{l as h,a as u,w as t,r as o,o as s,b as a,d as r,h as _,t as w,e as n}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./DisplayMixin-FmpNKeTc.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./JigDd-DtnlwjZF.js";const x=h({name:"ShowPurchasesDetail",components:{InertiaButton:m,JigLayout:c,ShowPurchasesDetailsForm:p},props:{model:Object},data(){return{}},mounted(){},methods:{}}),k={class:"flex flex-wrap items-center justify-between w-full px-4"},v=a("i",{class:"fas fa-arrow-left"},null,-1),b={key:0,class:"flex flex-wrap px-4"},g={class:"z-10 flex-auto max-w-5xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"},y={key:1,class:"px-4 text-lg font-bold text-center text-red-500 bg-white rounded-md shadow-md space-4"};function B(e,D,j,S,$,C){const i=o("inertia-link"),l=o("show-purchases-details-form"),d=o("jig-layout");return s(),u(d,null,{header:t(()=>[a("div",k,[r(i,{href:e.route("admin.purchases-details.index"),class:"text-2xl font-black text-white"},{default:t(()=>[v,_(" Back | Details of Purchases Detail #"+w(e.model.id),1)]),_:1},8,["href"])])]),default:t(()=>[e.model.can.view?(s(),n("div",b,[a("div",g,[r(l,{model:e.model},null,8,["model"])])])):(s(),n("div",y," You don't have permission to view this resource. "))]),_:1})}const O=f(x,[["render",B]]);export{O as default};
