import{J as c}from"./JigLayout-C42nlb8G.js";import{I as _}from"./InertiaButton-CgApzWcp.js";import f from"./ShowForm-BhrLkluU.js";import{_ as p}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{a as h,w as o,r as t,o as s,b as a,d as r,h as u,t as x,e as n}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./DisplayMixin-FmpNKeTc.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./JigDd-DtnlwjZF.js";const w={name:"ShowRoles",components:{InertiaButton:_,JigLayout:c,ShowRolesForm:f},props:{model:Object},data(){return{}},mounted(){},methods:{}},k={class:"flex flex-wrap items-center justify-between w-full px-4"},v=a("i",{class:"fas fa-arrow-left"},null,-1),b={key:0,class:"flex flex-wrap px-4"},g={class:"z-10 flex-auto max-w-5xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"},y={key:1,class:"text-center space-4 px-4 bg-white rounded-md shadow-md text-red-500 font-bold text-lg"};function B(l,j,e,S,N,R){const i=t("inertia-link"),d=t("show-roles-form"),m=t("jig-layout");return s(),h(m,null,{header:o(()=>[a("div",k,[r(i,{href:l.route("admin.roles.index"),class:"text-2xl font-black text-white"},{default:o(()=>[v,u(" Back | Details of Role #"+x(e.model.id),1)]),_:1},8,["href"])])]),default:o(()=>[e.model.can.view?(s(),n("div",b,[a("div",g,[r(d,{model:e.model},null,8,["model"])])])):(s(),n("div",y," You don't have permission to view this resource. "))]),_:1})}const O=p(w,[["render",B]]);export{O as default};