<script lang="ts" setup>
import type { CustomPage } from '~/types/private';

definePageMeta({
    layout: 'public'
});

const config = useRuntimeConfig();
const route = useRoute();
const { data, pending, error } = await useFetch<CustomPage>(`${config.public.apiUrl}/custom_pages/${route.params.id}`);
</script>

<template>
    <div>
        <div v-if="pending" class="container">
            <h1 class="placeholder-gow">
                <span class="placeholder col-6"></span>
            </h1>

            <p class="card-text placeholder-glow" v-for="_ in 3">
                <span class="placeholder col-7"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-4"></span>
                <span class="placeholder col-6"></span>
                <span class="placeholder col-8"></span>
            </p>
        </div>

        <div class="alert alert-danger container" role="alert" v-else-if="error">
            Nepodarilo sa načítať obsah.
        </div>

        <div v-else>
            <SpecificPublicPageHeader :title="data!.name" />

            <div v-html="data!.content" class="container"></div>
        </div>
    </div>
</template>