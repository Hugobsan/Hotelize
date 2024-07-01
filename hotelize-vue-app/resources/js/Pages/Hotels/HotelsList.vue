<script setup>
import { router } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import "@mdi/font/css/materialdesignicons.css";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    hotels: Array,
});

const deleteForm = useForm({
    _method: "delete",
});

const headers = [
    { title: "Nome", value: "name" },
    { title: "Endereço", value: "full_address" },
    { title: "Ações", value: "actions", sortable: false },
];

const search = ref("");

const filteredHotels = computed(() => {
    if (!search.value) {
        return props.hotels;
    }
    return props.hotels.filter(
        (hotel) =>
            hotel.name.toLowerCase().includes(search.value.toLowerCase()) ||
            hotel.full_address
                .toLowerCase()
                .includes(search.value.toLowerCase())
    );
});

const showHotel = (hotel) => {
    router.visit(route("hotels.show", { id: hotel.id }));
};

const deleteHotel = (hotel) => {
    if (confirm("Tem certeza que deseja excluir este hotel?")) {
        deleteForm.post(route("hotels.destroy", { id: hotel.id }), {
            onFinish: () => {
                router.visit(route("hotels.index"));
            },
        });
    }
};
</script>

<template>
    <v-data-table
        :headers="headers"
        :items="filteredHotels"
        item-key="id"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Hotéis</v-toolbar-title>
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
            <v-btn small @click="showHotel(item)" color="primary" class="mr-2">
                <v-icon small>mdi-eye</v-icon>
            </v-btn>
            <v-btn small @click="deleteHotel(item)" color="error">
                <v-icon small>mdi-delete</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>
