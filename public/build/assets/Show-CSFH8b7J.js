import{J as c}from"./JigLayout-C42nlb8G.js";import{I as m}from"./InertiaButton-CgApzWcp.js";import p from"./ShowForm-DN1-kSZQ.js";import{_ as f}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{l as _,a as h,w as o,r as t,o as s,b as a,d as r,h as u,t as w,e as n}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./DisplayMixin-FmpNKeTc.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./JigDd-DtnlwjZF.js";const x=_({name:"ShowReservationPlace",components:{InertiaButton:m,JigLayout:c,ShowReservationPlacesForm:p},props:{model:Object},data(){return{}},mounted(){},methods:{}}),v={class:"flex flex-wrap items-center justify-between w-full px-4"},k=a("i",{class:"fas fa-arrow-left"},null,-1),b={key:0,class:"flex flex-wrap px-4"},g={class:"z-10 flex-auto max-w-5xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"},y={key:1,class:"px-4 text-lg font-bold text-center text-red-500 bg-white rounded-md shadow-md space-4"};function B(e,j,S,$,C,N){const i=t("inertia-link"),l=t("show-reservation-places-form"),d=t("jig-layout");return s(),h(d,null,{header:o(()=>[a("div",v,[r(i,{href:e.route("admin.reservation-places.index"),class:"text-2xl font-black text-white"},{default:o(()=>[k,u(" Back | Details of Reservation Place #"+w(e.model.id),1)]),_:1},8,["href"])])]),default:o(()=>[e.model.can.view?(s(),n("div",b,[a("div",g,[r(l,{model:e.model},null,8,["model"])])])):(s(),n("div",y," You don't have permission to view this resource. "))]),_:1})}const L=f(x,[["render",B]]);export{L as default};
