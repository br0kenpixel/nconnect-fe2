<script setup lang="ts">
import type { Speaker } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const config = useRuntimeConfig();
const dialog = ref(null as any);
const client = useSanctumClient();
const { data, pending, error, refresh } = await useFetch<Speaker[]>(`${config.public.apiUrl}/speakers`, { lazy: true });

function newSpeakerDialog() {
    dialog.value!.show();
}

async function handleEditor(result: { id: null | number, name: string, image: string | null, employer: string, description: string, headliner: boolean }) {
    if (result.id === null) {
        await createNewSpeaker(result.name, result.image!, result.employer, result.description, result.headliner);
    } else {
        console.log(result);
        await updateSpeaker(result.id, result.name, result.image, result.employer, result.description, result.headliner);
    }
}

async function createNewSpeaker(name: string, image: string, employer: string, description: string, headliner: boolean) {
    try {
        await client(`/api/speakers`, {
            method: "PUT",
            body: {
                name: name,
                image: image,
                company: employer,
                description: description,
                headliner: headliner,
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function updateSpeaker(id: number, name: string, image: string | null, employer: string, description: string, headliner: boolean) {
    console.log({
        name: name,
        company: employer,
        description: description,
        image: image,
        headliner: headliner,
    });

    try {
        await client(`/api/speakers/${id}`, {
            method: "POST",
            body: {
                name: name,
                company: employer,
                description: description,
                image: image,
                headliner: headliner,
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deleteSpeaker(id: number) {
    try {
        await client(`/api/speakers/${id}`, {
            method: "DELETE"
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function editSpeaker(speaker: Speaker) {
    dialog.value!.show(speaker);
}
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
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline" base-color="red"
                            @click="async () => deleteSpeaker(speaker.id)">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="() => editSpeaker(speaker)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminSpeakerEditorDialog ref="dialog" @finished="handleEditor" />
    </div>
</template>

<style scoped>
.top-action-btn-container {
    display: inline;
    margin: 1px;
}
</style>