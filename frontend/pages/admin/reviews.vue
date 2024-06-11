<script setup lang="ts">
import type { Review } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const dialog = ref(null as any);
const config = useRuntimeConfig();
const client = useSanctumClient();
const { data, pending, error, refresh } = await useFetch<Review[]>(`${config.public.apiUrl}/reviews`, { lazy: true });

function newReviewDialog() {
    dialog.value!.show();
}

async function handleEditor(result: { id: null | number, name: string, opinion: string, position: string, image: string | null }) {
    if (result.id === null) {
        await createNewReview(result.name, result.image!, result.position, result.opinion);
    } else {
        await updateReview(result.id, result.name, result.image, result.position, result.opinion);
    }
}

async function createNewReview(name: string, image: string | null, position: string, opinion: string) {
    try {
        await client(`/api/reviews`, {
            method: "PUT",
            body: {
                name: name,
                image: image,
                position: position,
                opinion: opinion
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function updateReview(id: number, name: string, image: string | null, position: string, opinion: string) {
    try {
        await client(`/api/reviews/${id}`, {
            method: "POST",
            body: {
                name: name,
                image: image,
                position: position,
                opinion: opinion
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deleteReview(id: number) {
    try {
        await client(`/api/reviews/${id}`, {
            method: "DELETE"
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function editReview(review: Review) {
    dialog.value!.show(review);
}
</script>

<template>
    <div class="container">
        <h1>Manažment recenzií</h1>

        <AdminBasicOps :adder="newReviewDialog" :eraser="() => { }" :refresher="refresh" />

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
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="review in data">
                    <td>{{ review.name }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline" base-color="red"
                            @click="async () => deleteReview(review.id)">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="() => editReview(review)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminReviewEditorDialog ref="dialog" @finished="handleEditor" />
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