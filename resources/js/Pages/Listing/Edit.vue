<template>
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input type="text" v-model="form.beds" class="input" />
                <div v-if="form.errors.beds">
                    {{ form.errors.beds }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input type="text" v-model="form.baths" class="input" />
                <div v-if="form.errors.baths">
                    {{ form.errors.baths }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Area</label>
                <input type="text" v-model="form.area" class="input" />
                <div v-if="form.errors.area">
                    {{ form.errors.area }}
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-6 gap-4">
            <div class="col-span-4">
                <label class="label">City</label>
                <input type="text" v-model="form.city" class="input" />
                <div v-if="form.errors.city">
                    {{ form.errors.city }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Code</label>
                <input type="text" v-model="form.code" class="input" />
                <div v-if="form.errors.code">
                    {{ form.errors.code }}
                </div>
            </div>
        </div>
        <div class="grid md:grid-cols-6 gap-4">
            <div class="col-span-4">
                <label class="label">Street</label>
                <input type="text" v-model="form.street" class="input" />
                <div v-if="form.errors.street">
                    {{ form.errors.street }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Street Nr</label>
                <input type="text" v-model="form.street_nr" class="input" />
                <div v-if="form.errors.street_nr">
                    {{ form.errors.street_nr }}
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <label class="label">Price</label>
            <input type="text" v-model="form.price" class="input" />
            <div v-if="form.errors.price">
                {{ form.errors.price }}
            </div>
        </div>

        <div>
            <button type="submit" class="btn-primary">Edit</button>
        </div>
    </form>
</template>

<script setup>
// import { reactive } from "vue";
//import { Inertia, useForm } from "@inertiajs/vue3";
//import { useForm } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    listing: Object,
});
const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    street: props.listing.street,
    code: props.listing.code,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
});

const update = () =>
    form.put(route("listing.update", { listing: props.listing.id }));
</script>

<style scoped>
label {
    margin-right: 2em;
}
div {
    padding: 2px;
}
</style>
