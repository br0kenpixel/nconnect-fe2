<script setup lang="ts">
import type { FullSchedule, RegistrationForm } from '~/types/public';

const config = useRuntimeConfig();
const { data } = await useFetch<FullSchedule>(`${config.public.apiUrl}/registrations/schedule`);

/*const registration = {
    id: 0,
    year: 2024,
    date: "12.04.2024",
    stages: [
        {
            id: 1,
            name: "DATA & AI",
            schedule: [
                {
                    id: 1,
                    title: "Python data collection",
                    description: "Collecting data with python",
                    start: "12:00",
                    end: "13:00",
                    speaker: {
                        id: 0,
                        name: "Adam",
                        image: "/",
                        company: "Microsoft",
                        description: "...",
                        headliner: false
                    },
                    seats: 12,
                },
                {
                    id: 2,
                    title: "Rust data collection",
                    description: "Collecting data with rust",
                    start: "13:00",
                    end: "14:00",
                    speaker: {
                        id: 0,
                        name: "Adam",
                        image: "/",
                        company: "Microsoft",
                        description: "...",
                        headliner: false
                    },
                    seats: 12,
                },
            ],
        },
    ]
} as FullSchedule;*/
</script>

<template>
    <v-app>
        <v-sheet class="pa-14" rounded>
            <h3 class="text-center">Nová registrácia</h3>

            <br>

            <v-card class="mx-auto px-6 py-8" max-width="800">
                <div class="text-center" v-show="processing">
                    <v-progress-circular :size="30" color="primary" indeterminate></v-progress-circular>
                    <p>Spracovávam požiadavku...</p>
                </div>

                <div class="alert alert-danger" role="alert" v-if="error">
                    {{ error }}
                </div>

                <RegistrationEditor v-if="!processing" :schedule="data!" @finished="handleForm" />
            </v-card>
        </v-sheet>
    </v-app>
</template>

<script lang="ts">
export default {
    data() {
        return {
            error: null as (string | null),
            processing: false,
        };
    },
    methods: {
        handleForm(data: RegistrationForm) {
            this.error = null;
            this.processing = true;

            this.processing = false;
        }
    }
}
</script>