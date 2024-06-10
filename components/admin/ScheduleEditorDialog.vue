<script setup lang="ts">
import { VTimePicker } from 'vuetify/labs/VTimePicker';
</script>

<template>
    <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-cash" title="Editor prednášky">
            <v-card-text>
                <v-alert v-show="error" text="Prosím vyplňte všetky údaje." title="Chyba" type="error"></v-alert>

                <br />

                <v-row dense>
                    <v-col>
                        <v-text-field label="Názov prednášky" v-model="title" clearable required></v-text-field>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-textarea label="Popis" v-model="description" clearable required></v-textarea>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <AdminTimePicker title="Čas od" v-model="from" />
                    </v-col>
                    <v-col>
                        <AdminTimePicker title="Čas do" v-model="to" />
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <small>Speaker (ak udalosť nie je pauza):</small>
                        <v-autocomplete label="Speaker"
                            :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']"
                            v-model="speaker"></v-autocomplete>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-autocomplete label="Stage"
                            :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']"
                            v-model="stage"></v-autocomplete>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-select label="Ročník"
                            :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']"
                            v-model="year"></v-select>
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
                title: "",
                description: "",
                from: "",
                to: "",
                stage: "",
                year: "",
                speaker: null,
                menu2: false,
            };
        },
        resetData() {
            Object.assign(this.$data, this.$options.data.apply(this));
        },
        canFinish() {
            return this.title.length > 0 &&
                this.description.length > 0 &&
                this.from.length === 5 &&
                this.to.length === 5 &&
                this.stage.length > 0
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