<script setup lang="ts">
definePageMeta({
    layout: 'admin'
});

const schedules = [
    {
        conference_year: "2024",
        stage: "DATA & AI",
        date: "22.05.2024",
        schedule: [
            {
                from: "09:00",
                to: "10:00",
                title: "Event preparation",
                description: "Preparing for the event",
                speaker: null
            },
            {
                from: "10:15",
                to: "12:00",
                title: "Data collection using Python",
                description: "Collecting user data with Python",
                speaker: {
                    name: "John Doe",
                    image: "/",
                    employer: "IBM"
                }
            },
            {
                from: "12:05",
                to: "12:30",
                title: "Coffee break",
                description: "Drinking coffee...",
                speaker: null,
            }
        ],
    }
];
</script>

<template>
    <div class="container">
        <h1>Manažment prednášok</h1>

        <div>
            <div class="top-action-btn-container">
                <v-btn prepend-icon="mdi-plus" base-color="green" @click="newScheduleDialog">
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
                        Názov
                    </th>
                    <th class="text-left">
                        Čas
                    </th>
                    <th class="text-left">
                        Speaker
                    </th>
                    <th class="text-left">
                        Stage
                    </th>
                    <th class="text-left">
                        Kedy
                    </th>
                    <th class="text-left">
                        Ročník
                    </th>
                    <th class="text-right">
                        Op.
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="schedule in schedules">
                    <tr v-for="entry in schedule.schedule">
                        <td>{{ entry.title }}</td>
                        <td>{{ entry.from }} - {{ entry.to }}</td>
                        <td>{{ entry.speaker === null ? "-" : entry.speaker.name }}</td>
                        <td>{{ schedule.stage }}</td>
                        <td>{{ schedule.date }}</td>
                        <td>{{ schedule.conference_year }}</td>
                        <td class="text-right">
                            <v-btn class="m-1" density="compact" append-icon="mdi-trash-can-outline"
                                base-color="red">Zmazať</v-btn>
                            <v-btn class="m-1" density="compact" append-icon="mdi-pencil"
                                base-color="orange">Editovať</v-btn>
                        </td>
                    </tr>
                </template>
            </tbody>
        </v-table>

        <AdminScheduleEditorDialog ref="schedule-editor" />
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
        newScheduleDialog() {
            (this.$refs['schedule-editor'] as any).show();
        }
    }
}
</script>