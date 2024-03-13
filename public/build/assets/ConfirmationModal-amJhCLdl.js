import{M as c}from"./DialogModal-abULvChW.js";import{_ as n}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{r as i,o as r,a as m,w as d,b as s,k as o}from"./main-CCoSWOgv.js";const h={emits:["close"],components:{Modal:c},props:{show:{default:!1},maxWidth:{default:"2xl"},closeable:{default:!0}},methods:{close(){this.$emit("close")}}},_={class:"bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},f={class:"sm:flex sm:items-start"},x=s("div",{class:"mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"},[s("svg",{class:"h-6 w-6 text-red-600",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},[s("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"})])],-1),p={class:"mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"},u={class:"text-lg"},w={class:"mt-2"},b={class:"px-6 py-4 bg-gray-100 text-right"};function v(t,k,e,g,C,l){const a=i("modal");return r(),m(a,{show:e.show,"max-width":e.maxWidth,closeable:e.closeable,onClose:l.close},{default:d(()=>[s("div",_,[s("div",f,[x,s("div",p,[s("h3",u,[o(t.$slots,"title")]),s("div",w,[o(t.$slots,"content")])])])]),s("div",b,[o(t.$slots,"footer")])]),_:3},8,["show","max-width","closeable","onClose"])}const y=n(h,[["render",v]]);export{y as J};
