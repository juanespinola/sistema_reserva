<template>
    <form class="w-full" @submit.prevent="storeModel">
        
        <div class=" sm:col-span-4">
            <jet-label for="rating_value" value="Rating Value" />
            <jet-input class="w-full" type="number" id="rating_value" name="rating_value" v-model="form.rating_value"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.rating_value}"
            ></jet-input>
            <jet-input-error :message="form.errors.rating_value" class="mt-2" />
        </div>
                            <div class=" sm:col-span-4">
            <jet-label for="customer" value="Customer" />
            <infinite-select :per-page="15" :api-url="route('api.customers.index')"
                             id="customer" name="customer"
                             v-model="form.customer" label="name"
                             :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.customer}"
            ></infinite-select>
            <jet-input-error :message="form.errors.customer" class="mt-2" />
        </div>
            <div class=" sm:col-span-4">
            <jet-label for="reservation_place" value="Reservation Place" />
            <infinite-select :per-page="15" :api-url="route('api.reservation-places.index')"
                             id="reservation_place" name="reservation_place"
                             v-model="form.reservation_place" label="description"
                             :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.reservation_place}"
            ></infinite-select>
            <jet-input-error :message="form.errors.reservation_place" class="mt-2" />
        </div>

        <div class="mt-2 text-right">
            <inertia-button type="submit" class="font-semibold bg-success disabled:opacity-25" :disabled="form.processing">Submit</inertia-button>
        </div>
    </form>
</template>

<script>
    import JetInput from "@/Jetstream/Input.vue";
    import InfiniteSelect from '@/JigComponents/InfiniteSelect.vue';
    import JetLabel from "@/Jetstream/Label.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";
    import JetInputError from "@/Jetstream/InputError.vue"
    import {useForm} from "@inertiajs/inertia-vue3";
    import { defineComponent } from "vue";

    export default defineComponent({
        name: "CreateRatingsForm",
        components: {
            InertiaButton,
            JetInputError,
            JetLabel,
                         JetInput,                                     InfiniteSelect,
        },
        data() {
            return {
                form: useForm({
                    rating_value: null,
                                        "customer": null,
"reservation_place": null,
                    
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
                this.form.post(this.route('admin.ratings.store'),{
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
