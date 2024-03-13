import{J as p}from"./Label-CK0f_1Hr.js";import{I as f}from"./InertiaButton-CgApzWcp.js";import{J as c}from"./InputError-Yl9b8Rx0.js";import{l as b,u as g,e as _,b as t,d as o,n,w as k,j as v,r as a,o as h,h as V}from"./main-CCoSWOgv.js";import{J as w}from"./JigDatepicker-_1b8EtFo.js";import{I as $}from"./InfiniteSelect-BfhbGX6f.js";import{_ as j}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./component-DnD0jkPy.js";const B=b({name:"EditBookingForm",props:{model:Object},components:{InertiaButton:f,JetLabel:p,JetInputError:c,JigDatepicker:w,InfiniteSelect:$},data(){return{form:g({...this.model},{remember:!1})}},mounted(){},computed:{flash(){return this.$page.props.flash||{}}},methods:{async updateModel(){this.form.put(this.route("admin.bookings.update",this.form.id),{onSuccess:e=>{this.flash.success?this.$emit("success",this.flash.success):this.flash.error?this.$emit("error",this.flash.error):this.$emit("error","Unknown server error.")},onError:e=>{this.$emit("error","A server error occurred")}},{remember:!1,preserveState:!0})}}}),J={class:"sm:col-span-4"},E={class:"sm:col-span-4"},M={class:"sm:col-span-4"},S={class:"sm:col-span-4"},C={class:"mt-2 text-right"};function I(e,r,U,Y,y,D){const i=a("jet-label"),l=a("jig-datepicker"),m=a("jet-input-error"),d=a("infinite-select"),u=a("inertia-button");return h(),_("form",{onSubmit:r[4]||(r[4]=v((...s)=>e.updateModel&&e.updateModel(...s),["prevent"]))},[t("div",J,[o(i,{for:"start_datetime_booking",value:"Start Datetime Booking"}),o(l,{class:n(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.start_datetime_booking}]),id:"start_datetime_booking",name:"start_datetime_booking",modelValue:e.form.start_datetime_booking,"onUpdate:modelValue":r[0]||(r[0]=s=>e.form.start_datetime_booking=s),"data-date-format":"Y-m-d","data-alt-input":!0,"data-alt-format":"l M J, Y"},null,8,["modelValue","class"]),o(m,{message:e.form.errors.start_datetime_booking,class:"mt-2"},null,8,["message"])]),t("div",E,[o(i,{for:"end_datetime_booking",value:"End Datetime Booking"}),o(l,{class:n(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.end_datetime_booking}]),id:"end_datetime_booking",name:"end_datetime_booking",modelValue:e.form.end_datetime_booking,"onUpdate:modelValue":r[1]||(r[1]=s=>e.form.end_datetime_booking=s),"data-date-format":"Y-m-d","data-alt-input":!0,"data-alt-format":"l M J, Y"},null,8,["modelValue","class"]),o(m,{message:e.form.errors.end_datetime_booking,class:"mt-2"},null,8,["message"])]),t("div",M,[o(i,{for:"customer",value:"Customer"}),o(d,{class:n(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.customer}]),"per-page":15,"api-url":e.route("api.customers.index"),id:"customer",name:"customer",modelValue:e.form.customer,"onUpdate:modelValue":r[2]||(r[2]=s=>e.form.customer=s),label:"name"},null,8,["api-url","modelValue","class"]),o(m,{message:e.form.errors.customer,class:"mt-2"},null,8,["message"])]),t("div",S,[o(i,{for:"reservation_place",value:"Reservation Place"}),o(d,{class:n(["w-full",{"border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100":e.form.errors.reservation_place}]),"per-page":15,"api-url":e.route("api.reservation-places.index"),id:"reservation_place",name:"reservation_place",modelValue:e.form.reservation_place,"onUpdate:modelValue":r[3]||(r[3]=s=>e.form.reservation_place=s),label:"description"},null,8,["api-url","modelValue","class"]),o(m,{message:e.form.errors.reservation_place,class:"mt-2"},null,8,["message"])]),t("div",C,[o(u,{type:"submit",class:"font-semibold text-white bg-primary",disabled:e.form.processing},{default:k(()=>[V("Submit")]),_:1},8,["disabled"])])],32)}const T=j(B,[["render",I]]);export{T as default};
