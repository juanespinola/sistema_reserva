<template>
    <dl class="gap-4">
        <jig-dd>
            <template #dt>Purchase Date:</template>
            {{ model.purchase_date }}
        </jig-dd>
        <jig-dd>
            <template #dt>Purchase Time:</template>
            {{ model.purchase_time }}
        </jig-dd>
        <jig-dd>
            <template #dt>Total Amount:</template>
            {{ model.total_amount }}
        </jig-dd>
    </dl>
</template>

<script>
    import JigDd from "@/JigComponents/JigDd.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";

    import { defineComponent } from "vue";

    export default defineComponent({
        name: "ShowPurchasesForm",
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
