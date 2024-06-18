<script setup lang="ts">
import type { Speaker } from '~/types/public';

const config = useRuntimeConfig();
const { data, pending, error } = await useFetch<Speaker[]>(`${config.public.apiUrl}/speakers`);
</script>

<template>
    <div class="container" id="speakers-area">
        <h5>🎤 Speakers</h5>

        <hr>

        <div class="card-group" v-if="pending">
            <div class="card" v-for="_ in 5" aria-hidden="true">
                <span class="card-img-top placeholder-glow placeholder" style="height: 250px;"></span>
                <div class="card-body">
                    <h5 class="card-title speaker-name placeholder-glow"><span class="placeholder col-6"></span></h5>
                    <p class="card-text placeholder-glow"><span class="placeholder col-3"></span></p>
                    <p class="card-text placeholder-glow"><small class="text-body-secondary"><span
                                class="placeholder col-2"></span></small></p>
                </div>
            </div>
        </div>

        <div class="alert alert-danger" role="alert" v-else-if="error">
            Nepodarilo sa načítať obsah.
        </div>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col mx-auto" v-for="speaker in data">
                <div class="card h-100">
                    <img :src="speaker.image" class="card-img-top" :alt="speaker.name">
                    <div class="card-body">
                        <h5 class="card-title speaker-name">{{ speaker.name }}</h5>
                        <strong v-show="speaker.headliner">⭐️ Headliner</strong>
                        <p class="card-text"><small class="text-body-secondary">{{ speaker.company }}</small></p>
                    </div>
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

.speaker-name {
    color: black;
}

h5 {
    color: #004953;
    text-transform: uppercase;
    font-weight: bold;
}
</style>
