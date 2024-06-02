<script lang="ts" setup>
const sponsors = [
    { name: "Google", image: "/" },
    { name: "Microsoft", image: "/" },
    { name: "IBM", image: "/" },
    { name: "Meta", image: "/" },
];
</script>

<template>
    <div id="sponsors-area-root">
        <div class="container" id="sponsors-area">
            <h5>Naši partneri</h5>

            <hr>

            <div class="container text-center">
                <div class="row">
                    <div class="col-sm" v-for="sponsor in sponsors">
                        <NuxtImg :src="sponsor.image" :alt="sponsor.name" />
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

h5 {
    color: #004953;
    text-transform: uppercase;
    font-weight: bold;
}
</style>
