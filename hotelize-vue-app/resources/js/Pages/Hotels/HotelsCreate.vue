<template>
    <v-dialog v-model="dialog" max-width="720px">
        <v-card>
            <v-card-title>
                <span class="headline">Adicionar Hotel</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field v-model="form.name" label="Nome"></v-text-field>
                        </v-col>
                        <v-col cols="4">
                            <v-text-field v-model="form.zip_code" label="CEP" v-mask="'#####-###'"
                                @input="fetchCepData"></v-text-field>
                        </v-col>
                        <v-col cols="8">
                            <v-text-field v-model="form.address" label="Endereço"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field v-model="form.city" label="Cidade"></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field v-model="form.state" label="Estado"></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field v-model="form.website" label="Site"></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialog = false">Cancelar</v-btn>
                <v-btn color="blue darken-1" text @click="save">Salvar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import { useRouter } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/inertia-vue3';

const dialog = ref(false);
const form = useForm({
    name: '',
    zip_code: '',
    address: '',
    city: '',
    state: '',
    website: '',
});

const router = useRouter();

const save = () => {
    form.post(route('hotels.store'), {
        onFinish: () => {
            form.reset('name', 'zip_code', 'address', 'city', 'state', 'website');
            dialog.value = false;
        },
    });
};

const fetchCepData = async () => {
    const rawCep = form.zip_code.replace(/\D/g, '');
    if (rawCep.length === 8) {
        try {
            const response = await axios.get(route('api.cep', { cep: rawCep }));
            const data = response.data;
            form.city = data.localidade;
            form.state = data.uf;
        } catch (error) {
            console.error('Erro ao buscar dados do CEP:', error);
        }
    }
};

watch(() => form.zip_code, fetchCepData);
</script>
