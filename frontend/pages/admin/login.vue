<script lang="ts" setup>
import { FetchError } from 'ofetch';

definePageMeta({
    middleware: ['sanctum:guest'],
});

const form = ref({
    email: "",
    password: "",
});
const loading = ref(false);
const error = ref(null as null | string);
const { login } = useSanctumAuth();

async function handleLogin() {
    error.value = null;
    loading.value = true;

    try {
        await login({
            email: form.value.email,
            password: form.value.password
        });
    } catch (e) {
        if (e instanceof FetchError && e.response?.status === 422) {
            error.value = e.response?._data.message;
        }
    } finally {
        loading.value = false;
    }
}

function required(v: any) {
    return !!v || 'Povinné pole';
}
</script>

<template>
    <v-app>
        <v-sheet class="pa-14" rounded>
            <h3 class="text-center">Prihlásenie</h3>

            <v-alert v-if="error !== null" density="compact" :text="error" title="Chyba" type="error"
                id="login-error-alert" class="mx-auto"></v-alert>

            <br>

            <v-card class="mx-auto px-6 py-8" max-width="344">
                <v-form @submit.prevent="handleLogin">
                    <v-text-field v-model="form.email" :disabled="loading" :rules="[required]" class="mb-2"
                        label="Email" clearable></v-text-field>

                    <v-text-field v-model="form.password" :disabled="loading" :rules="[required]" label="Heslo"
                        placeholder="Zadajte heslo" clearable type="password"></v-text-field>

                    <br>

                    <v-btn :disabled="!form" :loading="loading" color="success" size="large" type="submit"
                        variant="elevated" block>
                        Prihlásiť
                    </v-btn>
                </v-form>
                <div class="text-center">
                    <NuxtLink to="/">Späť na domovskú stránku</NuxtLink>
                </div>
            </v-card>
        </v-sheet>
    </v-app>
</template>

<style scoped>
#login-error-alert {
    width: 40%;
}
</style>