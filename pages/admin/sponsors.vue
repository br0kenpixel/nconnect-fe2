<script setup lang="ts">
definePageMeta({
    layout: 'admin'
});

const sponsors = [
    { id: 0, name: "IBM", image: "..." },
    { id: 1, name: "Microsoft", image: "..." },
    { id: 2, name: "Google", image: "..." },
    { id: 3, name: "Meta", image: "..." },
];
</script>

<template>
    <div class="container">
        <h1>Manažment partnerov</h1>

        <div>
            <div class="top-action-btn-container">
                <v-btn prepend-icon="mdi-plus" base-color="green" @click="newSponsorDialog">
                    Pridať
                </v-btn>
            </div>

            <div class="top-action-btn-container">
                <v-btn prepend-icon="mdi-eraser" base-color="red">
                    Zmazať všetky
                </v-btn>
            </div>
        </div>

        <v-table>
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
                <tr v-for="sponsor in sponsors">
                    <td>{{ sponsor.name }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline"
                            base-color="red">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil"
                            base-color="orange">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminSponsorEditorDialog ref="sponsor-editor" />
    </div>
</template>

<style scoped>
.top-action-btn-container {
    display: inline;
    margin: 1px;
}

.modal-backdrop {
    z-index: 0 !important;
}

.modal-dialog {
    z-index: 1 !important;
}
</style>

<script lang="ts">
export default {
    methods: {
        newSponsorDialog() {
            (this.$refs['sponsor-editor'] as any).show();
        }
    }
}
</script>