<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import HotelsList from '@/Pages/Hotels/HotelsList.vue';
    import { ref, watch } from 'vue';
    import axios from 'axios';

    const props = defineProps({
        hotel: {
            type: Object,
        },
    });

    const headers = [
        { title: 'Nome', value: 'name' },
        { title: 'Descrição', value: 'description' },
        { title: 'Ações', value: 'actions', sortable: false },
    ];
</script>

<template>
    <Head title="Hotel" />

    <AuthenticatedLayout>
        <template #header>
            <div class="d-flex flex-row justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{hotel.name}}</h2>
                </div>
                <div>
                    <v-btn class="mx-1" color="warning" @click="dialog = true">Editar</v-btn>
                    <v-btn class="mx-1" color="info" @click="dialog = true">Visitar Website</v-btn>
                    <v-btn class="mx-1" color="error" @click="deleteHotel">Excluir</v-btn>
                </div>
            </div>
        </template>
        <div class="mx-4 my-4">
            <div class="d-flex flex-row justify-between ">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quartos vinculados</h2>
                </div>
                <div>
                    <v-btn class="mx-1" color="success" >Cadastrar Quarto</v-btn>
                </div>
            </div>
            <v-data-table
                :headers="headers"
                :items="hotel.rooms"
                item-key="id"
                class="elevation-1"
            >
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>Quartos</v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                        <v-spacer></v-spacer>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Pesquisar"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-toolbar>
                </template>
                <template v-slot:item.actions="{ item }">
                    <v-btn small @click="editRoom(item)"
                        color="warning"
                        class="mr-2"
                    >
                        <v-icon small>mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn small @click="deleteRoom(item)"
                        color="error"
                        class="mr-2"
                    >
                        <v-icon small>mdi-delete</v-icon>
                    </v-btn>
                </template>
            </v-data-table>
        </div>
    </AuthenticatedLayout>
</template>