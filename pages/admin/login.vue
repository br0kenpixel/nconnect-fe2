<template>
    <v-app>
        <v-sheet class="pa-14" rounded>
            <h3 class="text-center">Prihlásenie</h3>

            <v-alert v-if="error !== null" density="compact" text="Zadané prihlasovacie meno alebo heslo je nesprávne."
                title="Chyba" type="error" id="login-error-alert" class="mx-auto"></v-alert>

            <br>

            <v-card class="mx-auto px-6 py-8" max-width="344">
                <v-form v-model="form" @submit.prevent="onSubmit">
                    <v-text-field v-model="email" :disabled="loading" :rules="[required]" class="mb-2" label="Email"
                        clearable></v-text-field>

                    <v-text-field v-model="password" :disabled="loading" :rules="[required]" label="Heslo"
                        placeholder="Zadajte heslo" clearable></v-text-field>

                    <br>

                    <v-btn :disabled="!form" :loading="loading" color="success" size="large" type="submit"
                        variant="elevated" block>
                        Prihlásiť
                    </v-btn>
                </v-form>
            </v-card>
        </v-sheet>
    </v-app>
</template>

<style scoped>
#login-error-alert {
    width: 40%;
}
</style>

<script lang="ts">
export default {
    data: () => ({
        form: false,
        email: null,
        password: null,
        loading: false,
        error: null as (null | string)
    }),

    methods: {
        onSubmit() {
            if (!this.form) return;
            this.loading = true;

            setTimeout(() => (this.loading = false), 4000);
        },
        required(v: any) {
            return !!v || 'Povinné pole';
        },
    },
}
</script>