<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from 'vue';
import axios from "axios";
import { useToast } from 'vue-toastification';

// Definir a variável reativa `dialog`
const dialog = ref(false);

const toast = useToast();

const form = useForm({
    name: "",
    zip_code: "",
    address: "",
    city: "",
    state: "",
    website: "",
});

// Função para salvar o hotel
const save = () => {
    form.post(route("hotels.store"), {
        onSuccess: () => {
            toast.success('Hotel adicionado com sucesso!');
            form.reset('name', 'zip_code', 'address', 'city', 'state', 'website');
            dialog.value = false;
        },
        onError: () => {
            toast.error('Erro ao adicionar hotel.');
        },
    });
};

// Função para buscar dados do CEP na API
const fetchCepData = async (cep) => {
    cep = cep.replace(/\D/g, "");
    //Removendo digitos não numéricos
    if (cep.length === 8) {
        // Verifica se o CEP tem 8 dígitos
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

// Observa mudanças no campo `zip_code` para buscar dados do CEP
watch(
    () => form.zip_code,
    (newCep) => {
        fetchCepData(newCep);
    }
);
</script>

<template>
    <div>
        <v-btn color="primary" @click="dialog = true">Adicionar</v-btn>
    </div>
    <v-dialog v-model="dialog" max-width="720px">
        <v-card>
            <v-card-title>
                <span class="headline">Adicionar Hotel</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                v-model="form.name"
                                label="Nome"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="4">
                            <v-text-field
                                v-model="form.zip_code"
                                label="00000-000"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="8">
                            <v-text-field
                                v-model="form.address"
                                label="Endereço"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                v-model="form.city"
                                label="Cidade"
                                readonly
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field
                                v-model="form.state"
                                label="Estado"
                                readonly
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field
                                v-model="form.website"
                                label="Site"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialog = false"
                    >Cancelar</v-btn
                >
                <v-btn color="blue darken-1" text @click="save">Salvar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
