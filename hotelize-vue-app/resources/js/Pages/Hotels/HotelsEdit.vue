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
    name: props.hotel.name,
    zip_code: props.hotel.zip_code,
    address: props.hotel.address,
    city: props.hotel.city,
    state: props.hotel.state,
    website: props.hotel.website,
    _method: "put",
});

const save = () => {
    form.post(route("hotels.update", { id: props.hotel.id }), {
        onSuccess: () => {
            toast.success("Hotel atualizado com sucesso!");
            dialog.value = false;
        },
        onError: () => {
            toast.error("Erro ao atualizar hotel.");
        },
    });
};

const fetchCepData = async (cep) => {
    cep = cep.replace(/\D/g, ""); // Remover dígitos não numéricos
    if (cep.length === 8) {
        try {
            const response = await axios.get(route("api.cep", { cep }));
            const data = response.data;

            form.city = data.localidade;
            form.state = data.uf;
        } catch (error) {
            toast.error("Erro ao buscar dados do CEP.");
        }
    }
};

watch(
    () => form.zip_code,
    (newCep) => {
        fetchCepData(newCep);
    }
);
</script>

<template>
    <v-btn color="primary" @click="dialog = true">Editar</v-btn>
    <v-dialog v-model="dialog" max-width="720px">
        <v-card>
            <v-card-title>Editar Hotel</v-card-title>
            <v-card-text>
                <v-form @submit.prevent="save">
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="12">
                                <v-text-field
                                    v-model="form.name"
                                    label="Nome"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="4">
                                <v-text-field
                                    v-model="form.zip_code"
                                    label="CEP"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="8">
                                <v-text-field
                                    v-model="form.address"
                                    label="Endereço"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12">
                                <v-text-field
                                    v-model="form.city"
                                    label="Cidade"
                                    readonly
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    v-model="form.state"
                                    label="Estado"
                                    readonly
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    v-model="form.website"
                                    label="Site"
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
