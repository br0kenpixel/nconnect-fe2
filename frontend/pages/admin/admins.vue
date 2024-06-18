<script setup lang="ts">
import type { AdminDialog, Administrator } from '~/types/private';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const dialog = ref(null as any);
const client = useSanctumClient();
const admins = ref([] as Administrator[]);

async function refresh() {
    admins.value = await client("/api/admins");
}

await refresh();

function newAdminDialog() {
    dialog.value!.show();
}

async function handleEditor(result: AdminDialog) {
    if (result.id === null) {
        await createNewAdmin(result.name, result.email, result.password!);
    } else {
        await updateAdmin(result.id!, result.name, result.email, result.password);
    }
}

async function createNewAdmin(name: string, email: string, password: string) {
    try {
        await client(`/api/admins`, {
            method: "PUT",
            body: {
                name: name,
                email: email,
                password: password
            }
        });

        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function updateAdmin(id: number, name: string, email: string, password: string | null) {
    try {
        await client(`/api/admins/${id}`, {
            method: "POST",
            body: {
                name: name,
                email: email,
                password: password
            }
        });

        await refresh();
    } catch (e) {
        console.error(e);
    }
}

async function deleteAdmin(id: number) {
    if (id === 1) {
        alert("Tohto používateľa nie je možné zmazať!");
        return;
    }

    try {
        await client(`/api/admins/${id}`, {
            method: "DELETE"
        });

        await refresh();
    } catch (e) {
        console.error(e);
    }
}

function editAdmin(admin: Administrator) {
    dialog.value!.show(admin);
}
</script>

<template>
    <div class="container">
        <h1>Manažment administrátorov</h1>
        <AdminBasicOps :adder="newAdminDialog" :eraser="() => { }" :refresher="refresh" />

        <v-table>
            <thead>
                <tr>
                    <th class="text-left">
                        Meno
                    </th>
                    <th class="text-left">
                        E-mail
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="admin in admins">
                    <td>{{ admin.name }}</td>
                    <td>{{ admin.email }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline" base-color="red"
                            @click="async () => deleteAdmin(admin.id)">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="() => editAdmin(admin)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminEditorDialog ref="dialog" @finished="handleEditor" />
    </div>
</template>