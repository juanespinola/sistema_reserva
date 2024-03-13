<template>
    <dl class="gap-4">
        <jig-dd>
            <template #dt>Name:</template>
            {{ model.name }}
        </jig-dd>
        <jig-dd>
            <template #dt>Description:</template>
            {{ model.description }}
        </jig-dd>
        <jig-dd>
            <template #dt>Barcode:</template>
            {{ model.barcode }}
        </jig-dd>
        <jig-dd>
            <template #dt>Price:</template>
            {{ model.price }}
        </jig-dd>
        <jig-dd>
            <template #dt>Category Id:</template>
            {{ model.category_id }}
        </jig-dd>
            <jig-dd>
            <template #dt>Supplier:</template>
            {{ model.supplier ? model.supplier.description : '-' }}
        </jig-dd>
    </dl>
</template>

<script>
    import JigDd from "@/JigComponents/JigDd.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";

    import { defineComponent } from "vue";

    export default defineComponent({
        name: "ShowProductsForm",
        props: {
            model: Object,
        },
        components: {
            InertiaButton,
            JigDd,
        },
        data() {
            return {}
        },
        mounted() {},
        computed: {
            flash() {
                return this.$page.props.flash || {}
            }
        },
        methods: {}
    });
</script>

<style scoped>

</style>
