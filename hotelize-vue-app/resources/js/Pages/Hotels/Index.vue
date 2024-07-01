<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import HotelsList from '@/Pages/Hotels/HotelsList.vue';
import HotelsCreate from '@/Pages/Hotels/HotelsCreate.vue';

import axios from 'axios';

const props = defineProps({
    hotels: {
        type: Array,
    },
});
</script>

<template>
    <Head title="Hotéis" />

    <AuthenticatedLayout>
        <template #header>
            <div class="d-flex flex-row justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Hotéis</h2>
                </div>
                <HotelsCreate />

            </div>
        </template>
        <div class="mt-1">
            <HotelsList :hotels="hotels" />
        </div>
    </AuthenticatedLayout>
</template>
