<script setup lang="ts">
definePageMeta({
    layout: 'admin'
});

const gallery_contents = [
    { year: "2020" }
];
</script>

<template>
    <div class="container">
        <h1>Galéria</h1>

        <div>
            <div class="top-action-btn-container">
                <v-btn prepend-icon="mdi-plus" base-color="green" @click="newGalleryDialog">
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
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="entry in gallery_contents">
                    <td>{{ entry.year }}</td>
                    <td class="text-right">
                        <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline"
                            base-color="red">Zmazať</v-btn>
                        <v-btn class="m-1" density="compact" append-icon="mdi-pencil"
                            base-color="orange">Editovať</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>

        <AdminGalleryEditorDialog ref="gallery-editor" />
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
        newGalleryDialog() {
            (this.$refs['gallery-editor'] as any).show();
        }
    }
}
</script>