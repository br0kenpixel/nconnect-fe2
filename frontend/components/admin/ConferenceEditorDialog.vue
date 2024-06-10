<script setup lang="ts">
import { VDateInput } from 'vuetify/labs/VDateInput';

const current_year = new Date().getFullYear();
</script>

<template>
    <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-cash" title="Editor konferencie">
            <v-card-text>
                <v-alert v-show="error" text="Prosím vyplňte všetky údaje." title="Chyba" type="error"></v-alert>

                <br />

                <v-row dense>
                    <v-col>
                        <v-select label="Ročník" clearable variant="underlined"
                            :items="[current_year, current_year + 1]" v-model="year"></v-select>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-date-input clearable label="Deň konania" variant="underlined" v-model="date"></v-date-input>
                        <small v-show="weekendWarning">Pozor: Vybraný dátum je víkend.</small>
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

<style scoped>
small {
    color: orange;
}
</style>

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
                year: "",
                weekendWarning: false,
                date: null as (null | Date),
            };
        },
        resetData() {
            Object.assign(this.$data, this.$options.data.apply(this));
        },
        canFinish() {
            return this.year.length > 0 &&
                this.date !== null;
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
        },
        date(newDate: Date, _) {
            this.weekendWarning = newDate.getDay() % 6;
        }
    }
}
</script>