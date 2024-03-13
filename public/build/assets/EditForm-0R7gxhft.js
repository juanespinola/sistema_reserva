import{J as j}from"./Label-CK0f_1Hr.js";import{I as T}from"./InertiaButton-CgApzWcp.js";import{J as x}from"./InputError-Yl9b8Rx0.js";import{u as y,a as V,w as a,n as m,r as o,o as A,d as s,h as b,b as n,j as J}from"./main-CCoSWOgv.js";import{J as w}from"./Input-loptDDaH.js";import{J as k,a as C,b as B}from"./JigTab-Nr0OKfxE.js";import I from"./AssignPerms-DbWqq1gc.js";import{_ as N}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./Checkbox-f85nBy3B.js";import"./axios-BPmCjaAx.js";import"./DisplayMixin-FmpNKeTc.js";const E={name:"EditRolesForm",props:{model:Object,permissions:Object},components:{AssignPerms:I,JigTab:k,JigTabLink:C,JigTabs:B,InertiaButton:T,JetLabel:j,JetInputError:x,JetInput:w},data(){return{form:y({...this.model},{remember:!1}),activeTab:"basic-info",tabActiveClasses:"bg-primary font-bold text-secondary rounded-t-lg hover:bg-primary-200 hover:text-gray-800"}},mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{async updateModel(){this.form.put(this.route("admin.roles.update",this.form.id),{onSuccess:i=>{this.flash.success?this.$emit("success",this.flash.success):this.flash.error?this.$emit("error",this.flash.error):this.$emit("error","Unknown server error.")},onError:i=>{this.$emit("error","A server error occurred")}},{remember:!1,preserveState:!0})},setTab(i){this.activeTab=i}}},M={class:"sm:col-span-4"},S={class:"sm:col-span-4"},U={class:"sm:col-span-4"},F={class:"mt-2 text-right"};function L(i,r,f,O,e,l){const p=o("jig-tab-link"),c=o("jet-label"),u=o("jet-input"),d=o("jet-input-error"),g=o("inertia-button"),_=o("jig-tab"),v=o("assign-perms"),h=o("jig-tabs");return A(),V(h,{class:m("border-none"),"nav-classes":"bg-secondary-300 rounded-t-lg border-b-4 border-primary"},{nav:a(()=>[s(p,{onActivate:l.setTab,"active-classes":e.tabActiveClasses,"tab-controller":e.activeTab,tab:"basic-info"},{default:a(()=>[b("Basic Info ")]),_:1},8,["onActivate","active-classes","tab-controller"]),s(p,{onActivate:l.setTab,"active-classes":e.tabActiveClasses,"tab-controller":e.activeTab,tab:"assign-permissions"},{default:a(()=>[b("Assign Permissions ")]),_:1},8,["onActivate","active-classes","tab-controller"])]),content:a(()=>[s(_,{name:"basic-info","tab-controller":e.activeTab},{default:a(()=>[n("form",{onSubmit:r[3]||(r[3]=J((...t)=>l.updateModel&&l.updateModel(...t),["prevent"]))},[n("div",M,[s(c,{for:"name",value:"Name"}),s(u,{class:m(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.name}]),type:"text",id:"name",name:"name",modelValue:e.form.name,"onUpdate:modelValue":r[0]||(r[0]=t=>e.form.name=t)},null,8,["modelValue","class"]),s(d,{message:e.form.errors.name,class:"mt-2"},null,8,["message"])]),n("div",S,[s(c,{for:"title",value:"Title"}),s(u,{class:m(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.title}]),type:"text",id:"title",name:"title",modelValue:e.form.title,"onUpdate:modelValue":r[1]||(r[1]=t=>e.form.title=t)},null,8,["modelValue","class"]),s(d,{message:e.form.errors.title,class:"mt-2"},null,8,["message"])]),n("div",U,[s(c,{for:"guard_name",value:"Guard Name"}),s(u,{class:m(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.guard_name}]),type:"text",id:"guard_name",name:"guard_name",modelValue:e.form.guard_name,"onUpdate:modelValue":r[2]||(r[2]=t=>e.form.guard_name=t)},null,8,["modelValue","class"]),s(d,{message:e.form.errors.guard_name,class:"mt-2"},null,8,["message"])]),n("div",F,[s(g,{type:"submit",class:"bg-primary font-semibold text-white",disabled:e.form.processing},{default:a(()=>[b("Submit")]),_:1},8,["disabled"])])],32)]),_:1},8,["tab-controller"]),s(_,{name:"assign-permissions","tab-controller":e.activeTab},{default:a(()=>[s(v,{role:f.model,permissions:f.permissions},null,8,["role","permissions"])]),_:1},8,["tab-controller"])]),_:1})}const Y=N(E,[["render",L]]);export{Y as default};
