<script lang="ts" setup>
const links = [
    { name: "Domov", target: "index" },
    { name: "Speakers", target: "speakers" },
    { name: "Program", target: "schedule" },
    { name: "Partneri", target: "sponsors" },
    { name: "Kontakt", target: "contact" },
    { name: "Registrácia", target: "test" },
];
</script>

<template>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <NuxtImg src="/img/nconnect-logo.png" alt="Logo" width="100px" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item" v-for="page in links">
                        <NuxtLink class="nav-link link-button"
                            :class="['nav-link', $route.name === page.target ? 'active' : '', $route.name === page.target ? 'link-button-active' : '']"
                            :to="{ name: page.target }">{{ page.name }}</NuxtLink>
                    </li>
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
