<script lang="ts" setup></script>

<template>
    <div class="card mb-3 card-custom" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <NuxtImg :src="image" class="img-fluid rounded-start" :alt="name" />
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ name }}</h5>
                    <p class="card-text">{{ text }}</p>
                    <p class="card-text"><small>{{ position }}</small></p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.card-custom {
    background: transparent;
    border: none;
}

h5,
p,
small {
    color: white;
}
</style>

<script lang="ts">
export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        text: {
            type: String,
            required: true,
        },
        position: {
            type: String,
            required: true,
        },
        image: {
            type: String,
            required: true,
        }
    }
}
</script>