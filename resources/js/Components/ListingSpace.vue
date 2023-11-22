<template>
    <div>{{ listing.beds }} bds | {{ listing.beds }} ba</div>
</template>

<script setup>
defineProps({
    listing: Object,
});
</script>
