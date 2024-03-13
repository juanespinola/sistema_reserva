<template>
    <form @submit.prevent="updateModel">
                 <div class=" sm:col-span-4">
            <jet-label for="name" value="Name" />
            <jet-input class="w-full" type="text" id="name" name="name" v-model="form.name"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.name}"
            ></jet-input>
            <jet-input-error :message="form.errors.name" class="mt-2" />
        </div>
                <div class=" sm:col-span-4">
            <jet-label for="description" value="Description" />
            <jig-textarea class="w-full" id="description" name="description" v-model="form.description"
                          :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.description}"
            ></jig-textarea>
            <jet-input-error :message="form.errors.description" class="mt-2" />
        </div>
                 <div class=" sm:col-span-4">
            <jet-label for="barcode" value="Barcode" />
            <jet-input class="w-full" type="text" id="barcode" name="barcode" v-model="form.barcode"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.barcode}"
            ></jet-input>
            <jet-input-error :message="form.errors.barcode" class="mt-2" />
        </div>
                 <div class=" sm:col-span-4">
            <jet-label for="price" value="Price" />
            <jet-input class="w-full" type="text" id="price" name="price" v-model="form.price"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.price}"
            ></jet-input>
            <jet-input-error :message="form.errors.price" class="mt-2" />
        </div>
                <div class=" sm:col-span-4">
            <jet-label for="category_id" value="Category Id" />
            <jet-input class="w-full" type="number" id="category_id" name="category_id" v-model="form.category_id"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.category_id}"
            ></jet-input>
            <jet-input-error :message="form.errors.category_id" class="mt-2" />
        </div>
                                                            <div class=" sm:col-span-4">
                    <jet-label for="supplier" value="Supplier" />
                    <infinite-select class="w-full" :per-page="15" :api-url="route('api.suppliers.index')"
                                     id="supplier" name="supplier"
                                     v-model="form.supplier" label="description"
                                     :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.supplier}"
                    ></infinite-select>
                    <jet-input-error :message="form.errors.supplier" class="mt-2" />
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
    import JigTextarea from "@/JigComponents/JigTextarea.vue";
    import InfiniteSelect from '@/JigComponents/InfiniteSelect.vue';

    import { defineComponent } from "vue";

    export default defineComponent({
        name: "EditProductForm",
        props: {
            model: Object,
        },
        components: {
            InertiaButton,
            JetLabel,
            JetInputError,
            JetInput,
                                    JigTextarea,
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
                this.form.put(this.route('admin.products.update',this.form.id),
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
