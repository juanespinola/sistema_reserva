import{J as c}from"./JigLayout-C42nlb8G.js";import{I as _}from"./InertiaButton-CgApzWcp.js";import f from"./ShowForm-DONijgH3.js";import{_ as p}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{a as h,w as o,r as t,o as s,b as a,d as i,h as u,t as x,e as n}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./DisplayMixin-FmpNKeTc.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./JigDd-DtnlwjZF.js";const w={name:"ShowPermission",components:{InertiaButton:_,JigLayout:c,ShowPermissionsForm:f},props:{model:Object},data(){return{}},mounted(){},methods:{}},k={class:"flex flex-wrap items-center justify-between w-full px-4"},v=a("i",{class:"fas fa-arrow-left"},null,-1),b={key:0,class:"flex flex-wrap px-4"},g={class:"z-10 flex-auto max-w-5xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"},y={key:1,class:"text-center space-4 px-4 bg-white rounded-md shadow-md text-red-500 font-bold text-lg"};function B(r,j,e,S,N,P){const m=t("inertia-link"),d=t("show-permissions-form"),l=t("jig-layout");return s(),h(l,null,{header:o(()=>[a("div",k,[i(m,{href:r.route("admin.permissions.index"),class:"text-2xl font-black text-white"},{default:o(()=>[v,u(" Back | Details of Permission #"+x(e.model.id),1)]),_:1},8,["href"])])]),default:o(()=>[e.model.can.view?(s(),n("div",b,[a("div",g,[i(d,{model:e.model},null,8,["model"])])])):(s(),n("div",y," You don't have permission to view this resource. "))]),_:1})}const O=p(w,[["render",B]]);export{O as default};