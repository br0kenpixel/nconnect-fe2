<script setup lang="ts">
import type { Conference } from '~/types/private';

const config = useRuntimeConfig();
const { data, pending } = await useFetch<Conference[]>(`${config.public.apiUrl}/conferences`, { lazy: true });
</script>

<template>
    <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-cash" title="Stage editor">
            <v-card-text>
                <v-alert v-show="error" text="Prosím vyplňte všetky údaje." title="Chyba" type="error"></v-alert>

                <br />

                <v-row dense>
                    <v-col>
                        <v-text-field label="Názov" clearable v-model="name"></v-text-field>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <p v-if="pending">Načítavam...</p>
                        <v-select v-else label="Ročník" clearable variant="underlined"
                            :items="(data as Conference[]).map((entry) => entry.year)" v-model="year"></v-select>
                    </v-col>
                </v-row>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn text="Zrušiť" variant="plain" @click="close" append-icon="mdi-cancel"></v-btn>
                <v-btn color="primary" text="Uložiť" variant="tonal" @click="finish"
                    append-icon="mdi-content-save-move"></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script lang="ts">
export default {
    expose: ['show'],

    data() {
        return this.initialData();
    },

    methods: {
        initialData() {
            return {
                dialog: false,
                error: false,
                name: "",
                year: "",
            };
        },
        resetData() {
            Object.assign(this.$data, this.$options.data.apply(this));
        },
        canFinish() {
            return this.year.length > 0 &&
                this.name.length > 0;
        },
        show() {
            this.dialog = true;
        },
        close() {
            this.dialog = false;
            this.resetData();
        },
        finish() {
            if (!this.canFinish()) {
                this.error = true;
                return;
            }

            this.close();
        }
    },

    watch: {
        dialog(newDialog, _) {
            if (!newDialog) this.error = false;
        }
    }
}
</script>