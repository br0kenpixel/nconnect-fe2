<script setup lang="ts">
import type { CustomPage } from '~/types/private';
import type { CustomPageVisibility } from '~/types/public';

definePageMeta({
    layout: 'admin',
    middleware: ['sanctum:auth']
});

const visibilities: { display: string, value: CustomPageVisibility }[] = [
    { display: "Skryté (prístup možný iba cez link)", value: "none" },
    { display: "Navigačný panel", value: "navigation" },
    { display: "Dolný navigačný panel", value: "bottom" },
];
const config = useRuntimeConfig();
</script>

<template>
    <div class="container">
        <p v-if="pending">
            Načítavam...
        </p>

        <div class="alert alert-danger ma-2" role="alert" v-else-if="error">
            Chyba pri spracovaní požiadavky: {{ error }}
        </div>

        <div v-else>
            <v-text-field clearable label="Názov stránky" variant="underlined" ref="titleInput"
                v-model="title"></v-text-field>

            <AdminPageEditor v-model="content" />

            <div>
                <v-select label="Viditeľnosť" :items="visibilities" item-title="display" item-value="value"
                    variant="underlined" v-model="visibility"></v-select>

                <v-row no-gutters>
                    <v-col class="pa-2 ma-2">
                        <v-btn prepend-icon="mdi-floppy" base-color="green" @click="savePage">
                            Uložiť
                        </v-btn>
                    </v-col>
                </v-row>
                <v-row no-gutters>
                    <v-col class="pa-2 ma-2">
                        <v-btn prepend-icon="mdi-link-box" base-color="blue" @click="copyLink">
                            Skopírovať link
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
            visibility: "none" as CustomPageVisibility,
            pending: true,
            error: null as (any),
            client: useSanctumClient()
        }
    },
    methods: {
        async fetchPageData() {
            try {
                const result = await $fetch<CustomPage>(`${this.$config.public.apiUrl}/custom_pages/${this.$route.params.id}`);
                this.title = result.name;
                this.content = result.content;
                this.visibility = result.display;
            } catch (error: any) {
                this.error = error.statusMessage;
            } finally {
                this.pending = false;
            }
        },
        async savePage() {
            try {
                await this.client(`/api/custom_pages/${this.$route.params.id}`, {
                    method: "POST",
                    body: {
                        name: this.title,
                        content: this.content,
                        display: this.visibility
                    }
                });

                this.$router.push("/admin/custom_pages");
            } catch (e) {
                console.error(e);
            }
        },
        async copyLink() {
            await navigator.clipboard.writeText(this.getPath());
        },
        getPath() {
            return location.origin + this.$router.resolve({ name: "custom_page-id", params: { id: this.$route.params.id } }).href;
        }
    },
    mounted() {
        this.fetchPageData();
    }
}
</script>