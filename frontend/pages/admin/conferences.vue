<script setup lang="ts">
import type { Conference } from '~/types/private';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const config = useRuntimeConfig();
const { data, pending, error, refresh } = await useFetch<Conference[]>(`${config.public.apiUrl}/conferences`, { lazy: true });
</script>

<template>
    <div class="container">
        <h1>Manažment konferencií</h1>

        <AdminBasicOps :adder="newConferenceDialog" :eraser="() => { }" :refresher="refresh" />

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
                        Ročník
                    </th>
                    <th class="text-left">
                        Dátum konferencie
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="conference in data">
                    <td>{{ conference.year }}</td>
                    <td>{{ conference.date }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline"
                            base-color="red">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil"
                            base-color="orange">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminConferenceEditorDialog ref="conference-editor" />
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

<script lang="ts">
export default {
    methods: {
        newConferenceDialog() {
            (this.$refs['conference-editor'] as any).show();
        }
    }
}
</script>