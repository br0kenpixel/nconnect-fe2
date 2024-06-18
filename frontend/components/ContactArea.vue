<script lang="ts" setup>
import type { Contact } from '~/types/public';

const config = useRuntimeConfig();
const { data, pending, error } = await useFetch<Contact[]>(`${config.public.apiUrl}/contacts`, { lazy: true });
</script>

<template>
    <div id="contact-area-root">
        <div class="container" id="contact-area">
            <h5>Kontakt</h5>

            <hr>

            <div class="container text-center" v-if="pending">
                <div class="row">
                    <div class="col-sm" v-for="_ in 2">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-8 placeholder-glow">
                                    <div class="card-body">
                                        <h5 class="card-title black-text"><span class="placeholder col-6"></span></h5>
                                        <p class="card-text gray-text non-uppercase">
                                            <span class="placeholder col-6"></span>
                                        </p>
                                        <p class="card-text gray-text non-uppercase">
                                            <span class="placeholder col-6"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-danger" role="alert" v-else-if="error">
                Nepodarilo sa načítať obsah.
            </div>

            <div class="container text-center" v-else>
                <div class="row">
                    <div class="col-sm" v-for="contact in data">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img :src="contact.image" class="img-fluid rounded-start img-custom"
                                        :alt="contact.name" />
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title black-text">{{ contact.name }}</h5>
                                        <p class="card-text gray-text non-uppercase">
                                            <a :href="`mailto:${contact.email}`">{{ contact.email }}</a>
                                        </p>
                                        <p class="card-text gray-text non-uppercase">
                                            <a :href="`tel:${contact.phone}`">{{ contact.phone }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map image -->

            <div class="card custom-card mx-auto">
                <NuxtImg src="/img/location.jpeg" class="card-img custom-card-img" alt="Location" />
                <div class="card-img-overlay">
                    <h5 class="card-title custom-card-title">DRAŽOVSKÁ 2, NITRA</h5>
                    <p class="card-text">ŠTUDENTSKÉ CENTRUM UKF</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
#contact-area {
    padding-top: 50px;
    padding-bottom: 50px;
    width: 85%;
}

#contact-area-root {
    background: #f0f3f5;
}

h5 {
    color: #004953;
    text-transform: uppercase;
    font-weight: bold;
}

p {
    color: white;
    text-transform: uppercase;
}

a {
    text-decoration: unset;
    color: unset;
}

.img-custom {
    height: 130px;
}

.custom-card {
    width: 50%;
}

.black-text {
    color: black;
}

.gray-text {
    color: #777;
}

.non-uppercase {
    text-transform: none;
}

@media screen and (max-width: 900px) {
    .custom-card {
        width: 100%;
    }
}

.custom-card-title {
    color: white;
}

.custom-card-img {
    border-color: black;
    filter: brightness(75%);
}
</style>
