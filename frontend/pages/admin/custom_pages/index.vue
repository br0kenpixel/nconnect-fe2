<script setup lang="ts">
import type { CustomPageVisibility, SimplifiedCustomPage } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const config = useRuntimeConfig();
const client = useSanctumClient();
const router = useRouter();
const { data, pending, error, refresh } = await useFetch<SimplifiedCustomPage[]>(`${config.public.apiUrl}/custom_pages`, { lazy: true });

async function newPage() {
    try {
        await client(`/api/custom_pages`, {
            method: "PUT",
            body: {
                name: `Stránka ${createRandomString(4)}`,
                content: "Doplňte obsah... :)",
                display: "none" as CustomPageVisibility
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deletePage(id: number) {
    try {
        await client(`/api/custom_pages/${id}`, {
            method: "DELETE"
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function startEditor(page_id: number) {
    router.push(`/admin/custom_pages/${page_id}`);
}

function createRandomString(length: number): string {
    const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let result = "";
    for (let i = 0; i < length; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
}

</script>

<template>
    <div class="container">
        <h1>Moje stránky</h1>

        <AdminBasicOps :adder="newPage" :eraser="() => { }" :refresher="refresh" />

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
                        Zobrazené
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="page in data">
                    <td>{{ page.name }}</td>
                    <td>{{ page.display === "none" ? "-" : (page.display === "navigation" ? "Nav. panel" : "Dolná nav.")
                        }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline" base-color="red"
                            @click="async () => deletePage(page.id)">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="startEditor(page.id)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>
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