<template>
    <form class="w-full" @submit.prevent="storeModel">
        
        <div class=" sm:col-span-4">
            <jet-label for="warehouse_location" value="Warehouse Location" />
            <jet-input class="w-full" type="text" id="warehouse_location" name="warehouse_location" v-model="form.warehouse_location"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.warehouse_location}"
            ></jet-input>
            <jet-input-error :message="form.errors.warehouse_location" class="mt-2" />
        </div>
                
        <div class=" sm:col-span-4">
            <jet-label for="entry_date" value="Entry Date" />
            <jig-datepicker
                class="w-full"
                id="entry_date"
                name="entry_date"
                v-model="form.entry_date"
                data-date-format="Y-m-d"
                :data-alt-input="true"
                data-alt-format="l M J, Y"
                :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.entry_date}"
            ></jig-datepicker>
            <jet-input-error :message="form.errors.entry_date" class="mt-2" />
        </div>
            
        <div class=" sm:col-span-4">
            <jet-label for="stock_quantity" value="Stock Quantity" />
            <jet-input class="w-full" type="number" id="stock_quantity" name="stock_quantity" v-model="form.stock_quantity"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.stock_quantity}"
            ></jet-input>
            <jet-input-error :message="form.errors.stock_quantity" class="mt-2" />
        </div>
            
        <div class=" sm:col-span-4">
            <jet-label for="min_allowed_quantity" value="Min Allowed Quantity" />
            <jet-input class="w-full" type="number" id="min_allowed_quantity" name="min_allowed_quantity" v-model="form.min_allowed_quantity"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.min_allowed_quantity}"
            ></jet-input>
            <jet-input-error :message="form.errors.min_allowed_quantity" class="mt-2" />
        </div>
                            <div class=" sm:col-span-4">
            <jet-label for="product" value="Product" />
            <infinite-select :per-page="15" :api-url="route('api.products.index')"
                             id="product" name="product"
                             v-model="form.product" label="name"
                             :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.product}"
            ></infinite-select>
            <jet-input-error :message="form.errors.product" class="mt-2" />
        </div>

        <div class="mt-2 text-right">
            <inertia-button type="submit" class="font-semibold bg-success disabled:opacity-25" :disabled="form.processing">Submit</inertia-button>
        </div>
    </form>
</template>

<script>
    import JigDatepicker from "@/JigComponents/JigDatepicker.vue";
    import JetInput from "@/Jetstream/Input.vue";
    import InfiniteSelect from '@/JigComponents/InfiniteSelect.vue';
    import JetLabel from "@/Jetstream/Label.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";
    import JetInputError from "@/Jetstream/InputError.vue"
    import {useForm} from "@inertiajs/inertia-vue3";
    import { defineComponent } from "vue";

    export default defineComponent({
        name: "CreateInventoriesForm",
        components: {
            InertiaButton,
            JetInputError,
            JetLabel,
             JigDatepicker,             JetInput,                                     InfiniteSelect,
        },
        data() {
            return {
                form: useForm({
                    warehouse_location: null,
                    entry_date: null,
                    stock_quantity: null,
                    min_allowed_quantity: null,
                                        "product": null,
                    
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
                this.form.post(this.route('admin.inventories.store'),{
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
