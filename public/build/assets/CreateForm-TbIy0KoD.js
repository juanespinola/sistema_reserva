import{J as o}from"./Label-CK0f_1Hr.js";import{I as a}from"./InertiaButton-CgApzWcp.js";import{J as i}from"./InputError-Yl9b8Rx0.js";import{l as n,u as m,e as c,b as l,d,w as f,j as p,r as u,o as h,h as b}from"./main-CCoSWOgv.js";import{_}from"./_plugin-vue_export-helper-DlAUqK2U.js";const $=n({name:"CreateTransactionsForm",components:{InertiaButton:a,JetInputError:i,JetLabel:o},data(){return{form:m({},{remember:!1})}},mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{async storeModel(){this.form.post(this.route("admin.transactions.store"),{onSuccess:e=>{this.flash.success?this.$emit("success",this.flash.success):this.flash.error?this.$emit("error",this.flash.error):this.$emit("error","Unknown server error.")},onError:e=>{this.$emit("error","A server error occurred")}},{remember:!1,preserveState:!0})}}}),v={class:"mt-2 text-right"};function w(e,s,C,g,B,J){const r=u("inertia-button");return h(),c("form",{class:"w-full",onSubmit:s[0]||(s[0]=p((...t)=>e.storeModel&&e.storeModel(...t),["prevent"]))},[l("div",v,[d(r,{type:"submit",class:"font-semibold bg-success disabled:opacity-25",disabled:e.form.processing},{default:f(()=>[b("Submit")]),_:1},8,["disabled"])])],32)}const E=_($,[["render",w]]);export{E as default};
