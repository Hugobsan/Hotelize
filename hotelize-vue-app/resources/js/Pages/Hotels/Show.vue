<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import RoomsList from "./Rooms/RoomsList.vue";
import HotelsEdit from "./HotelsEdit.vue";
import RoomsCreate from "./Rooms/RoomsCreate.vue";

const props = defineProps({
    hotel: {
        type: Object,
    },
});

const deleteForm = useForm({
    _method: "delete",
});

const deleteHotel = () => {
    if (confirm("Tem certeza que deseja excluir este hotel?")) {
        deleteForm.post(route("hotels.destroy", { id: props.hotel.id }), {
            onFinish: () => {
                router.visit(route("hotels.index"));
            },
        });
    }
};
</script>

<template>
    <Head title="Hotel" />

    <AuthenticatedLayout>
        <template #header>
            <div class="d-flex flex-row justify-between">
                <div>
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight"
                    >
                        {{ hotel.name }}
                    </h2>
                </div>
                <div>
                    <HotelsEdit :hotel="hotel" />
                    <v-btn class="mx-1" color="error" @click="deleteHotel"
                        >Excluir</v-btn
                    >
                </div>
            </div>
            <div>
                <!-- Exibindo address, city, state, zip_code e website caso possua-->
                <v-list lines="two">
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>Endereço</v-list-item-title>
                            <v-list-item-subtitle>{{
                                hotel.full_address
                            }}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>Site</v-list-item-title>
                            <a href="hotel.website" target="_blank" link
                                ><v-list-item-subtitle>{{
                                    hotel.website
                                }}</v-list-item-subtitle></a
                            >
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </div>
        </template>
        <div>
            <div class="d-flex flex-row justify-end my-3">
                <div>
                    <RoomsCreate :hotel="hotel" />
                </div>
            </div>
            <RoomsList :rooms="hotel.rooms" />
        </div>
    </AuthenticatedLayout>
</template>
