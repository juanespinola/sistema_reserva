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
            <jet-label for="location" value="Location" />
            <jet-input class="w-full" type="text" id="location" name="location" v-model="form.location"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.location}"
            ></jet-input>
            <jet-input-error :message="form.errors.location" class="mt-2" />
        </div>
            
        <div class=" sm:col-span-4">
            <jet-label for="capacity" value="Capacity" />
            <jet-input class="w-full" type="number" id="capacity" name="capacity" v-model="form.capacity"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.capacity}"
            ></jet-input>
            <jet-input-error :message="form.errors.capacity" class="mt-2" />
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
        name: "CreateReservationPlacesForm",
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
                    location: null,
                    capacity: null,
                                                            
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
                this.form.post(this.route('admin.reservation-places.store'),{
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
