<script setup lang="ts">
import type { FullSchedule } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const config = useRuntimeConfig();
const { data, pending, error, refresh } = await useFetch<FullSchedule[]>(`${config.public.apiUrl}/schedule`, { lazy: true });
</script>

<template>
    <div class="container">
        <h1>Manažment prednášok</h1>

        <AdminBasicOps :adder="newScheduleDialog" :eraser="() => { }" :refresher="refresh" />

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
                        Čas
                    </th>
                    <th class="text-left">
                        Speaker
                    </th>
                    <th class="text-left">
                        Stage
                    </th>
                    <th class="text-left">
                        Kedy
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
                <template v-for="conference in data">
                    <template v-for="stage in conference.stages">
                        <tr v-for="entry in stage.schedule">
                            <td>{{ entry.title }}</td>
                            <td>{{ entry.start }} - {{ entry.end }}</td>
                            <td>{{ entry.speaker === null ? "-" : entry.speaker.name }}</td>
                            <td>{{ stage.name }}</td>
                            <td>{{ conference.date }}</td>
                            <td>{{ conference.year }}</td>
                            <td class="text-right">
                                <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline"
                                    base-color="red">Zmazať</v-btn>
                                <v-btn class="m-1" density="compact" append-icon="mdi-pencil"
                                    base-color="orange">Editovať</v-btn>
                            </td>
                        </tr>
                    </template>
                </template>
            </tbody>
        </v-table>

        <AdminScheduleEditorDialog ref="schedule-editor" />
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
        newScheduleDialog() {
            (this.$refs['schedule-editor'] as any).show();
        }
    }
}
</script>