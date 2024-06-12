<script setup lang="ts">
import { VNumberInput } from 'vuetify/labs/VNumberInput'

const config = useRuntimeConfig();
const { data: stage_data, pending: stage_pending } = await useFetch<Stage[]>(`${config.public.apiUrl}/stages`, { lazy: true });
const { data: speaker_data, pending: speaker_pending } = await useFetch<Speaker[]>(`${config.public.apiUrl}/speakers`, { lazy: true });
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
                        <v-number-input :reverse="false" controlVariant="split" label="Počet miest" :hideInput="false"
                            :inset="false" :min="1" v-model="seats"></v-number-input>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <small>Speaker (ak udalosť nie je pauza):</small>
                        <p v-if="speaker_pending">Načítavam...</p>
                        <v-autocomplete v-else label="Speaker" :items="speaker_data" item-title="name" v-model="speaker"
                            return-object></v-autocomplete>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <p v-if="stage_pending">Načítavam...</p>
                        <v-autocomplete v-else label="Stage" :items="stage_data"
                            :item-title="(item: Stage) => item.name + ' (' + item.conference.year + ')'" return-object
                            v-model="stage"></v-autocomplete>
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
import type { Stage } from '~/types/private';
import type { Schedule, Speaker } from '~/types/public';

export default {
    expose: ['show'],
    emits: ['finished'],

    data() {
        return this.initialData();
    },

    methods: {
        initialData() {
            return {
                dialog: false,
                error: false,
                editing_id: null as (number | null),
                title: "",
                description: "",
                from: "",
                to: "",
                stage: null as (Stage | null),
                speaker: null as (Speaker | null),
                seats: 0,
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
                this.stage !== null &&
                this.seats > 0;
        },
        show(prefill_sched?: Schedule, prefill_stage?: Stage) {
            this.dialog = true;

            if (prefill_sched !== undefined && prefill_stage !== undefined) {
                this.editing_id = prefill_sched.id;
                this.title = prefill_sched.title;
                this.description = prefill_sched.description;
                this.from = prefill_sched.start;
                this.to = prefill_sched.end;
                this.stage = prefill_stage;
                this.speaker = prefill_sched.speaker;
                this.seats = prefill_sched.seats;
            }
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

            this.$emit("finished", {
                id: this.editing_id,
                title: this.title,
                description: this.description,
                start: this.from,
                end: this.to,
                stage: this.stage,
                speaker: this.speaker,
                seats: this.seats
            });
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