<script setup lang="ts">
import type { RegistrationStatus } from '~/types/public';

definePageMeta({
    layout: "registration-simple"
});

useSeoMeta({
    title: "Registrácie | nConnect",
    ogTitle: "Registrácia na konferenciu",
    description: "Registrácia na konferenciu nConnect",
    ogDescription: "Registrácia na konferenciu",
});

const config = useRuntimeConfig();
const { data } = await useFetch<RegistrationStatus>(`${config.public.apiUrl}/registrations/available`);
</script>

<template>
    <div>
        <h1 class="text-center">Registrácia</h1>

        <div class="alert alert-danger" role="alert" v-if="data!.closed">
            ❌ Registrácie sú aktuálne uzavreté
        </div>

        <div class="text-center" v-else>
            <p>Registrujete sa na ročník {{ data!.conference!.year }}, ktorý sa bude konať {{ data!.conference!.date
                }}.</p>
            <button type="button" class="btn btn-primary custom-btn" :disabled="data!.closed"
                @click="$router.push({ name: 'registration-new' })">⭐️ Nová
                registácia</button>
        </div>
    </div>
</template>