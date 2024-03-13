<template>
    <form @submit.prevent="updateModel">
                <div class=" sm:col-span-4">
            <jet-label for="quantity" value="Quantity" />
            <jet-input class="w-full" type="number" id="quantity" name="quantity" v-model="form.quantity"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.quantity}"
            ></jet-input>
            <jet-input-error :message="form.errors.quantity" class="mt-2" />
        </div>
                 <div class=" sm:col-span-4">
            <jet-label for="total_amount" value="Total Amount" />
            <jet-input class="w-full" type="text" id="total_amount" name="total_amount" v-model="form.total_amount"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.total_amount}"
            ></jet-input>
            <jet-input-error :message="form.errors.total_amount" class="mt-2" />
        </div>
                                                            <div class=" sm:col-span-4">
                    <jet-label for="product" value="Product" />
                    <infinite-select class="w-full" :per-page="15" :api-url="route('api.products.index')"
                                     id="product" name="product"
                                     v-model="form.product" label="name"
                                     :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.product}"
                    ></infinite-select>
                    <jet-input-error :message="form.errors.product" class="mt-2" />
                </div>
                                <div class=" sm:col-span-4">
                    <jet-label for="sale" value="Sale" />
                    <infinite-select class="w-full" :per-page="15" :api-url="route('api.sales.index')"
                                     id="sale" name="sale"
                                     v-model="form.sale" label="id"
                                     :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.sale}"
                    ></infinite-select>
                    <jet-input-error :message="form.errors.sale" class="mt-2" />
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
        import InfiniteSelect from '@/JigComponents/InfiniteSelect.vue';

    import { defineComponent } from "vue";

    export default defineComponent({
        name: "EditSalesDetailForm",
        props: {
            model: Object,
        },
        components: {
            InertiaButton,
            JetLabel,
            JetInputError,
            JetInput,
                                                InfiniteSelect,

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
                this.form.put(this.route('admin.sales-details.update',this.form.id),
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
