<script lang="ts" setup>
import type { Gallery } from '~/types/public';

definePageMeta({
    layout: 'public'
});

const config = useRuntimeConfig();
const { data, pending, error } = await useFetch<Gallery[]>(`${config.public.apiUrl}/gallery`, { lazy: true });
</script>

<template>
    <div>
        <SpecificPublicPageHeader title="Galéria" />

        <GalleryEntry placeholder v-if="pending" />

        <div class="alert alert-danger" role="alert" v-else-if="error">
            Nepodarilo sa načítať obsah.
        </div>

        <GalleryEntry v-for="conference in data" :year="conference.conference.year" :images="conference.gallery"
            v-else />
    </div>
</template>

<style scoped></style>
