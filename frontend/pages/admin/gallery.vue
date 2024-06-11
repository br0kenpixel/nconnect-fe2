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

        <AdminBasicOps :adder="newGalleryDialog" :eraser="() => { }" :refresher="() => { }" />

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