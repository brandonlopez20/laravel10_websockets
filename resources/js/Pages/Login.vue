<template>
    <div>
        <h2>Iniciar Sesión</h2>
        <form @submit.prevent="login">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    v-model="form.email"
                />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    v-model="form.password"
                />
            </div>
            <button type="submit" class="btn btn-primary">
                Iniciar Sesión
            </button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  email: "",
  password: "",
});

function login() {
  try {
    form.post('/login', form);
  } catch (error) {
    console.error('Error de inicio de sesión:', error);
  }
}
</script>

<style>
/* Estilos de Bootstrap 5 */
</style>
