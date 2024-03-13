import{J as p}from"./Label-CK0f_1Hr.js";import{I as c}from"./InertiaButton-CgApzWcp.js";import{J as f}from"./InputError-Yl9b8Rx0.js";import{l as b,u as h,e as v,b as m,d as r,n as l,w as g,j as _,r as t,o as V,h as $}from"./main-CCoSWOgv.js";import{J as j}from"./JigTextarea-Dj0pklsY.js";import{I as w}from"./InfiniteSelect-BfhbGX6f.js";import{_ as C}from"./_plugin-vue_export-helper-DlAUqK2U.js";const J=b({name:"EditCommentForm",props:{model:Object},components:{InertiaButton:c,JetLabel:p,JetInputError:f,JigTextarea:j,InfiniteSelect:w},data(){return{form:h({...this.model},{remember:!1})}},mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{async updateModel(){this.form.put(this.route("admin.comments.update",this.form.id),{onSuccess:e=>{this.flash.success?this.$emit("success",this.flash.success):this.flash.error?this.$emit("error",this.flash.error):this.$emit("error","Unknown server error.")},onError:e=>{this.$emit("error","A server error occurred")}},{remember:!1,preserveState:!0})}}}),E={class:"sm:col-span-4"},I={class:"sm:col-span-4"},S={class:"sm:col-span-4"},B={class:"mt-2 text-right"};function M(e,s,U,k,y,F){const a=t("jet-label"),d=t("jig-textarea"),n=t("jet-input-error"),i=t("infinite-select"),u=t("inertia-button");return V(),v("form",{onSubmit:s[3]||(s[3]=_((...o)=>e.updateModel&&e.updateModel(...o),["prevent"]))},[m("div",E,[r(a,{for:"comments",value:"Comments"}),r(d,{class:l(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.comments}]),id:"comments",name:"comments",modelValue:e.form.comments,"onUpdate:modelValue":s[0]||(s[0]=o=>e.form.comments=o)},null,8,["modelValue","class"]),r(n,{message:e.form.errors.comments,class:"mt-2"},null,8,["message"])]),m("div",I,[r(a,{for:"customer",value:"Customer"}),r(i,{class:l(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.customer}]),"per-page":15,"api-url":e.route("api.customers.index"),id:"customer",name:"customer",modelValue:e.form.customer,"onUpdate:modelValue":s[1]||(s[1]=o=>e.form.customer=o),label:"name"},null,8,["api-url","modelValue","class"]),r(n,{message:e.form.errors.customer,class:"mt-2"},null,8,["message"])]),m("div",S,[r(a,{for:"reservation_place",value:"Reservation Place"}),r(i,{class:l(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.reservation_place}]),"per-page":15,"api-url":e.route("api.reservation-places.index"),id:"reservation_place",name:"reservation_place",modelValue:e.form.reservation_place,"onUpdate:modelValue":s[2]||(s[2]=o=>e.form.reservation_place=o),label:"description"},null,8,["api-url","modelValue","class"]),r(n,{message:e.form.errors.reservation_place,class:"mt-2"},null,8,["message"])]),m("div",B,[r(u,{type:"submit",class:"font-semibold text-white bg-primary",disabled:e.form.processing},{default:g(()=>[$("Submit")]),_:1},8,["disabled"])])],32)}const R=C(J,[["render",M]]);export{R as default};
