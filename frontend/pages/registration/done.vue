<script setup lang="ts">
definePageMeta({
    layout: "registration-simple"
});

useSeoMeta({
    title: "Registrácia | nConnect",
    ogTitle: "Registrácia na konferenciu",
    description: "Registrácia na konferenciu nConnect",
    ogDescription: "Registrácia na konferenciu",
});
</script>

<template>
    <div>
        <h1 class="text-center">Registrácia ukončená</h1>

        <p class="text-center">Ďakujeme!</p>
        <div class="text-center">
            <NuxtLink :to="{ name: 'index' }">Domov</NuxtLink>
        </div>
    </div>
</template>