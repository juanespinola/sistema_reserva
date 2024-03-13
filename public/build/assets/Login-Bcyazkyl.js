import{J,a as v}from"./AuthenticationCardLogo-BVZ5SJtL.js";import{J as y}from"./Button-DpvrAl-U.js";import{J as V}from"./Input-loptDDaH.js";import{J as L}from"./Checkbox-f85nBy3B.js";import{J as C}from"./Label-CK0f_1Hr.js";import{J as B}from"./ValidationErrors-B3FkXJuU.js";import{H as F,L as H,e as p,d as e,w as n,F as N,r as t,o as l,t as q,f,b as a,a as E,h as _,n as P,j as R}from"./main-CCoSWOgv.js";import{_ as S}from"./_plugin-vue_export-helper-DlAUqK2U.js";const U={components:{Head:F,JetAuthenticationCard:J,JetAuthenticationCardLogo:v,JetButton:y,JetInput:V,JetCheckbox:L,JetLabel:C,JetValidationErrors:B,Link:H},props:{canResetPassword:Boolean,status:String},data(){return{form:this.$inertia.form({email:"",password:"",remember:!1})}},methods:{submit(){this.form.transform(m=>({...m,remember:this.form.remember?"on":""})).post(this.route("login"),{onFinish:()=>this.form.reset("password")})}}},A={key:0,class:"mb-4 font-medium text-sm text-green-600"},z={class:"mt-4"},D={class:"block mt-4"},I={class:"flex items-center"},M=a("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),T={class:"flex items-center justify-end mt-4"};function G(m,o,i,K,s,c){const b=t("Head"),h=t("jet-authentication-card-logo"),g=t("jet-validation-errors"),d=t("jet-label"),u=t("jet-input"),w=t("jet-checkbox"),k=t("Link"),j=t("jet-button"),x=t("jet-authentication-card");return l(),p(N,null,[e(b,{title:"Log in"}),e(x,null,{logo:n(()=>[e(h)]),default:n(()=>[e(g,{class:"mb-4"}),i.status?(l(),p("div",A,q(i.status),1)):f("",!0),a("form",{onSubmit:o[3]||(o[3]=R((...r)=>c.submit&&c.submit(...r),["prevent"]))},[a("div",null,[e(d,{for:"email",value:"Email"}),e(u,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s.form.email,"onUpdate:modelValue":o[0]||(o[0]=r=>s.form.email=r),required:"",autofocus:""},null,8,["modelValue"])]),a("div",z,[e(d,{for:"password",value:"Password"}),e(u,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s.form.password,"onUpdate:modelValue":o[1]||(o[1]=r=>s.form.password=r),required:"",autocomplete:"current-password"},null,8,["modelValue"])]),a("div",D,[a("label",I,[e(w,{name:"remember",checked:s.form.remember,"onUpdate:checked":o[2]||(o[2]=r=>s.form.remember=r)},null,8,["checked"]),M])]),a("div",T,[i.canResetPassword?(l(),E(k,{key:0,href:m.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:n(()=>[_(" Forgot your password? ")]),_:1},8,["href"])):f("",!0),e(j,{class:P(["ml-4",{"opacity-25":s.form.processing}]),disabled:s.form.processing},{default:n(()=>[_(" Log in ")]),_:1},8,["class","disabled"])])],32)]),_:1})],64)}const te=S(U,[["render",G]]);export{te as default};