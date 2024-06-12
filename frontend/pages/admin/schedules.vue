<script setup lang="ts">
import type { Conference, Stage } from '~/types/private';
import type { FullSchedule, Schedule, SimplifiedStage, Speaker } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

type EditorData = {
    id: number | null;
    title: string;
    description: string;
    start: string;
    end: string;
    stage: Stage;
    speaker: Speaker | null;
    seats: number;
};

const config = useRuntimeConfig();
const dialog = ref(null as any);
const client = useSanctumClient();
const { data, pending, error, refresh } = await useFetch<FullSchedule[]>(`${config.public.apiUrl}/schedule`, { lazy: true });

function newScheduleDialog() {
    dialog.value!.show();
}

async function handleEditor(result: EditorData) {
    if (result.id === null) {
        await createNewSchedule(result.title, result.description, result.start, result.end, result.stage, result.speaker, result.seats);
    } else {
        await updateSchedule(result.id, result.title, result.description, result.start, result.end, result.stage, result.speaker, result.seats);
    }
}

async function createNewSchedule(
    title: string,
    description: string,
    start: string,
    end: string,
    stage: Stage,
    speaker: Speaker | null,
    seats: number
) {
    try {
        await client(`/api/schedule`, {
            method: "PUT",
            body: {
                title: title,
                description: description,
                start: start,
                end: end,
                stage: stage.id,
                speaker: speaker !== null ? speaker.id : null,
                seats: seats
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function updateSchedule(
    id: number,
    title: string,
    description: string,
    start: string,
    end: string,
    stage: Stage,
    speaker: Speaker | null,
    seats: number
) {
    try {
        await client(`/api/schedule/${id}`, {
            method: "POST",
            body: {
                title: title,
                description: description,
                start: start,
                end: end,
                stage: stage.id,
                speaker: speaker !== null ? speaker.id : null,
                seats: seats
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deleteSchedule(id: number) {
    try {
        await client(`/api/schedule/${id}`, {
            method: "DELETE"
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function editSchedule(schedule: Schedule, stage: SimplifiedStage, full_sched: FullSchedule) {
    let full_stage: Stage = {
        id: stage.id,
        conference: {
            id: full_sched.id,
            year: full_sched.year,
            date: full_sched.date
        },
        name: stage.name
    };

    dialog.value!.show(schedule, full_stage);
}
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
                                    base-color="red" @click="async () => deleteSchedule(entry.id)">Zmazať</v-btn>
                                <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                                    @click="() => editSchedule(entry, stage, conference)">Editovať</v-btn>
                            </td>
                        </tr>
                    </template>
                </template>
            </tbody>
        </v-table>

        <AdminScheduleEditorDialog ref="dialog" @finished="handleEditor" />
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