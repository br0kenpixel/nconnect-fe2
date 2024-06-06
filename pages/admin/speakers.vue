<script setup lang="ts">
definePageMeta({
    layout: 'admin',
});
</script>

<template>
    <div class="container">
        <h1>Manažment speakerov</h1>

        <div>
            <div class="top-action-btn-container">
                <v-btn prepend-icon="mdi-plus" base-color="green">
                    Pridať
                </v-btn>
            </div>

            <div class="top-action-btn-container">
                <v-btn prepend-icon="mdi-eraser" base-color="red">
                    Zmazať všetky
                </v-btn>
            </div>
        </div>
    </div>
</template>

<style scoped>
.top-action-btn-container {
    display: inline;
    margin: 1px;
}
</style>