<template>
    <form class="w-full" @submit.prevent="storeModel">
            
        <div class=" sm:col-span-4">
            <jet-label for="sale_date" value="Sale Date" />
            <jig-datepicker
                class="w-full"
                id="sale_date"
                name="sale_date"
                v-model="form.sale_date"
                data-date-format="Y-m-d"
                :data-alt-input="true"
                data-alt-format="l M J, Y"
                :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.sale_date}"
            ></jig-datepicker>
            <jet-input-error :message="form.errors.sale_date" class="mt-2" />
        </div>
            

        <div class=" sm:col-span-4">
            <jet-label for="sale_time" value="Sale Time" />
            <jig-datepicker class="w-full"
                            data-date-format="H:i"
                            :data-alt-input="true"
                            data-alt-format="h:i K"
                            data-default-hour="9"
                            :data-enable-time="true"
                            :data-no-calendar="true"
                            name="sale_time"
                            v-model="form.sale_time"
                            id="sale_time"
                            :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.sale_time}"
            ></jig-datepicker>
            <jet-input-error :message="form.errors.sale_time" class="mt-2" />
        </div>
            
        <div class=" sm:col-span-4">
            <jet-label for="total_amount" value="Total Amount" />
            <jet-input class="w-full" type="text" id="total_amount" name="total_amount" v-model="form.total_amount"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.total_amount}"
            ></jet-input>
            <jet-input-error :message="form.errors.total_amount" class="mt-2" />
        </div>
                
        <div class="mt-2 text-right">
            <inertia-button type="submit" class="font-semibold bg-success disabled:opacity-25" :disabled="form.processing">Submit</inertia-button>
        </div>
    </form>
</template>

<script>
    import JigDatepicker from "@/JigComponents/JigDatepicker.vue";
    import JetInput from "@/Jetstream/Input.vue";
    import JetLabel from "@/Jetstream/Label.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";
    import JetInputError from "@/Jetstream/InputError.vue"
    import {useForm} from "@inertiajs/inertia-vue3";
    import { defineComponent } from "vue";

    export default defineComponent({
        name: "CreateSalesForm",
        components: {
            InertiaButton,
            JetInputError,
            JetLabel,
             JigDatepicker,             JetInput,                                    
        },
        data() {
            return {
                form: useForm({
                    sale_date: null,
                    sale_time: null,
                    total_amount: null,
                                                            
                }, {remember: false}),
            }
        },
        mounted() {
        },
        computed: {
            flash() {
                return this.$page.props.flash || {}
            }
        },
        methods: {
            async storeModel() {
                this.form.post(this.route('admin.sales.store'),{
                    onSuccess: res => {
                        if (this.flash.success) {
                            this.$emit('success',this.flash.success);
                        } else if (this.flash.error) {
                            this.$emit('error',this.flash.error);
                        } else {
                            this.$emit('error',"Unknown server error.")
                        }
                    },
                    onError: res => {
                        this.$emit('error',"A server error occurred");
                    }
                },{remember: false, preserveState: true})
            }
        }
    });
</script>

<style scoped>

</style>
