<script lang="ts" setup>
import type { SimplifiedCustomPage } from '~/types/public';

const base_links = [
    { name: "Domov", target: "index" },
    { name: "Speakers", target: "speakers" },
    { name: "Program", target: "schedule" },
    { name: "Partneri", target: "sponsors" },
    { name: "Kontakt", target: "contact" },
    { name: "Galéria", target: "gallery" },
    { name: "Registrácia", target: "registration" },
];

const config = useRuntimeConfig();
const { data } = await useFetch<SimplifiedCustomPage[]>(`${config.public.apiUrl}/custom_pages`, {
    lazy: true,
    transform(data: SimplifiedCustomPage[]) {
        return data.filter((entry) => entry.display === "navigation");
    }
});
</script>

<template>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <NuxtLink class="navbar-brand" to="/">
                <NuxtImg src="/img/nconnect-logo.webp" alt="Logo" width="100px" height="60px" />
            </NuxtLink>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item" v-for="page in base_links">
                        <NuxtLink class="nav-link link-button"
                            :class="['nav-link', $route.name === page.target ? 'active' : '', $route.name === page.target ? 'link-button-active' : '']"
                            :to="{ name: page.target }">{{ page.name }}</NuxtLink>
                    </li>
                    <template v-if="data !== null">
                        <li class="nav-item" v-for="page in data">
                            <NuxtLink class="nav-link link-button"
                                :class="['nav-link', $route.path === `/custom_page/${page.id}` ? 'active' : '', $route.path === `/custom_page/${page.id}` ? 'link-button-active' : '']"
                                :to="`/custom_page/${page.id}`">{{ page.name }}</NuxtLink>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.link-button {
    text-transform: uppercase;
    font-family: 'Lato', sans-serif;
    margin-right: 10px;
    font-size: 14px;
    color: #777777;
}

.link-button:hover {
    background: #004953;
    color: white;
}

.link-button-active {
    background: #004953;
    color: white !important;
}
</style>
