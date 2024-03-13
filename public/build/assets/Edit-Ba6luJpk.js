import{J as m}from"./JigLayout-C42nlb8G.js";import{J as d}from"./Label-CK0f_1Hr.js";import{I as l}from"./InertiaButton-CgApzWcp.js";import{J as c}from"./InputError-Yl9b8Rx0.js";import{J as p}from"./Button-DpvrAl-U.js";import f from"./EditForm-I9PBD4s1.js";import{D as u}from"./DisplayMixin-FmpNKeTc.js";import{_}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{l as h,a as x,w as e,r as s,o as g,b as o,d as r,h as w,t as E}from"./main-CCoSWOgv.js";import"./DialogModal-abULvChW.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./Input-loptDDaH.js";import"./InfiniteSelect-BfhbGX6f.js";const y=h({name:"EditRatings",props:{model:Object},components:{InertiaButton:l,JetLabel:d,JetButton:p,JetInputError:c,JigLayout:m,EditRatingsForm:f},data(){return{}},mixins:[u],mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{onSuccess(t){this.displayNotification("success",t),this.$inertia.visit(route("admin.ratings.index"))},onError(t){this.displayNotification("error",t)}}}),J={class:"flex flex-wrap items-center justify-between w-full px-4"},b=o("i",{class:"fas fa-arrow-left"},null,-1),k={class:"flex flex-wrap px-4"},B={class:"z-10 flex-auto max-w-2xl p-4 mx-auto bg-white md:rounded-md md:shadow-md"};function $(t,v,N,S,j,C){const i=s("inertia-link"),a=s("edit-ratings-form"),n=s("jig-layout");return g(),x(n,null,{header:e(()=>[o("div",J,[r(i,{href:t.route("admin.ratings.index"),class:"text-xl font-black text-white"},{default:e(()=>[b,w(" Back | Edit Rating #"+E(t.model.id),1)]),_:1},8,["href"])])]),default:e(()=>[o("div",k,[o("div",B,[r(a,{model:t.model,onSuccess:t.onSuccess,onError:t.onError},null,8,["model","onSuccess","onError"])])])]),_:1})}const H=_(y,[["render",$]]);export{H as default};