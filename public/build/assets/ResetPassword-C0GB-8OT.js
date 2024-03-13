import{H as _,e as w,d as o,w as l,F as b,r as a,o as j,b as r,n as h,h as V,j as v}from"./main-CCoSWOgv.js";import{J,a as g}from"./AuthenticationCardLogo-BVZ5SJtL.js";import{J as k}from"./Button-DpvrAl-U.js";import{J as x}from"./Input-loptDDaH.js";import{J as C}from"./Label-CK0f_1Hr.js";import{J as y}from"./ValidationErrors-B3FkXJuU.js";import{_ as P}from"./_plugin-vue_export-helper-DlAUqK2U.js";const B={components:{Head:_,JetAuthenticationCard:J,JetAuthenticationCardLogo:g,JetButton:k,JetInput:x,JetLabel:C,JetValidationErrors:y},props:{email:String,token:String},data(){return{form:this.$inertia.form({token:this.token,email:this.email,password:"",password_confirmation:""})}},methods:{submit(){this.form.post(this.route("password.update"),{onFinish:()=>this.form.reset("password","password_confirmation")})}}},H={class:"mt-4"},q={class:"mt-4"},E={class:"flex items-center justify-end mt-4"};function F(N,t,R,S,e,m){const d=a("Head"),p=a("jet-authentication-card-logo"),u=a("jet-validation-errors"),n=a("jet-label"),i=a("jet-input"),c=a("jet-button"),f=a("jet-authentication-card");return j(),w(b,null,[o(d,{title:"Reset Password"}),o(f,null,{logo:l(()=>[o(p)]),default:l(()=>[o(u,{class:"mb-4"}),r("form",{onSubmit:t[3]||(t[3]=v((...s)=>m.submit&&m.submit(...s),["prevent"]))},[r("div",null,[o(n,{for:"email",value:"Email"}),o(i,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e.form.email,"onUpdate:modelValue":t[0]||(t[0]=s=>e.form.email=s),required:"",autofocus:""},null,8,["modelValue"])]),r("div",H,[o(n,{for:"password",value:"Password"}),o(i,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:e.form.password,"onUpdate:modelValue":t[1]||(t[1]=s=>e.form.password=s),required:"",autocomplete:"new-password"},null,8,["modelValue"])]),r("div",q,[o(n,{for:"password_confirmation",value:"Confirm Password"}),o(i,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:e.form.password_confirmation,"onUpdate:modelValue":t[2]||(t[2]=s=>e.form.password_confirmation=s),required:"",autocomplete:"new-password"},null,8,["modelValue"])]),r("div",E,[o(c,{class:h({"opacity-25":e.form.processing}),disabled:e.form.processing},{default:l(()=>[V(" Reset Password ")]),_:1},8,["class","disabled"])])],32)]),_:1})],64)}const D=P(B,[["render",F]]);export{D as default};