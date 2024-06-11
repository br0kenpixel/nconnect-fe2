<script setup lang="ts">
import type { Speaker } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const config = useRuntimeConfig();
const { data, pending, error, refresh } = await useFetch<Speaker[]>(`${config.public.apiUrl}/speakers`, { lazy: true });
</script>

<template>
    <div class="container">
        <h1>Manažment speakerov</h1>

        <AdminBasicOps :adder="newSpeakerDialog" :eraser="() => { }" :refresher="refresh" />

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
                        Meno
                    </th>
                    <th class="text-left">
                        Headliner
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="speaker in data">
                    <td>{{ speaker.name }}</td>
                    <td>
                        {{ speaker.headliner ? "✅" : "❌" }}
                    </td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline"
                            base-color="red">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil"
                            base-color="orange">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminSpeakerEditorDialog ref="speaker-editor" />
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
    methods: {
        newSpeakerDialog() {
            (this.$refs['speaker-editor'] as any).show();
        }
    }
}
</script>