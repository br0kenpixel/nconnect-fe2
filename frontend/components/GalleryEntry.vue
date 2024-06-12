<script setup lang="ts">
import type { FullSchedule, SimplifiedStage } from '~/types/public';

const config = useRuntimeConfig();

//const { data, pending, error } = await useFetch<FullSchedule[]>(`${config.public.apiUrl}/schedule`, { lazy: true });
</script>

<template>
    <div id="gallery-area-root">
        <div class="container" id="gallery-area">
            <h5 v-if="!placeholder">📸 Ročník - {{ year }}</h5>
            <h5 v-else>📸 Ročník - <span class="placeholder col-2"></span></h5>

            <hr>

            <div class="container" v-if="placeholder">
                <div class="container text-center pa-1 ma-1">
                    <div class="row">
                        <div class="col-sm placeholder-glow"><span class="fake-img placeholder col-8"></span></div>
                        <div class="col-sm placeholder-glow"><span class="fake-img placeholder col-8"></span></div>
                        <div class="col-sm placeholder-glow"><span class="fake-img placeholder col-8"></span></div>
                    </div>
                </div>
            </div>

            <div class="container" v-else-if="images.length === 0">
                <p class="text-center">Prázdna</p>
            </div>

            <div class="container" v-else>
                <div class="text-center" v-for="image in images">
                    <img :src="image.image" class="rounded ma-2" alt="...">
                </div>
            </div>
            <br>
        </div>
    </div>
</template>

<style scoped>
#gallery-area {
    padding-top: 50px;
    padding-bottom: 50px;
    width: 85%;
}

#gallery-area-root {
    background: #f0f3f5;
}

.fake-img {
    height: 200px;
}

h5 {
    color: #004953;
    text-transform: uppercase;
    font-weight: bold;
}
</style>

<script lang="ts">
export default {
    props: {
        placeholder: {
            type: Boolean,
            required: false,
            default: false,
        },
        year: {
            type: Number,
            required: false,
            default: 0
        },
        images: {
            type: Object,
            required: false,
            default: []
        }
    }
}
</script>