import{A as h}from"./AppLayout-BvpQxWie.js";import w from"./DeleteUserForm-jMjcxqaE.js";import{J as g}from"./SectionBorder-C61sAb96.js";import F from"./LogoutOtherBrowserSessionsForm-iwU_W4EZ.js";import y from"./TwoFactorAuthenticationForm-C1xbiXFT.js";import $ from"./UpdatePasswordForm-DQQN7QOv.js";import k from"./UpdateProfileInformationForm-DMd2ZfCy.js";import{_ as x}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{a as b,w as p,r as t,o as r,b as n,e as a,d as o,f as m,F as j}from"./main-CCoSWOgv.js";import"./JigLayout-C42nlb8G.js";import"./InertiaButton-CgApzWcp.js";import"./DialogModal-abULvChW.js";import"./DisplayMixin-FmpNKeTc.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./ActionSection-BNsg3nbg.js";import"./SectionTitle-DblkjkwN.js";import"./DangerButton-EEdC8sAg.js";import"./Input-loptDDaH.js";import"./InputError-Yl9b8Rx0.js";import"./SecondaryButton-DM3YfBao.js";import"./ActionMessage-To2zqWEC.js";import"./Button-DpvrAl-U.js";import"./FormSection-DqCX0OWO.js";import"./Label-CK0f_1Hr.js";const v={props:["sessions"],components:{AppLayout:h,DeleteUserForm:w,JetSectionBorder:g,LogoutOtherBrowserSessionsForm:F,TwoFactorAuthenticationForm:y,UpdatePasswordForm:$,UpdateProfileInformationForm:k}},B=n("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1),P={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},A={key:0},U={key:1},C={key:2};function N(e,S,i,V,D,I){const c=t("update-profile-information-form"),s=t("jet-section-border"),_=t("update-password-form"),d=t("two-factor-authentication-form"),f=t("logout-other-browser-sessions-form"),l=t("delete-user-form"),u=t("app-layout");return r(),b(u,{title:"Profile"},{header:p(()=>[B]),default:p(()=>[n("div",null,[n("div",P,[e.$page.props.jetstream.canUpdateProfileInformation?(r(),a("div",A,[o(c,{user:e.$page.props.auth.user},null,8,["user"]),o(s)])):m("",!0),e.$page.props.jetstream.canUpdatePassword?(r(),a("div",U,[o(_,{class:"mt-10 sm:mt-0"}),o(s)])):m("",!0),e.$page.props.jetstream.canManageTwoFactorAuthentication?(r(),a("div",C,[o(d,{class:"mt-10 sm:mt-0"}),o(s)])):m("",!0),o(f,{sessions:i.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),e.$page.props.jetstream.hasAccountDeletionFeatures?(r(),a(j,{key:3},[o(s),o(l,{class:"mt-10 sm:mt-0"})],64)):m("",!0)])])]),_:1})}const no=x(v,[["render",N]]);export{no as default};
