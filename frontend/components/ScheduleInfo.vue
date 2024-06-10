<template>
    <div class="card mb-3" style="max-width: 540px;" id="card-root">
        <div class="row g-0">
            <div class="col-md-4">
                <img :src="image" class="img-fluid rounded-start" :alt="speaker" />
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ speaker }}</h5>
                    <p class="card-text">{{ employer }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
#card-root {
    border: none;
}
</style>

<script lang="ts">
export default {
    props: {
        speaker: {
            type: String,
            required: true,
        },
        image: {
            type: String,
            required: true,
        },
        employer: {
            type: String,
            required: true,
        }
    }
}
</script>