<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Box v-for="listing in listings" :key="listing.id">
            <div>
                <!-- <Link :href="`/listing/${listing.id}`"> -->
                <Link :href="route('listing.show', { listing: listing.id })">
                    <ListingSpace :listing="listing" />
                    <ListingAddress :listing="listing" />
                </Link>
            </div>
            <div>
                <Link
                    :href="route('listing.edit', { listing: listing.id })"
                    as="button"
                    >Edit</Link
                >
            </div>
            <div>
                <Link
                    :href="route('listing.destroy', { listing: listing.id })"
                    method="DELETE"
                    >Delete</Link
                >
            </div>
        </Box>
    </div>
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import { Link } from "@inertiajs/vue3";
import Box from "@/Components/UI/Box.vue";
import ListingSpace from "@/Components/ListingSpace.vue";

defineProps({
    listings: Array,
});
</script>
