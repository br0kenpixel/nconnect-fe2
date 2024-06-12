<script setup lang="ts">
import type { FullSchedule, SimplifiedStage } from '~/types/public';

const config = useRuntimeConfig();

const { data, pending, error } = await useFetch<FullSchedule[]>(`${config.public.apiUrl}/schedule`, { lazy: true });
</script>

<template>
    <div id="schedule-area-root">
        <div class="container" id="schedule-area">
            <h5>🗓 Schedule</h5>

            <hr>

            <div class="container" v-if="pending">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-2">
                        <span>Select stage:</span>
                    </div>
                    <div class="col-sm">
                        <select class="form-select" disabled>
                            <option :value="null" selected>Loading</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="alert alert-danger" role="alert" v-else-if="error">
                Nepodarilo sa načítať obsah.
            </div>

            <div class="container" v-else>
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-2">
                        <span>Select stage:</span>
                    </div>
                    <div class="col-sm">
                        <select class="form-select" v-model="selected_stage">
                            <option :value="null" selected>Select stage</option>
                            <template v-for="conference in data">
                                <option v-for="(entry, index) in conference.stages" :value="entry">{{ entry.name }} ({{
                                    conference.date }})
                                </option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>

            <br>

            <!-- Accordion -->

            <div class="accordion accordion-flush" id="accordionFlush" v-if="selected_stage !== null">
                <div class="accordion-item" v-for="(time_window, index) in selected_stage.schedule">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            :data-bs-target="`#flush-collapse-${index}`" aria-expanded="false"
                            :aria-controls="`flush-collapse-${index}`">
                            {{ time_window.start }} - {{ time_window.end }} | {{ time_window.title }}
                        </button>
                    </h2>
                    <div :id="`flush-collapse-${index}`" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlush">
                        <div class="accordion-body">
                            <p>{{ time_window.description }}</p>
                            <div v-if="time_window.speaker">
                                <ScheduleInfo :speaker="time_window.speaker!.name" :image="time_window.speaker!.image"
                                    :employer="time_window.speaker!.company" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
#schedule-area {
    padding-top: 50px;
    padding-bottom: 50px;
    width: 85%;
}

#schedule-area-root {
    background: #f0f3f5;
}

h5 {
    color: #004953;
    text-transform: uppercase;
    font-weight: bold;
}
</style>

<script lang="ts">
export default {
    data() {
        return {
            selected_stage: null as (SimplifiedStage | null)
        }
    }
}
</script>