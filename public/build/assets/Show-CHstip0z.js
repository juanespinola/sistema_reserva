import{J as m}from"./JigLayout-C42nlb8G.js";import{I as c}from"./InertiaButton-CgApzWcp.js";import p from"./ShowForm-CC5tJTtP.js";import{_ as f}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{l as _,a as h,w as o,r as t,o as s,b as n,d as a,h as u,t as w,e as r}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./DisplayMixin-FmpNKeTc.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./JigDd-DtnlwjZF.js";const x=_({name:"ShowInventory",components:{InertiaButton:c,JigLayout:m,ShowInventoriesForm:p},props:{model:Object},data(){return{}},mounted(){},methods:{}}),v={class:"flex flex-wrap items-center justify-between w-full px-4"},k=n("i",{class:"fas fa-arrow-left"},null,-1),y={key:0,class:"flex flex-wrap px-4"},b={class:"z-10 flex-auto max-w-5xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"},g={key:1,class:"px-4 text-lg font-bold text-center text-red-500 bg-white rounded-md shadow-md space-4"};function B(e,I,j,S,$,C){const i=t("inertia-link"),d=t("show-inventories-form"),l=t("jig-layout");return s(),h(l,null,{header:o(()=>[n("div",v,[a(i,{href:e.route("admin.inventories.index"),class:"text-2xl font-black text-white"},{default:o(()=>[k,u(" Back | Details of Inventory #"+w(e.model.id),1)]),_:1},8,["href"])])]),default:o(()=>[e.model.can.view?(s(),r("div",y,[n("div",b,[a(d,{model:e.model},null,8,["model"])])])):(s(),r("div",g," You don't have permission to view this resource. "))]),_:1})}const T=f(x,[["render",B]]);export{T as default};
