<template>
    <dl class="gap-4">
        <jig-dd>
            <template #dt>Comments:</template>
            {{ model.comments }}
        </jig-dd>
            <jig-dd>
            <template #dt>Customer:</template>
            {{ model.customer ? model.customer.name : '-' }}
        </jig-dd>
        <jig-dd>
            <template #dt>Reservation Place:</template>
            {{ model.reservation_place ? model.reservation_place.description : '-' }}
        </jig-dd>
    </dl>
</template>

<script>
    import JigDd from "@/JigComponents/JigDd.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";

    import { defineComponent } from "vue";

    export default defineComponent({
        name: "ShowCommentsForm",
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
