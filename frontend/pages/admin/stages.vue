<script setup lang="ts">
import type { Stage } from '~/types/private';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const config = useRuntimeConfig();
const { data, pending, error, refresh } = await useFetch<Stage[]>(`${config.public.apiUrl}/stages`, { lazy: true });
</script>

<template>
    <div class="container">
        <h1>Manažment stageov</h1>

        <AdminBasicOps :adder="newStageDialog" :eraser="() => { }" :refresher="refresh" />

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
                        Ročník
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="stage in data">
                    <td>{{ stage.name }}</td>
                    <td>
                        {{ stage.conference.year }}
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

        <AdminStageEditorDialog ref="stage-editor" />
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
        newStageDialog() {
            (this.$refs['stage-editor'] as any).show();
        }
    }
}
</script>