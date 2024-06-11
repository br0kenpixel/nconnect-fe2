<script setup lang="ts">
import type { SimplifiedCustomPage } from '~/types/public';

definePageMeta({
    layout: 'admin'
});

const config = useRuntimeConfig();
const { data, pending, error } = await useFetch<SimplifiedCustomPage[]>(`${config.public.apiUrl}/custom_pages`, { lazy: true });
</script>

<template>
    <div class="container">
        <h1>Moje stránky</h1>

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

        <p v-if="pending">
            Načítavam...
        </p>

        <div class="alert alert-danger" role="alert" v-else-if="error">
            Nepodarilo sa načítať obsah.
        </div>

        <v-table v-else>
            <thead>
                <tr>
                    <th class="text-left">
                        Názov
                    </th>
                    <th class="text-left">
                        Zobrazené
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="page in data">
                    <td>{{ page.name }}</td>
                    <td>{{ page.display === "none" ? "-" : (page.display === "navigation" ? "Nav. panel" : "Dolná nav.")
                        }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline"
                            base-color="red">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil"
                            base-color="orange">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>
    </div>
</template>

<style scoped>
.top-action-btn-container {
    display: inline;
    margin: 1px;
}

th {
    font-weight: bold !important;
}
</style>