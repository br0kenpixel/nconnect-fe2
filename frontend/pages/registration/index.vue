<script setup lang="ts">
import type { RegistrationStatus } from '~/types/public';

const config = useRuntimeConfig();
const { data } = await useFetch<RegistrationStatus>(`${config.public.apiUrl}/registrations/available`);
</script>

<template>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div id="root">
            <h1 class="text-center">Registrácia</h1>

            <div class="alert alert-danger" role="alert" v-show="data!.closed">
                ❌ Registrácie sú aktuálne uzavreté
            </div>

            <div class="text-center">
                <p>Registrujete sa na ročník {{ data!.conference!.year }}, ktorý sa bude konať {{ data!.conference!.date
                    }}.</p>
                <button type="button" class="btn btn-primary custom-btn" :disabled="data!.closed"
                    @click="$router.push({ name: 'registration-new' })">⭐️ Nová
                    registácia</button>
                <br />
                <button type="button" class="btn btn-secondary custom-btn" :disabled="data!.closed">📝
                    Zmeniť
                    moju registráciu</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
#root {
    background-color: aliceblue;
    border-radius: 10px;
    border-style: solid;
    padding: 80px !important;
}

.custom-btn {
    width: 300px;
    margin-bottom: 10px;
}
</style>