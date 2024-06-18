<script setup lang="ts">
import type { Contact } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const dialog = ref(null as any);
const config = useRuntimeConfig();
const client = useSanctumClient();
const { data, pending, error, refresh } = await useFetch<Contact[]>(`${config.public.apiUrl}/contacts`, { lazy: true });

function newContactDialog() {
    dialog.value!.show();
}

async function handleEditor(result: { id: null | number, name: string, phone: string, email: string, image: string | null }) {
    if (result.id === null) {
        await createNewContact(result.name, result.phone, result.email, result.image!);
    } else {
        await updateContact(result.id, result.name, result.phone, result.email, result.image);
    }
}

async function createNewContact(name: string, phone: string, email: string, image: string) {
    try {
        await client(`/api/contacts`, {
            method: "PUT",
            body: {
                name: name,
                phone: phone,
                email: email,
                image: image
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function updateContact(id: number, name: string, phone: string, email: string, image: string | null) {
    try {
        await client(`/api/contacts/${id}`, {
            method: "POST",
            body: {
                name: name,
                phone: phone,
                email: email,
                image: image
            }
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deleteContact(id: number) {
    try {
        await client(`/api/contacts/${id}`, {
            method: "DELETE"
        });
        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function editContact(contact: Contact) {
    dialog.value!.show(contact);
}
</script>

<template>
    <div class="container">
        <h1>Manažment kontaktov</h1>

        <AdminBasicOps :adder="newContactDialog" :refresher="refresh" />

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
                <tr v-for="contact in data">
                    <td>{{ contact.name }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline" base-color="red"
                            @click="async () => deleteContact(contact.id)">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="() => editContact(contact)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminContactEditorDialog ref="dialog" @finished="handleEditor" />
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