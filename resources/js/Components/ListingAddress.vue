<template>
    <span>
        {{ listing.street }} {{ listing.street_nr }}, {{ listing.city }}, for
    </span>
</template>

<script setup>
defineProps({
    listing: Object,
});
</script>
