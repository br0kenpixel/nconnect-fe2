<script setup lang="ts">
import type { Sponsor } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const config = useRuntimeConfig();
const dialog = ref(null as any);
const client = useSanctumClient();
const { data, pending, error, refresh } = await useFetch<Sponsor[]>(`${config.public.apiUrl}/sponsors`, { lazy: true });

function newSponsorDialog() {
    dialog.value!.show();
}

async function handleEditor(result: { id: null | number, name: string, image: string | null }) {
    if (result.id === null) {
        await createNewSponsor(result.name, result.image!);
    } else {
        await updateSponsor(result.id, result.name, result.image);
    }
}

async function createNewSponsor(name: string, image: string) {
    try {
        await client(`/api/sponsors`, {
            method: "PUT",
            body: {
                name: name,
                image: image,
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function updateSponsor(id: number, name: string, image: string | null) {
    try {
        await client(`/api/sponsors/${id}`, {
            method: "POST",
            body: {
                name: name,
                image: image
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deleteSponsor(id: number) {
    try {
        await client(`/api/sponsors/${id}`, {
            method: "DELETE"
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function editSponsor(sponsor: Sponsor) {
    dialog.value!.show(sponsor);
}
</script>

<template>
    <div class="container">
        <h1>Manažment partnerov</h1>

        <AdminBasicOps :adder="newSponsorDialog" :eraser="() => { }" :refresher="refresh" />

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
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="sponsor in data">
                    <td>{{ sponsor.name }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline" base-color="red"
                            @click="async () => deleteSponsor(sponsor.id)">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="() => editSponsor(sponsor)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminSponsorEditorDialog ref="dialog" @finished="handleEditor" />
    </div>
</template>

<style scoped>
.top-action-btn-container {
    display: inline;
    margin: 1px;
}
</style>