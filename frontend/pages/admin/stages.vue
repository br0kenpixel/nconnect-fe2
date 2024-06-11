<script setup lang="ts">
import type { Conference, Stage } from '~/types/private';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const dialog = ref(null as any);
const config = useRuntimeConfig();
const client = useSanctumClient();
const { data, pending, error, refresh } = await useFetch<Stage[]>(`${config.public.apiUrl}/stages`, { lazy: true });

function newStageDialog() {
    dialog.value!.show();
}

async function handleEditor(result: { id: null | number, name: string, conference: Conference }) {
    if (result.id === null) {
        await createNewStage(result.name, result.conference);
    } else {
        await updateConference(result.id, result.name, result.conference);
    }
}

async function createNewStage(name: string, conference: Conference) {
    try {
        await client(`/api/stages`, {
            method: "PUT",
            body: {
                name: name,
                conference: conference.id
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function updateConference(id: number, name: string, conference: Conference) {
    try {
        await client(`/api/stages/${id}`, {
            method: "POST",
            body: {
                name: name,
                conference: conference.id
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deleteStage(id: number) {
    try {
        await client(`/api/stages/${id}`, {
            method: "DELETE"
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function editStage(stage: Stage) {
    dialog.value!.show(stage);
}
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
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline" base-color="red"
                            @click="async () => deleteStage(stage.id)">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="() => editStage(stage)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminStageEditorDialog ref="dialog" @finished="handleEditor" />
    </div>
</template>

<style scoped>
.top-action-btn-container {
    display: inline;
    margin: 1px;
}
</style>