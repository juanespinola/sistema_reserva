import{J as p}from"./Label-CK0f_1Hr.js";import{I as f}from"./InertiaButton-CgApzWcp.js";import{J as c}from"./InputError-Yl9b8Rx0.js";import{l as h,u as b,e as g,b as t,d as r,n,w as V,j as v,r as a,o as y,h as _}from"./main-CCoSWOgv.js";import{J as w}from"./Input-loptDDaH.js";import{I as $}from"./InfiniteSelect-BfhbGX6f.js";import{_ as j}from"./_plugin-vue_export-helper-DlAUqK2U.js";const q=h({name:"EditPurchasesDetailForm",props:{model:Object},components:{InertiaButton:f,JetLabel:p,JetInputError:c,JetInput:w,InfiniteSelect:$},data(){return{form:b({...this.model},{remember:!1})}},mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{async updateModel(){this.form.put(this.route("admin.purchases-details.update",this.form.id),{onSuccess:e=>{this.flash.success?this.$emit("success",this.flash.success):this.flash.error?this.$emit("error",this.flash.error):this.$emit("error","Unknown server error.")},onError:e=>{this.$emit("error","A server error occurred")}},{remember:!1,preserveState:!0})}}}),I={class:"sm:col-span-4"},J={class:"sm:col-span-4"},E={class:"sm:col-span-4"},S={class:"sm:col-span-4"},U={class:"mt-2 text-right"};function B(e,s,C,M,P,k){const l=a("jet-label"),u=a("jet-input"),m=a("jet-input-error"),i=a("infinite-select"),d=a("inertia-button");return y(),g("form",{onSubmit:s[4]||(s[4]=v((...o)=>e.updateModel&&e.updateModel(...o),["prevent"]))},[t("div",I,[r(l,{for:"quantity",value:"Quantity"}),r(u,{class:n(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.quantity}]),type:"number",id:"quantity",name:"quantity",modelValue:e.form.quantity,"onUpdate:modelValue":s[0]||(s[0]=o=>e.form.quantity=o)},null,8,["modelValue","class"]),r(m,{message:e.form.errors.quantity,class:"mt-2"},null,8,["message"])]),t("div",J,[r(l,{for:"total_amount",value:"Total Amount"}),r(u,{class:n(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.total_amount}]),type:"text",id:"total_amount",name:"total_amount",modelValue:e.form.total_amount,"onUpdate:modelValue":s[1]||(s[1]=o=>e.form.total_amount=o)},null,8,["modelValue","class"]),r(m,{message:e.form.errors.total_amount,class:"mt-2"},null,8,["message"])]),t("div",E,[r(l,{for:"product",value:"Product"}),r(i,{class:n(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.product}]),"per-page":15,"api-url":e.route("api.products.index"),id:"product",name:"product",modelValue:e.form.product,"onUpdate:modelValue":s[2]||(s[2]=o=>e.form.product=o),label:"name"},null,8,["api-url","modelValue","class"]),r(m,{message:e.form.errors.product,class:"mt-2"},null,8,["message"])]),t("div",S,[r(l,{for:"purchase",value:"Purchase"}),r(i,{class:n(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.purchase}]),"per-page":15,"api-url":e.route("api.purchases.index"),id:"purchase",name:"purchase",modelValue:e.form.purchase,"onUpdate:modelValue":s[3]||(s[3]=o=>e.form.purchase=o),label:"id"},null,8,["api-url","modelValue","class"]),r(m,{message:e.form.errors.purchase,class:"mt-2"},null,8,["message"])]),t("div",U,[r(d,{type:"submit",class:"font-semibold text-white bg-primary",disabled:e.form.processing},{default:V(()=>[_("Submit")]),_:1},8,["disabled"])])],32)}const O=j(q,[["render",B]]);export{O as default};
