<template>
    <div>
        <div class="top-action-btn-container">
            <v-btn prepend-icon="mdi-plus" base-color="green" @click="adder">
                Pridať
            </v-btn>
        </div>

        <div class="top-action-btn-container">
            <v-btn prepend-icon="mdi-refresh" base-color="yellow" @click="refresher">
                Aktualizovať
            </v-btn>
        </div>
    </div>
</template>

<style scoped>
.top-action-btn-container {
    display: inline;
    margin: 1px;
}
</style>

<script lang="ts">
export default {
    props: {
        adder: {
            type: Function,
            required: true,
        },
        refresher: {
            type: Function,
            required: true,
        }
    }
}
</script>