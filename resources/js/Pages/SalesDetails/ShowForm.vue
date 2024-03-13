<template>
    <dl class="gap-4">
        <jig-dd>
            <template #dt>Quantity:</template>
            {{ model.quantity }}
        </jig-dd>
        <jig-dd>
            <template #dt>Total Amount:</template>
            {{ model.total_amount }}
        </jig-dd>
            <jig-dd>
            <template #dt>Product:</template>
            {{ model.product ? model.product.name : '-' }}
        </jig-dd>
        <jig-dd>
            <template #dt>Sale:</template>
            {{ model.sale ? model.sale.id : '-' }}
        </jig-dd>
    </dl>
</template>

<script>
    import JigDd from "@/JigComponents/JigDd.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";

    import { defineComponent } from "vue";

    export default defineComponent({
        name: "ShowSalesDetailsForm",
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
