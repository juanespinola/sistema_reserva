import{J as d}from"./Label-CK0f_1Hr.js";import{I as p}from"./InertiaButton-CgApzWcp.js";import{J as u}from"./InputError-Yl9b8Rx0.js";import{l as f,u as c,e as h,b as a,d as s,n as b,w as _,j as v,r as t,o as $,h as j}from"./main-CCoSWOgv.js";import{J as g}from"./Input-loptDDaH.js";import{_ as w}from"./_plugin-vue_export-helper-DlAUqK2U.js";const J=f({name:"EditShelfForm",props:{model:Object},components:{InertiaButton:p,JetLabel:d,JetInputError:u,JetInput:g},data(){return{form:c({...this.model},{remember:!1})}},mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{async updateModel(){this.form.put(this.route("admin.shelves.update",this.form.id),{onSuccess:e=>{this.flash.success?this.$emit("success",this.flash.success):this.flash.error?this.$emit("error",this.flash.error):this.$emit("error","Unknown server error.")},onError:e=>{this.$emit("error","A server error occurred")}},{remember:!1,preserveState:!0})}}}),S={class:"sm:col-span-4"},V={class:"mt-2 text-right"};function E(e,r,y,B,C,I){const n=t("jet-label"),m=t("jet-input"),i=t("jet-input-error"),l=t("inertia-button");return $(),h("form",{onSubmit:r[1]||(r[1]=v((...o)=>e.updateModel&&e.updateModel(...o),["prevent"]))},[a("div",S,[s(n,{for:"name",value:"Name"}),s(m,{class:b(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.name}]),type:"text",id:"name",name:"name",modelValue:e.form.name,"onUpdate:modelValue":r[0]||(r[0]=o=>e.form.name=o)},null,8,["modelValue","class"]),s(i,{message:e.form.errors.name,class:"mt-2"},null,8,["message"])]),a("div",V,[s(l,{type:"submit",class:"font-semibold text-white bg-primary",disabled:e.form.processing},{default:_(()=>[j("Submit")]),_:1},8,["disabled"])])],32)}const z=w(J,[["render",E]]);export{z as default};
