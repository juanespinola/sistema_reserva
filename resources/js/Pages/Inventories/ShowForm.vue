<template>
    <dl class="gap-4">
        <jig-dd>
            <template #dt>Warehouse Location:</template>
            {{ model.warehouse_location }}
        </jig-dd>
        <jig-dd>
            <template #dt>Entry Date:</template>
            {{ model.entry_date }}
        </jig-dd>
        <jig-dd>
            <template #dt>Stock Quantity:</template>
            {{ model.stock_quantity }}
        </jig-dd>
        <jig-dd>
            <template #dt>Min Allowed Quantity:</template>
            {{ model.min_allowed_quantity }}
        </jig-dd>
            <jig-dd>
            <template #dt>Product:</template>
            {{ model.product ? model.product.name : '-' }}
        </jig-dd>
    </dl>
</template>

<script>
    import JigDd from "@/JigComponents/JigDd.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";

    import { defineComponent } from "vue";

    export default defineComponent({
        name: "ShowInventoriesForm",
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
