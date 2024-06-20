<script setup lang="ts">
import type { Conference } from '~/types/private';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const dialog = ref(null as any);
const config = useRuntimeConfig();
const client = useSanctumClient();
const { data, pending, error, refresh } = await useFetch<Conference[]>(`${config.public.apiUrl}/conferences`, { lazy: true });

function newConferenceDialog() {
    dialog.value!.show();
}

async function handleEditor(result: { id: null | number, date: Date }) {
    if (result.id === null) {
        await createNewConference(result.date);
    } else {
        await updateConference(result.id, result.date);
    }
}

async function createNewConference(date: Date) {
    const date_str = `${date.getFullYear()}-${date.getMonth().toString().padStart(2, "0")}-${date.getDate().toString().padStart(2, "0")}`;

    try {
        await client(`/api/conferences`, {
            method: "PUT",
            body: {
                year: date.getFullYear(),
                date: date_str
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function updateConference(id: number, date: Date) {
    const date_str = `${date.getFullYear()}-${date.getMonth().toString().padStart(2, "0")}-${date.getDate().toString().padStart(2, "0")}`;

    try {
        await client(`/api/conferences/${id}`, {
            method: "POST",
            body: {
                year: date.getFullYear(),
                date: date_str
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deleteConference(id: number) {
    try {
        await client(`/api/conferences/${id}`, {
            method: "DELETE"
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function editConference(conference: Conference) {
    dialog.value!.show(conference);
}
</script>

<template>
    <div class="container">
        <h1>Manažment konferencií</h1>

        <AdminBasicOps :adder="newConferenceDialog" :refresher="refresh" />

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
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline" base-color="red"
                            @click="async () => deleteConference(conference.id)">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="() => editConference(conference)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminConferenceEditorDialog ref="dialog" @finished="handleEditor" />
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