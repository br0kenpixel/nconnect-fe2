<script setup lang="ts">
const registration_status = {
    closed: false,
};
</script>

<template>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div id="root">
            <h1 class="text-center">Registrácia ukončená</h1>

            <p class="text-center">Ďakujeme!</p>
            <div class="text-center">
                <NuxtLink :to="{ name: 'index' }">Domov</NuxtLink>
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