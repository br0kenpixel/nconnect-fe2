<script setup lang="ts">
import type { SimplifiedCustomPage } from '~/types/public';

const config = useRuntimeConfig();
const { data } = await useFetch<SimplifiedCustomPage[]>(`${config.public.apiUrl}/custom_pages`, {
    lazy: true,
    transform(data: SimplifiedCustomPage[]) {
        return data.filter((entry) => entry.display === "bottom");
    }
});
</script>

<template>
    <div class="container-fluid text-center d-flex justify-content-center" id="root">
        <div class="row row-cols-auto">
            <NuxtLink class="col center-block" v-for="link in (data ?? [])" :to="`/custom_page/${link.id}`">
                {{ link.name }}
            </NuxtLink>
            <NuxtLink class="col center-block" :to="{ name: 'admin-login' }">Administrácia</NuxtLink>
        </div>
    </div>
</template>

<style scoped>
#root {
    background: #f0f3f5;
    margin: auto !important;
    text-align: center !important;
}

a {
    font-size: 12px;
}
</style>