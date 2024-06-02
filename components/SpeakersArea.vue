<script setup lang="ts">
const speakers = [
    {
        name: "Albert Einstein",
        image: "/",
        company: "Einstein Inc.",
        description: "A mad scientist."
    },
    {
        name: "John Doe",
        image: "/",
        company: "Doe Inc.",
        description: "Senior Python developer. Developed GPT-4 and DALL-E algorithms."
    },
    {
        name: "Jenna Field",
        image: "/",
        company: "DAGAMES",
        description: "Senor game developer for DAGAMES studio. Developer of popular games such as Flappy Bird."
    },
    {
        name: "Alaric Ed",
        image: "/",
        company: "EA",
        description: "Senor game developer for EA studio. Developer of popular games such as FIFA."
    }
];
</script>

<template>
    <div class="container" id="speakers-area">
        <h5>🎤 Speakers</h5>

        <hr>

        <div class="card-group">
            <div class="card" v-for="speaker in speakers">
                <NuxtImg :src="speaker.image" :alt="speaker.name" />
                <div class="card-body">
                    <h5 class="card-title">{{ speaker.name }}</h5>
                    <p class="card-text">{{ speaker.description }}</p>
                    <p class="card-text"><small class="text-body-secondary">{{ speaker.company }}</small></p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
#speakers-area {
    padding-top: 50px;
    padding-bottom: 50px;
    width: 85%;
}

h5 {
    color: #004953;
    text-transform: uppercase;
    font-weight: bold;
}
</style>
