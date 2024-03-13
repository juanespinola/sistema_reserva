<template>
    <form class="w-full" @submit.prevent="storeModel">
        
        <div class=" sm:col-span-4">
            <jet-label for="description" value="Description" />
            <jet-input class="w-full" type="text" id="description" name="description" v-model="form.description"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.description}"
            ></jet-input>
            <jet-input-error :message="form.errors.description" class="mt-2" />
        </div>
            
        <div class=" sm:col-span-4">
            <jet-label for="contact_name" value="Contact Name" />
            <jet-input class="w-full" type="text" id="contact_name" name="contact_name" v-model="form.contact_name"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.contact_name}"
            ></jet-input>
            <jet-input-error :message="form.errors.contact_name" class="mt-2" />
        </div>
            
        <div class=" sm:col-span-4">
            <jet-label for="phone_name" value="Phone Name" />
            <jet-input class="w-full" type="text" id="phone_name" name="phone_name" v-model="form.phone_name"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.phone_name}"
            ></jet-input>
            <jet-input-error :message="form.errors.phone_name" class="mt-2" />
        </div>
                
        <div class="mt-2 text-right">
            <inertia-button type="submit" class="font-semibold bg-success disabled:opacity-25" :disabled="form.processing">Submit</inertia-button>
        </div>
    </form>
</template>

<script>
    import JetInput from "@/Jetstream/Input.vue";
    import JetLabel from "@/Jetstream/Label.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";
    import JetInputError from "@/Jetstream/InputError.vue"
    import {useForm} from "@inertiajs/inertia-vue3";
    import { defineComponent } from "vue";

    export default defineComponent({
        name: "CreateSuppliersForm",
        components: {
            InertiaButton,
            JetInputError,
            JetLabel,
                         JetInput,                                    
        },
        data() {
            return {
                form: useForm({
                    description: null,
                    contact_name: null,
                    phone_name: null,
                                                            
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
                this.form.post(this.route('admin.suppliers.store'),{
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
