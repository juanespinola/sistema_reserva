import{J as c}from"./JigLayout-C42nlb8G.js";import{I as m}from"./InertiaButton-CgApzWcp.js";import p from"./CreateForm-WubX2Qxn.js";import{D as l}from"./DisplayMixin-FmpNKeTc.js";import{_ as d}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{l as f,a as u,w as t,r,o as _,b as o,d as s,h}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./JigDatepicker-_1b8EtFo.js";import"./component-DnD0jkPy.js";import"./Input-loptDDaH.js";import"./InfiniteSelect-BfhbGX6f.js";import"./Label-CK0f_1Hr.js";import"./InputError-Yl9b8Rx0.js";const x=f({name:"CreateInventories",components:{InertiaButton:m,JigLayout:c,CreateInventoriesForm:p},data(){return{}},mixins:[l],mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{onSuccess(e){this.displayNotification("success",e),this.$inertia.visit(route("admin.inventories.index"))},onError(e){this.displayNotification("error",e)}}}),v={class:"flex flex-wrap items-center justify-between w-full px-4"},w=o("i",{class:"fas fa-arrow-left"},null,-1),y={class:"flex flex-wrap px-4"},k={class:"z-10 flex-auto max-w-2xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"};function C(e,N,$,g,B,I){const n=r("inertia-link"),i=r("create-inventories-form"),a=r("jig-layout");return _(),u(a,null,{header:t(()=>[o("div",v,[s(n,{href:e.route("admin.inventories.index"),class:"text-xl font-black text-white"},{default:t(()=>[w,h(" Back | New Inventory ")]),_:1},8,["href"])])]),default:t(()=>[o("div",y,[o("div",k,[s(i,{onSuccess:e.onSuccess,onError:e.onError},null,8,["onSuccess","onError"])])])]),_:1})}const G=d(x,[["render",C]]);export{G as default};