<script setup lang="ts">
import type { Review } from '~/types/public';

const config = useRuntimeConfig();
const { data, pending, error } = await useFetch<Review[]>(`${config.public.apiUrl}/reviews`, { lazy: true });
</script>

<template>
    <div id="reviews-area-root">
        <div class="container" id="reviews-area">
            <h2 class="text-center">Povedali o nás</h2>

            <hr>

            <div class="mx-auto text-center" v-if="pending">
                <p id="loading-text">Načítavam...</p>
            </div>

            <div class="alert alert-danger" role="alert" v-else-if="error">
                Nepodarilo sa načítať obsah.
            </div>

            <div v-else>
                <Review v-for="review in data" :name="review.name" :text="review.opinion" :position="review.position"
                    :image="review.image" class="mx-auto" />
            </div>
        </div>
    </div>
</template>

<style scoped>
#reviews-area {
    padding-top: 50px;
    padding-bottom: 50px;
    width: 85%;
}

#loading-text {
    color: white;
}

#reviews-area-root {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("~/public/img/testimonial.jpg");
}

h2 {
    color: white;
    text-transform: uppercase;
    font-weight: bold;
}

hr {
    color: white;
}
</style>
