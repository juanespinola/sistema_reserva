import{J as c}from"./JigLayout-C42nlb8G.js";import{I as d}from"./InertiaButton-CgApzWcp.js";import m from"./CreateForm-B8rm1oIb.js";import{D as p}from"./DisplayMixin-FmpNKeTc.js";import{_ as l}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{l as u,a as f,w as e,r,o as _,b as t,d as s,h}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./Input-loptDDaH.js";import"./JigTextarea-Dj0pklsY.js";import"./InfiniteSelect-BfhbGX6f.js";import"./Label-CK0f_1Hr.js";import"./InputError-Yl9b8Rx0.js";const x=u({name:"CreateProducts",components:{InertiaButton:d,JigLayout:c,CreateProductsForm:m},data(){return{}},mixins:[p],mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{onSuccess(o){this.displayNotification("success",o),this.$inertia.visit(route("admin.products.index"))},onError(o){this.displayNotification("error",o)}}}),w={class:"flex flex-wrap items-center justify-between w-full px-4"},y=t("i",{class:"fas fa-arrow-left"},null,-1),k={class:"flex flex-wrap px-4"},C={class:"z-10 flex-auto max-w-2xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"};function N(o,$,g,v,B,b){const a=r("inertia-link"),i=r("create-products-form"),n=r("jig-layout");return _(),f(n,null,{header:e(()=>[t("div",w,[s(a,{href:o.route("admin.products.index"),class:"text-xl font-black text-white"},{default:e(()=>[y,h(" Back | New Product ")]),_:1},8,["href"])])]),default:e(()=>[t("div",k,[t("div",C,[s(i,{onSuccess:o.onSuccess,onError:o.onError},null,8,["onSuccess","onError"])])])]),_:1})}const q=l(x,[["render",N]]);export{q as default};