import{J as c}from"./JigLayout-C42nlb8G.js";import{I as l}from"./InertiaButton-CgApzWcp.js";import m from"./CreateForm-D-RYLzyp.js";import{D as d}from"./DisplayMixin-FmpNKeTc.js";import{_ as p}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{l as f,a as u,w as t,r as s,o as h,b as o,d as r,h as _}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./Input-loptDDaH.js";import"./Label-CK0f_1Hr.js";import"./InputError-Yl9b8Rx0.js";const x=f({name:"CreateShelves",components:{InertiaButton:l,JigLayout:c,CreateShelvesForm:m},data(){return{}},mixins:[d],mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{onSuccess(e){this.displayNotification("success",e),this.$inertia.visit(route("admin.shelves.index"))},onError(e){this.displayNotification("error",e)}}}),w={class:"flex flex-wrap items-center justify-between w-full px-4"},v=o("i",{class:"fas fa-arrow-left"},null,-1),y={class:"flex flex-wrap px-4"},S={class:"z-10 flex-auto max-w-2xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"};function k(e,C,N,$,g,B){const a=s("inertia-link"),n=s("create-shelves-form"),i=s("jig-layout");return h(),u(i,null,{header:t(()=>[o("div",w,[r(a,{href:e.route("admin.shelves.index"),class:"text-xl font-black text-white"},{default:t(()=>[v,_(" Back | New Shelf ")]),_:1},8,["href"])])]),default:t(()=>[o("div",y,[o("div",S,[r(n,{onSuccess:e.onSuccess,onError:e.onError},null,8,["onSuccess","onError"])])])]),_:1})}const T=p(x,[["render",k]]);export{T as default};
