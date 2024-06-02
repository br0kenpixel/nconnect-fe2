<template>
    <div>
        <div class="card text-bg-dark">
            <NuxtImg src="/img/carousel/nconnect.jpg" class="card-img" alt="Nconnect" />
            <div class="container card-img-overlay d-flex flex-column">
                <p class="card-text mt-auto">Domov / {{ title }}</p>
                <h1 class="card-title">{{ title }}</h1>
            </div>
        </div>
    </div>
</template>

<style scoped>
h1,
p {
    text-transform: uppercase;
    font-weight: bold;
}

img {
    filter: brightness(50%);
}
</style>

<script lang="ts">
export default {
    props: {
        title: {
            type: String,
            required: true
        }
    }
}
</script>