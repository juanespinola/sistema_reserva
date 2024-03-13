<template>
    <dl class="gap-4">
        <jig-dd>
            <template #dt>Description:</template>
            {{ model.description }}
        </jig-dd>
        <jig-dd>
            <template #dt>Contact Name:</template>
            {{ model.contact_name }}
        </jig-dd>
        <jig-dd>
            <template #dt>Phone Name:</template>
            {{ model.phone_name }}
        </jig-dd>
    </dl>
</template>

<script>
    import JigDd from "@/JigComponents/JigDd.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";

    import { defineComponent } from "vue";

    export default defineComponent({
        name: "ShowSuppliersForm",
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
