<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";

const dialog = ref(false);

const props = defineProps({
    room: Object,
});

const toast = useToast();

const form = useForm({
    hotel_id: props.room.hotel_id,
    name: props.room.name,
    description: props.room.description,
    _method: "put",
});

const save = () => {
    form.post(route("rooms.update", { id: props.room.id }), {
        onSuccess: () => {
            toast.success("Quarto editado com sucesso!");
            form.reset("name", "description");
            dialog.value = false;
        },
        onError: () => {
            toast.error("Erro ao editar quarto.");
        },
    });
};
</script>

<template>
    <v-btn small @click="dialog = true" color="primary" class="mr-2">
        <v-icon small>mdi-pencil</v-icon>
    </v-btn>
    <v-dialog v-model="dialog" max-width="720px">
        <v-card>
            <v-card-title
                ><span class="headline">Editar Quarto</span></v-card-title
            >
            <v-card-text>
                <v-form @submit.prevent="save">
                    <input type="hidden" name="hotel_id" :value="room.hotel_id" />
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="form.name"
                                    label="Nome"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="form.description"
                                    label="Descrição"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                    <v-btn class="float-right" type="submit" color="primary"
                        >Salvar</v-btn
                    >
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
