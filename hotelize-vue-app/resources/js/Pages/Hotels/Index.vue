<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { VListItem } from 'vuetify/lib/components/index.mjs';

defineProps({
    hotels: {
        type: Array,
    },
});

</script>

<template>
    <Head title="Hotéis" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Hotéis</h2>
        </template>
        <!-- <VList lines="one">
            <VListItem v-for="n in 3" :key="n" :title="'Item ' + n"
                subtitle="Lorem ipsum dolor sit amet consectetur adipisicing elit"></VListItem>
        </VList> -->
        <!-- <v-content>
            <table class="
            min-w-full
            bg-white
            border
            border-gray-300
            divide-y
            divide-gray-300
        ">
                <thead>
                    <tr>
                        <th class="text-left">Nome</th>
                        <th class="text-left">Endereço</th>
                        <th class="text-left">CEP</th>
                        <th class="text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="hotel in hotels" :key="hotel.id">
                        <td>{{ hotel.name }}</td>
                        <td>{{ hotel.address }}</td>
                        <td>{{ hotel.zip_code }}</td>
                        <td>
                            <Link v-if="hotel.website" :href="hotel.website">Site</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </v-content> -->


        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div> -->

    </AuthenticatedLayout>
</template>