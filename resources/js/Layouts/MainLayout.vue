<template>
    <Link href="/listing">Listings</Link>&nbsp;
    <Link href="/listing/create">New Listing</Link>
    <!-- <div>The Page with time{{ timer }}</div> -->

    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>

    <slot>default</slot>
</template>
<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
//import { Link, usePage } from "@inertiajs/vue3";

// const x = ref(0);
// const y = computed(() => x.value * 2);
// page.props.value.flash.success
const page = usePage();
const flashSuccess = computed(() => page.props.value);
// import { ref } from "vue";
// const timer = ref(0);
// setInterval(() => timer.value++, (setTimeout = 1000));
</script>

<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>
