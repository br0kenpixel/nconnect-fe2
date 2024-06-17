<script setup lang="ts">
import type { PropType } from 'vue';
import type { FullSchedule, RegistrationForm, RegistrationSelection, Schedule, SimplifiedStage } from '~/types/public';
</script>

<template>
    <div>
        <v-text-field label="E-mail" variant="underlined" type="email" v-model="email" required></v-text-field>
        <v-text-field label="Meno" variant="underlined" type="text" v-model="name" required></v-text-field>

        <v-table height="300px" fixed-header>
            <thead>
                <tr>
                    <th class="text-left">
                        Čas
                    </th>
                    <th class="text-left">
                        Prednáška
                    </th>
                    <th class="text-right">
                        Operácia
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="entry in selection">
                    <td>{{ entry.presentation.start }} - {{ entry.presentation.end }}</td>
                    <td>{{ entry.presentation.title }}</td>
                    <td></td>
                </tr>
            </tbody>
        </v-table>

        <hr>

        <p>Pridať ďalšiu prednášku</p>
        <v-autocomplete clearable label="Stage" :items="availableSchedule.stages" item-title="name" return-object
            v-model="stage"></v-autocomplete>
        <v-autocomplete clearable label="Prednáška" :items="schedules" v-model="selectedSchedule"
            :item-title="item => `${item.start} - ${item.end}: ${item.title}`" return-object></v-autocomplete>
        <v-btn prepend-icon="mdi-plus" color="blue" @click="add">Pridať</v-btn>
        <br />
        <br />
        <v-btn prepend-icon="mdi-floppy" color="green" @click="send">Uložiť a odoslať</v-btn>
    </div>
</template>

<script lang="ts">
export default {
    props: {
        schedule: {
            type: Object as PropType<FullSchedule>,
            required: true
        },
        fill_email: {
            type: String,
            required: false,
            default: ""
        },
        fill_name: {
            type: String,
            required: false,
            default: ""
        },
        id: {
            type: Object as PropType<number | null>,
            required: false,
            default: null
        }
    },
    emits: ["finished"],
    data() {
        return {
            availableSchedule: this.schedule,
            stage: null as (SimplifiedStage | null),
            selectedSchedule: null as (Schedule | null),
            email: this.fill_email,
            name: this.fill_name,
            schedules: [] as Schedule[],
            selection: [] as (RegistrationSelection[]),
        };
    },
    watch: {
        stage(newStage, _) {
            if (newStage === null) {
                this.schedules = [];
                return;
            }

            let schedule = this.availableSchedule.stages.find((entry) => entry.name == newStage.name)!.schedule;

            this.schedules = schedule;
        }
    },
    methods: {
        add() {
            if (this.stage === null || this.selectedSchedule === null) {
                return;
            }

            let selection = {
                stage: this.stage,
                presentation: this.selectedSchedule,
            };
            this.selection.push(selection);

            this.stage = null;
            this.selectedSchedule = null;
            this.updateSelection();
        },
        updateSelection() {
            let result: FullSchedule = structuredClone(toRaw(this.schedule));

            result.stages.forEach(stage => {
                stage.schedule = stage.schedule.filter(sched => {
                    let found = this.selection.find(e => {
                        return e.presentation.id === sched.id;
                    }) !== undefined;

                    return !found;
                });
            });

            result.stages = result.stages.filter(stage => stage.schedule.length > 0);
            this.availableSchedule = result;
        },
        send() {
            this.$emit("finished", {
                id: this.id,
                email: this.email,
                name: this.name,
                selection: this.selection.map(entry => entry.presentation.id),
            } as RegistrationForm);
        }
    }
}
</script>