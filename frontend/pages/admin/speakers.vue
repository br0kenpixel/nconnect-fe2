<script setup lang="ts">
definePageMeta({
    layout: 'admin',
});

const speakers = [
    {
        name: "Albert Einstein",
        image: "/",
        company: "Einstein Inc.",
        description: "A mad scientist.",
        headliner: false,
    },
    {
        name: "Albert Einstein",
        image: "/",
        company: "Einstein Inc.",
        description: "A mad scientist.",
        headliner: true,
    },
    {
        name: "Albert Einstein",
        image: "/",
        company: "Einstein Inc.",
        description: "A mad scientist.",
        headliner: false,
    },
];
</script>

<template>
    <div class="container">
        <h1>Manažment speakerov</h1>

        <div>
            <div class="top-action-btn-container">
                <v-btn prepend-icon="mdi-plus" base-color="green" @click="newSpeakerDialog">
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
                        Meno
                    </th>
                    <th class="text-left">
                        Headliner
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="speaker in speakers">
                    <td>{{ speaker.name }}</td>
                    <td>
                        {{ speaker.headliner ? "✅" : "❌" }}
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

        <AdminSpeakerEditorDialog ref="speaker-editor" />
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
        newSpeakerDialog() {
            (this.$refs['speaker-editor'] as any).show();
        }
    }
}
</script>