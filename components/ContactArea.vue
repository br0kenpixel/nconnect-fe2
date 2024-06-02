<script lang="ts" setup>
const contacts = [
    { name: "John Doe", image: "/", phone: "+421 908 123 456", email: "doe@doemail.com" },
    { name: "Jeffery Nick", image: "/", phone: "+421 906 987 654", email: "nick@gmail.com" },
];
</script>

<template>
    <div id="contact-area-root">
        <div class="container" id="contact-area">
            <h5>Kontakt</h5>

            <hr>

            <div class="container text-center">
                <div class="row">
                    <div class="col-sm" v-for="contact in contacts">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <NuxtImg :src="contact.image" class="img-fluid rounded-start" :alt="contact.name" />
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
