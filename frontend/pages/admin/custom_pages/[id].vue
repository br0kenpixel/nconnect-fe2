<script setup lang="ts">
definePageMeta({
    layout: 'admin'
});
</script>

<template>
    <div class="container">
        <v-text-field clearable label="Názov stránky" variant="underlined"></v-text-field>

        <ClientOnly placeholder="Please wait, loading...">
            <AdminPageEditor />

            <div>
                <v-checkbox label="Zobraziť stránku v navigácii"></v-checkbox>

                <v-row no-gutters>
                    <v-col class="pa-2 ma-2">
                        <v-btn prepend-icon="mdi-floppy" base-color="green">
                            Uložiť
                        </v-btn>
                    </v-col>
                </v-row>
            </div>
        </ClientOnly>
    </div>
</template>