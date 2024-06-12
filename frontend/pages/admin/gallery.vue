<script setup lang="ts">
import type { Conference } from '~/types/private';
import type { Gallery, GalleryImage } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const config = useRuntimeConfig();
const dialog = ref(null as any);
const client = useSanctumClient();
const { data, pending, error, refresh } = await useFetch<Gallery[]>(`${config.public.apiUrl}/gallery`, {
    lazy: true,
    transform(gallery) {
        return gallery.filter((entry) => entry.gallery.length > 0);
    }
});

function newGalleryDialog() {
    dialog.value!.show();
}

async function handleEditor(result: { editing: boolean, conference: Conference, images: string[] }) {
    if (!result.editing) {
        await createNewGallery(result.conference, result.images);
    } else {
        await updateGallery(result.conference, result.images);
    }
}

async function createNewGallery(conference: Conference, images: string[]) {
    try {
        await client(`/api/gallery`, {
            method: "PUT",
            body: {
                conference: conference.id,
                gallery: images
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function updateGallery(conference: Conference, images: string[]) {
    try {
        await client(`/api/gallery`, {
            method: "POST",
            body: {
                conference: conference.id,
                gallery: images
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deleteGallery(conference: Conference) {
    try {
        await client(`/api/gallery/${conference.id}`, {
            method: "DELETE"
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function editGallery(gallery: Gallery[], conference: Conference) {
    dialog.value!.show(gallery.filter((entry) => entry.conference === conference));
}
</script>

<template>
    <div class="container">
        <h1>Galéria</h1>

        <AdminBasicOps :adder="newGalleryDialog" :eraser="() => { }" :refresher="refresh" />

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
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="entry in data">
                    <td>{{ entry.conference.year }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline" base-color="red"
                            @click="async () => await deleteGallery(entry.conference)">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="() => editGallery(data!, entry.conference)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminGalleryEditorDialog ref="dialog" @finished="handleEditor" />
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