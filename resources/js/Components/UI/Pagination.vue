<template>
    <div class="flex gap-1">
        <Link
            v-for="(rapper, index) in rappers"
            :key="index"
            class="py-2 px-4 rounded-md"
            :href="rapper.url"
            :class="{
                ' bg-green-800 dark:bg-indigo-800 text-gray-300': rapper.active,
            }" v-html="rapper.label"
       />

        <!-- </Link> -->
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({ rappers: Array });
</script>
