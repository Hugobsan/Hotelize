<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";

const dialog = ref(false);

const props = defineProps({
    hotel: Object,
});

const toast = useToast();

const form = useForm({
    hotel_id: props.hotel.id,
    name: "",
    description: "",
});

const save = () => {
    form.post(route("hotels.rooms.store", { hotel: props.hotel.id }), {
        onSuccess: () => {
            toast.success("Quarto adicionado com sucesso!");
            form.reset("name", "description");
            dialog.value = false;
        },
        onError: () => {
            toast.error("Erro ao adicionar quarto.");
        },
    });
};
</script>

<template>
    <v-btn color="success" @click="dialog = true">Novo Quarto</v-btn>
    <v-dialog v-model="dialog" max-width="720px">
        <v-card>
            <v-card-title><span class="headline">Cadastrar Quarto</span></v-card-title>
            <v-card-text>
                <v-form @submit.prevent="save">
                    <input type="hidden" name="hotel_id" :value="hotel.id">
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
                    <v-btn class="float-right" type="submit" color="primary">Salvar</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>