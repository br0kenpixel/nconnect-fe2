<script setup lang="ts">
definePageMeta({
    layout: 'admin'
});

const conferences = [
    { year: "2024", date: "15.04.2024" }
];
</script>

<template>
    <div class="container">
        <h1>Manažment konferencií</h1>

        <div>
            <div class="top-action-btn-container">
                <v-btn prepend-icon="mdi-plus" base-color="green" @click="newConferenceDialog">
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
                <tr v-for="conference in conferences">
                    <td>{{ conference.year }}</td>
                    <td>{{ conference.date }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline"
                            base-color="red">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil"
                            base-color="orange">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminConferenceEditorDialog ref="conference-editor" />
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

<script lang="ts">
export default {
    methods: {
        newConferenceDialog() {
            (this.$refs['conference-editor'] as any).show();
        }
    }
}
</script>