<script setup>
import { router } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import "@mdi/font/css/materialdesignicons.css";
import { useForm } from "@inertiajs/vue3";
import RoomsEdit from "./RoomsEdit.vue";

const props = defineProps({
    rooms: Array,
});

const headers = [
    { title: "Nome", value: "name" },
    { title: "Descrição", value: "description" },
    { title: "Ações", value: "actions", sortable: false },
];

const search = ref("");

const filteredRooms = computed(() => {
    if (!search.value) {
        return props.rooms;
    }
    return props.rooms.filter(
        (room) =>
            room.name.toLowerCase().includes(search.value.toLowerCase()) ||
            room.description.toLowerCase().includes(search.value.toLowerCase())
    );
});

const deleteRoom = (room) => {
    if (confirm("Tem certeza que deseja excluir este quarto?")) {
        router.delete(route("rooms.destroy", room.id));
    }
};
</script>

<template>
    <v-data-table
        :headers="headers"
        :items="filteredRooms"
        item-key="id"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Quartos vinculados</v-toolbar-title>
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
            <RoomsEdit :room="item" />
            <v-btn small @click="deleteRoom(item)" color="error" class="mr-2">
                <v-icon small>mdi-delete</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>
