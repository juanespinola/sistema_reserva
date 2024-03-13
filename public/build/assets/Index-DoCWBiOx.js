import{J as M}from"./JigLayout-C42nlb8G.js";import{J as y}from"./ConfirmationModal-amJhCLdl.js";import{J as D}from"./DialogModal-abULvChW.js";import{I as j}from"./InertiaButton-CgApzWcp.js";import{D as k,J as C,a as $}from"./DtComponent-COTMzt5M.js";import{D as x}from"./DisplayMixin-FmpNKeTc.js";import I from"./ShowForm-DN1-kSZQ.js";import{l as J,a as f,w as t,r as n,o as i,b as s,d as a,h as l,f as u,e as d,j as h,t as N}from"./main-CCoSWOgv.js";import{_ as P}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ApplicationLogo-CSX2-Sgs.js";import"./JigDd-DtnlwjZF.js";const R=J({name:"Index",components:{DtComponent:k,JigToggle:C,InertiaButton:j,JetConfirmationModal:y,JetDialogModal:D,JigModal:$,JigLayout:M,ShowReservationPlacesForm:I},props:{can:Object,columns:Array},inject:["$refreshDt","$dayjs"],data(){return{tableId:"reservation-places-dt",tableParams:{},datatable:null,confirmDelete:!1,currentModel:null,withDisabled:!1,showModal:!1}},mixins:[x],mounted(){},computed:{ajaxUrl(){return new URL(this.route("api.reservation-places.dt")).href}},methods:{showModel(e){axios.get(route("api.reservation-places.show",e)).then(o=>{this.currentModel=o.data.payload,this.showModal=!0})},editModel(e){this.$inertia.visit(this.route("admin.reservation-places.edit",e.id))},confirmDeletion(e){this.currentModel=e,this.confirmDelete=!0},cancelDelete(){this.currentModel=!1,this.confirmDelete=!1},async deleteModel(){const e=this;this.confirmDelete=!1,this.currentModel&&this.$inertia.delete(route("admin.reservation-places.destroy",e.currentModel),{onFinish:o=>{this.displayNotification("success","Item deleted."),e.$refreshDt(e.tableId)},onError:o=>{console.log(o),this.displayNotification("error","There was an error while deleting the item.")}})},async toggleActivation(e,o){console.log(e),axios.put(route("api.reservation-places.update",o.id),{enabled:e}).then(c=>{this.displayNotification("success",c.data.message),this.$refreshDt(this.tableId)})}}}),B={class:"flex flex-wrap items-center justify-between w-full px-4"},A=s("i",{class:"fas fa-arrow-left"},null,-1),S={class:"flex gap-x-2"},E=s("i",{class:"fas fa-plus"},null,-1),V=s("i",{class:"fas fa-redo"},null,-1),L={key:0,class:"flex flex-wrap px-4"},T={class:"z-10 flex-auto bg-white md:rounded-md md:shadow-md"},U=s("h3",{class:"w-full p-4 mb-2 text-lg font-black sm:rounded-t-lg bg-primary-100"},[s("i",{class:"mr-2 fas fa-bars"}),l(" List of All Reservation Places")],-1),z={class:"p-4"},F=s("div",null,"Are you sure you want to delete this record?",-1),Y={class:"flex justify-end gap-x-2"},O={key:0},q={key:1,class:"p-4 font-bold text-red-500 bg-red-100 rounded-md shadow-md"};function G(e,o,c,H,K,Q){const p=n("inertia-link"),r=n("inertia-button"),w=n("dt-component"),g=n("jet-confirmation-modal"),_=n("show-reservation-places-form"),b=n("jig-modal"),v=n("jig-layout");return i(),f(v,null,{header:t(()=>[s("div",B,[a(p,{href:e.route("admin.dashboard"),class:"text-xl font-black text-white"},{default:t(()=>[A,l(" Back")]),_:1},8,["href"]),s("div",S,[e.can.create?(i(),f(r,{key:0,href:e.route("admin.reservation-places.create"),classes:"bg-green-100 hover:bg-green-200 text-primary"},{default:t(()=>[E,l(" New Reservation Place")]),_:1},8,["href"])):u("",!0),a(r,{onClick:o[0]||(o[0]=m=>e.$refreshDt(e.tableId)),classes:"bg-indigo-100 hover:bg-green-200 text-indigo"},{default:t(()=>[V,l(" Refresh")]),_:1})])])]),default:t(()=>[e.can.viewAny?(i(),d("div",L,[s("div",T,[U,s("div",z,[a(w,{"table-id":e.tableId,"ajax-url":e.ajaxUrl,columns:e.columns,"ajax-params":e.tableParams,onShowModel:e.showModel,onEditModel:e.editModel,onDeleteModel:e.confirmDeletion},null,8,["table-id","ajax-url","columns","ajax-params","onShowModel","onEditModel","onDeleteModel"])]),a(g,{title:"Confirm Deletion",show:e.confirmDelete},{content:t(()=>[F]),footer:t(()=>[s("div",Y,[a(r,{as:"button",type:"button",onClick:h(e.cancelDelete,["stop"]),class:"bg-red-500"},{default:t(()=>[l("Cancel")]),_:1},8,["onClick"]),a(r,{as:"button",type:"button",onClick:h(e.deleteModel,["prevent"]),class:"bg-green-500"},{default:t(()=>[l("Yes, Delete")]),_:1},8,["onClick"])])]),_:1},8,["show"]),e.showModal&&e.currentModel?(i(),d("div",O,[a(b,{show:e.showModal,"corner-class":"rounded-lg","position-class":"align-middle",onClose:o[2]||(o[2]=m=>{e.currentModel=null,e.showModal=!1})},{title:t(()=>[l("Show Reservation Place #"+N(e.currentModel.id),1)]),footer:t(()=>[a(r,{class:"px-4 text-white bg-primary",onClick:o[1]||(o[1]=m=>{e.showModal=!1,e.currentModel=null})},{default:t(()=>[l("Close")]),_:1})]),default:t(()=>[a(_,{model:e.currentModel},null,8,["model"])]),_:1},8,["show"])])):u("",!0)])])):(i(),d("div",q," You are not authorized to view a list of Reservation Places "))]),_:1})}const ie=P(R,[["render",G]]);export{ie as default};
