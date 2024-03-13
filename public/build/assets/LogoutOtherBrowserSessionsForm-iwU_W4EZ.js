import{J as k}from"./ActionMessage-To2zqWEC.js";import{J as x}from"./ActionSection-BNsg3nbg.js";import{J as b}from"./Button-DpvrAl-U.js";import{J as j}from"./DialogModal-abULvChW.js";import{J as B}from"./Input-loptDDaH.js";import{J as C}from"./InputError-Yl9b8Rx0.js";import{J as S}from"./SecondaryButton-DM3YfBao.js";import{a as J,w as e,r as i,o as r,h as s,e as a,F as L,i as M,b as o,t as d,f as O,d as l,a1 as V,n as F}from"./main-CCoSWOgv.js";import{_ as I}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./SectionTitle-DblkjkwN.js";const N={props:["sessions"],components:{JetActionMessage:k,JetActionSection:x,JetButton:b,JetDialogModal:j,JetInput:B,JetInputError:C,JetSecondaryButton:S},data(){return{confirmingLogout:!1,form:this.$inertia.form({password:""})}},methods:{confirmLogout(){this.confirmingLogout=!0,setTimeout(()=>this.$refs.password.focus(),250)},logoutOtherBrowserSessions(){this.form.delete(route("other-browser-sessions.destroy"),{preserveScroll:!0,onSuccess:()=>this.closeModal(),onError:()=>this.$refs.password.focus(),onFinish:()=>this.form.reset()})},closeModal(){this.confirmingLogout=!1,this.form.reset()}}},z=o("div",{class:"max-w-xl text-sm text-gray-600"}," If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password. ",-1),D={key:0,class:"mt-5 space-y-6"},E={key:0,fill:"none","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",viewBox:"0 0 24 24",stroke:"currentColor",class:"w-8 h-8 text-gray-500"},K=o("path",{d:"M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"},null,-1),T=[K],A={key:1,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24","stroke-width":"2",stroke:"currentColor",fill:"none","stroke-linecap":"round","stroke-linejoin":"round",class:"w-8 h-8 text-gray-500"},H=o("path",{d:"M0 0h24v24H0z",stroke:"none"},null,-1),P=o("rect",{x:"7",y:"4",width:"10",height:"16",rx:"1"},null,-1),U=o("path",{d:"M11 5h2M12 17v.01"},null,-1),q=[H,P,U],G={class:"ml-3"},Q={class:"text-sm text-gray-600"},R={class:"text-xs text-gray-500"},W={key:0,class:"text-green-500 font-semibold"},X={key:1},Y={class:"flex items-center mt-5"},Z={class:"mt-4"};function $(oo,u,m,eo,n,c){const _=i("jet-button"),h=i("jet-action-message"),f=i("jet-input"),p=i("jet-input-error"),g=i("jet-secondary-button"),w=i("jet-dialog-modal"),y=i("jet-action-section");return r(),J(y,null,{title:e(()=>[s(" Browser Sessions ")]),description:e(()=>[s(" Manage and log out your active sessions on other browsers and devices. ")]),content:e(()=>[z,m.sessions.length>0?(r(),a("div",D,[(r(!0),a(L,null,M(m.sessions,(t,v)=>(r(),a("div",{class:"flex items-center",key:v},[o("div",null,[t.agent.is_desktop?(r(),a("svg",E,T)):(r(),a("svg",A,q))]),o("div",G,[o("div",Q,d(t.agent.platform)+" - "+d(t.agent.browser),1),o("div",null,[o("div",R,[s(d(t.ip_address)+", ",1),t.is_current_device?(r(),a("span",W,"This device")):(r(),a("span",X,"Last active "+d(t.last_active),1))])])])]))),128))])):O("",!0),o("div",Y,[l(_,{onClick:c.confirmLogout},{default:e(()=>[s(" Log Out Other Browser Sessions ")]),_:1},8,["onClick"]),l(h,{on:n.form.recentlySuccessful,class:"ml-3"},{default:e(()=>[s(" Done. ")]),_:1},8,["on"])]),l(w,{show:n.confirmingLogout,onClose:c.closeModal},{title:e(()=>[s(" Log Out Other Browser Sessions ")]),content:e(()=>[s(" Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices. "),o("div",Z,[l(f,{type:"password",class:"mt-1 block w-3/4",placeholder:"Password",ref:"password",modelValue:n.form.password,"onUpdate:modelValue":u[0]||(u[0]=t=>n.form.password=t),onKeyup:V(c.logoutOtherBrowserSessions,["enter"])},null,8,["modelValue","onKeyup"]),l(p,{message:n.form.errors.password,class:"mt-2"},null,8,["message"])])]),footer:e(()=>[l(g,{onClick:c.closeModal},{default:e(()=>[s(" Cancel ")]),_:1},8,["onClick"]),l(_,{class:F(["ml-2",{"opacity-25":n.form.processing}]),onClick:c.logoutOtherBrowserSessions,disabled:n.form.processing},{default:e(()=>[s(" Log Out Other Browser Sessions ")]),_:1},8,["onClick","class","disabled"])]),_:1},8,["show","onClose"])]),_:1})}const _o=I(N,[["render",$]]);export{_o as default};
