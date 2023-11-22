<template>
    <Link href="/listing">Listings</Link>&nbsp;
    <Link href="/listing/create">New Listing</Link>
    <!-- <div>The Page with time{{ timer }}</div> -->

    <header
        class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg">
                    <Link :href="route('listing.index')"> Listings </Link>
                </div>
                <div
                    class="text-xl text-indigo-600 dark:text-indigo-300 font-bold"
                >
                    <Link :href="route('listing.index')"> LaraZillow </Link>
                </div>
                <div>
                    <Link
                        :href="route('listing.create')"
                        class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md"
                    >
                        +New Listing
                    </Link>
                </div>
            </nav>
        </div>
    </header>
    <main class="container mx-auto p-4">
        <div
            v-if="flashSuccess"
            class="mb-4 border rounded-md shadow-sm border-green-800 bg-green-50 dark:bg-green-900"
        >
            {{ flashSuccess }}
            <!-- I'm a flash -->
        </div>

        <slot>Default</slot>
    </main>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
//import { Link, usePage } from "@inertiajs/vue3";

// const x = ref(0);
// const y = computed(() => x.value * 2);
// page.props.value.flash.success
const page = usePage();
const flashSuccess = computed(() => page.props.flashSuccess);
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
