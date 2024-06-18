<script setup lang="ts">
definePageMeta({
    layout: "registration-simple"
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