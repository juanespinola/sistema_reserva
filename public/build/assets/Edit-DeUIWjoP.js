import{J as m}from"./JigLayout-C42nlb8G.js";import{J as d}from"./Label-CK0f_1Hr.js";import{I as c}from"./InertiaButton-CgApzWcp.js";import{J as l}from"./InputError-Yl9b8Rx0.js";import{J as p}from"./Button-DpvrAl-U.js";import u from"./EditForm-baoxzcmY.js";import{D as f}from"./DisplayMixin-FmpNKeTc.js";import{_}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{l as h,a as x,w as e,r as s,o as w,b as t,d as r,h as E,t as y}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./Input-loptDDaH.js";const J=h({name:"EditCustomers",props:{model:Object},components:{InertiaButton:c,JetLabel:d,JetButton:p,JetInputError:l,JigLayout:m,EditCustomersForm:u},data(){return{}},mixins:[f],mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{onSuccess(o){this.displayNotification("success",o),this.$inertia.visit(route("admin.customers.index"))},onError(o){this.displayNotification("error",o)}}}),b={class:"flex flex-wrap items-center justify-between w-full px-4"},g=t("i",{class:"fas fa-arrow-left"},null,-1),k={class:"flex flex-wrap px-4"},B={class:"z-10 flex-auto max-w-2xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"};function C(o,$,v,N,S,j){const i=s("inertia-link"),a=s("edit-customers-form"),n=s("jig-layout");return w(),x(n,null,{header:e(()=>[t("div",b,[r(i,{href:o.route("admin.customers.index"),class:"text-xl font-black text-white"},{default:e(()=>[g,E(" Back | Edit Customer #"+y(o.model.id),1)]),_:1},8,["href"])])]),default:e(()=>[t("div",k,[t("div",B,[r(a,{model:o.model,onSuccess:o.onSuccess,onError:o.onError},null,8,["model","onSuccess","onError"])])])]),_:1})}const H=_(J,[["render",C]]);export{H as default};