<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from 'vue';
import axios from "axios";
import { useToast } from 'vue-toastification';

const dialog = ref(false);

const props = defineProps({
    hotel: Object
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
            toast.success('Hotel atualizado com sucesso!');
            dialog.value = false;
        },
        onError: () => {
            toast.error('Erro ao atualizar hotel.');
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
            toast.error('Erro ao buscar dados do CEP.');
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
                    <v-text-field
                        v-model="form.name"
                        label="Nome"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="form.zip_code"
                        label="CEP"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="form.address"
                        label="Endereço"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="form.city"
                        label="Cidade"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="form.state"
                        label="Estado"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="form.website"
                        label="Website"
                    ></v-text-field>
                    <v-btn type="submit" color="primary">Salvar</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
