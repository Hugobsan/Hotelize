<template>
    <v-container class="d-flex justify-center align-center min-h-screen">
      <v-card class="pa-4" outlined>
        <v-card-title class="text-h5 text-center">Login</v-card-title>
        <v-card-text>
          <form @submit.prevent="submit">
            <v-text-field
              v-model="form.email"
              label="E-mail"
              name="email"
              type="email"
              :error-messages="errors.email"
              required
            ></v-text-field>
  
            <v-text-field
              v-model="form.password"
              label="Senha"
              name="password"
              :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
              :type="showPassword ? 'text' : 'password'"
              @click:append="showPassword = !showPassword"
              :error-messages="errors.password"
              required
            ></v-text-field>
  
            <v-btn type="submit" color="primary" class="mt-4" block>Entrar</v-btn>
          </form>
        </v-card-text>
        <v-card-actions>
          <v-btn text @click="goToRegister">Não possui uma conta? Cadastre-se</v-btn>
        </v-card-actions>
      </v-card>
    </v-container>
  </template>
  
  <script>
  import { ref } from 'vue'
  import { useForm } from '@inertiajs/vue3'
  import { usePage } from '@inertiajs/inertia-vue3'

  export default {
    setup() {
      const showPassword = ref(false)
      const form = useForm({
        email: '',
        password: '',
      })

      const { $inertia } = usePage()
      
      const submit = () => {
        form.post(route('login'))
      }
  
      const goToRegister = () => {
      $inertia.visit(route('users.create'))
    }
  
      return {
        form,
        showPassword,
        submit,
        goToRegister,
        errors: form.errors,
      }
    },
  }
  </script>
  
  <style scoped>
  .min-h-screen {
    min-height: 100vh;
  }
  </style>
  