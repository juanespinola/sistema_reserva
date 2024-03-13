<template>
    <form @submit.prevent="updateModel">
                 <div class=" sm:col-span-4">
            <jet-label for="description" value="Description" />
            <jet-input class="w-full" type="text" id="description" name="description" v-model="form.description"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.description}"
            ></jet-input>
            <jet-input-error :message="form.errors.description" class="mt-2" />
        </div>
                 <div class=" sm:col-span-4">
            <jet-label for="plan_name" value="Plan Name" />
            <jet-input class="w-full" type="text" id="plan_name" name="plan_name" v-model="form.plan_name"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.plan_name}"
            ></jet-input>
            <jet-input-error :message="form.errors.plan_name" class="mt-2" />
        </div>
                                    
        <div class="mt-2 text-right">
            <inertia-button type="submit" class="font-semibold text-white bg-primary" :disabled="form.processing">Submit</inertia-button>
        </div>
    </form>
</template>

<script>
    import JetLabel from "@/Jetstream/Label.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";
    import JetInputError from "@/Jetstream/InputError.vue";
    import {useForm} from "@inertiajs/inertia-vue3";
        import JetInput from "@/Jetstream/Input.vue";
        
    import { defineComponent } from "vue";

    export default defineComponent({
        name: "EditPlanForm",
        props: {
            model: Object,
        },
        components: {
            InertiaButton,
            JetLabel,
            JetInputError,
            JetInput,
                                                
        },
        data() {
            return {
                form: useForm({
                    ...this.model,
                },{remember:false}),
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
            async updateModel() {
                this.form.put(this.route('admin.plans.update',this.form.id),
                    {
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
