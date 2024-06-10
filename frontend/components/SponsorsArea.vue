<script lang="ts" setup>
import type { Sponsor } from '~/types/public';

const config = useRuntimeConfig();

const { data, pending, error } = await useFetch<Sponsor[]>(`${config.public.apiUrl}/sponsors`);
</script>

<template>
    <div id="sponsors-area-root">
        <div class="container" id="sponsors-area">
            <h5>Naši partneri</h5>

            <hr>

            <div class="container text-center" v-if="pending">
                <div class="row placeholder-glow">
                    <div class="col-sm" v-for="_ in 4">
                        <span class="placeholder col-6 loading-sponsor"></span>
                    </div>
                </div>
            </div>

            <div class="alert alert-danger" role="alert" v-else-if="error">
                Nepodarilo sa načítať obsah.
            </div>

            <div class="container text-center" v-else>
                <div class="row">
                    <div class="col-sm" v-for="sponsor in data">
                        <img :src="sponsor.image" :alt="sponsor.name" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
#sponsors-area {
    padding-top: 50px;
    padding-bottom: 50px;
    width: 85%;
}

#sponsors-area-root {
    background: #f0f3f5;
}

.loading-sponsor {
    height: 100px;
    border-radius: 10px;
}

h5 {
    color: #004953;
    text-transform: uppercase;
    font-weight: bold;
}
</style>
