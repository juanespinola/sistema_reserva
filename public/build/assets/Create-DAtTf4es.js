import{J as m}from"./JigLayout-C42nlb8G.js";import{I as l}from"./InertiaButton-CgApzWcp.js";import p from"./CreateForm-DYCLTc-D.js";import{D as d}from"./DisplayMixin-FmpNKeTc.js";import{_ as u}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{a as f,w as o,r,o as _,b as t,d as a,h as x}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./JigDatepicker-_1b8EtFo.js";import"./component-DnD0jkPy.js";import"./Input-loptDDaH.js";import"./JigTextarea-Dj0pklsY.js";import"./Label-CK0f_1Hr.js";import"./InputError-Yl9b8Rx0.js";const h={name:"CreateUsers",components:{InertiaButton:l,JigLayout:m,CreateUsersForm:p},data(){return{}},mixins:[d],mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{onSuccess(e){this.displayNotification("success",e),this.$inertia.visit(route("admin.users.index"))},onError(e){this.displayNotification("error",e)}}},w={class:"flex flex-wrap items-center justify-between w-full px-4"},y=t("i",{class:"fas fa-arrow-left"},null,-1),k={class:"flex flex-wrap px-4"},N={class:"z-10 flex-auto max-w-2xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"};function g(e,v,B,C,b,s){const i=r("inertia-link"),n=r("create-users-form"),c=r("jig-layout");return _(),f(c,null,{header:o(()=>[t("div",w,[a(i,{href:e.route("admin.users.index"),class:"text-xl font-black text-white"},{default:o(()=>[y,x(" Back | New User ")]),_:1},8,["href"])])]),default:o(()=>[t("div",k,[t("div",N,[a(n,{onSuccess:s.onSuccess,onError:s.onError},null,8,["onSuccess","onError"])])])]),_:1})}const q=u(h,[["render",g]]);export{q as default};