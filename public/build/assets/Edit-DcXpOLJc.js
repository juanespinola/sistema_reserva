import{J as l}from"./JigLayout-C42nlb8G.js";import{J as m}from"./Label-CK0f_1Hr.js";import{I as d}from"./InertiaButton-CgApzWcp.js";import{J as c}from"./InputError-Yl9b8Rx0.js";import{J as p}from"./Button-DpvrAl-U.js";import f from"./EditForm-DCV_Ka9t.js";import{D as u}from"./DisplayMixin-FmpNKeTc.js";import{_}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{l as h,a as x,w as e,r as s,o as w,b as t,d as r,h as E,t as y}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./JigDatepicker-_1b8EtFo.js";import"./component-DnD0jkPy.js";import"./Input-loptDDaH.js";const J=h({name:"EditSales",props:{model:Object},components:{InertiaButton:d,JetLabel:m,JetButton:p,JetInputError:c,JigLayout:l,EditSalesForm:f},data(){return{}},mixins:[u],mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{onSuccess(o){this.displayNotification("success",o),this.$inertia.visit(route("admin.sales.index"))},onError(o){this.displayNotification("error",o)}}}),S={class:"flex flex-wrap items-center justify-between w-full px-4"},b=t("i",{class:"fas fa-arrow-left"},null,-1),g={class:"flex flex-wrap px-4"},k={class:"z-10 flex-auto max-w-2xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"};function B(o,$,v,N,j,C){const a=s("inertia-link"),i=s("edit-sales-form"),n=s("jig-layout");return w(),x(n,null,{header:e(()=>[t("div",S,[r(a,{href:o.route("admin.sales.index"),class:"text-xl font-black text-white"},{default:e(()=>[b,E(" Back | Edit Sale #"+y(o.model.id),1)]),_:1},8,["href"])])]),default:e(()=>[t("div",g,[t("div",k,[r(i,{model:o.model,onSuccess:o.onSuccess,onError:o.onError},null,8,["model","onSuccess","onError"])])])]),_:1})}const P=_(J,[["render",B]]);export{P as default};