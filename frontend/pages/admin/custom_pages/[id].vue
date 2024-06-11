<script setup lang="ts">
import type { CustomPage } from '~/types/private';

definePageMeta({
    layout: 'admin'
});
</script>

<template>
    <div class="container">
        <p v-if="pending">
            Načítavam...
        </p>

        <div class="alert alert-danger ma-2" role="alert" v-else-if="error">
            Nepodarilo sa načítať obsah: {{ error }}
        </div>

        <div v-else>
            <v-text-field clearable label="Názov stránky" variant="underlined" ref="titleInput"
                v-model="title"></v-text-field>

            <AdminPageEditor v-model="content" />

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
        </div>
    </div>
</template>

<script lang="ts">
export default {
    data() {
        return {
            title: "",
            content: "",
            pending: true,
            error: null as (any)
        }
    },
    methods: {
        async fetchPageData() {
            try {
                const result = await $fetch<CustomPage>(`${this.$config.public.apiUrl}/custom_pages/${this.$route.params.id}`);
                this.title = result.name;
                this.content = result.content;
            } catch (error: any) {
                this.error = error.statusMessage;
            } finally {
                this.pending = false;
            }
        },
        load_test() {
            console.log("loaded editor");
        }
    },
    mounted() {
        this.fetchPageData();
        //(this.$refs["editor"] as any).setContent("abc");
    }
}
</script>