<script setup lang="ts">
definePageMeta({
    layout: 'admin',
});

const stages = [
    {
        conference_year: "2024",
        name: "AI & DATA"
    },
    {
        conference_year: "2023",
        name: "COLLECTION"
    },
    {
        conference_year: "2024",
        name: "HACKING"
    },
];
</script>

<template>
    <div class="container">
        <h1>Manažment stageov</h1>

        <div>
            <div class="top-action-btn-container">
                <v-btn prepend-icon="mdi-plus" base-color="green" @click="newStageDialog">
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
                    <th class="text-left">
                        Ročník
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="stage in stages">
                    <td>{{ stage.name }}</td>
                    <td>
                        {{ stage.conference_year }}
                    </td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline"
                            base-color="red">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil"
                            base-color="orange">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminStageEditorDialog ref="stage-editor" />
    </div>
</template>

<style scoped>
.top-action-btn-container {
    display: inline;
    margin: 1px;
}
</style>

<script lang="ts">
export default {
    methods: {
        newStageDialog() {
            (this.$refs['stage-editor'] as any).show();
        }
    }
}
</script>