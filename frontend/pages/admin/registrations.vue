<script setup lang="ts">
import type { AttendeeRegistration } from '~/types/private';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const config = useRuntimeConfig();
const client = useSanctumClient();
const registrations = ref([] as AttendeeRegistration[]);

async function refresh() {
    registrations.value = await client("/api/registrations/all");
}

await refresh();

function newRegistration() {
    const router = useRouter();
    const link = router.resolve({ name: "registration-new" });

    window.open(link.href, '_blank');
}

function editRegistration(id: number) {
    const router = useRouter();
    const link = router.resolve({ name: "registration-id", params: { id: id } });

    window.open(link.href, '_blank');
}
</script>

<template>
    <div class="container">
        <h1>Manažment registrácií</h1>

        <AdminBasicOps :adder="newRegistration" :refresher="refresh" />

        <v-table>
            <thead>
                <tr>
                    <th class="text-left">
                        Meno
                    </th>
                    <th class="text-left">
                        Počet prednášok
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="registration in registrations">
                    <td>{{ registration.attendee.name }}</td>
                    <td>{{ registration.registrations.length }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil" base-color="orange"
                            @click="() => editRegistration(registration.attendee.id)">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>
    </div>
</template>