<script setup lang="ts">
const schedule = [
    {
        stage: "DATA & AI",
        when: "12.03.2020",
        schedule: [
            {
                from: "09:00",
                to: "10:00",
                title: "Event preparation",
                description: "Preparing fot the event",
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
                description: "Driking coffee...",
                speaker: null,
            }
        ]
    },
    {
        stage: "PENTESTING",
        when: "12.03.2020",
        schedule: [
            {
                from: "09:00",
                to: "10:00",
                title: "Event preparation",
                description: "Preparing fot the event",
                guests: null
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
            }
        ]
    },
];
</script>

<template>
    <div id="scedule-area-root">
        <div class="container" id="schedule-area">
            <h5>🗓 Schedule</h5>

            <hr>

            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-2">
                        <span>Select stage:</span>
                    </div>
                    <div class="col-sm">
                        <select class="form-select" v-model="selected_stage">
                            <option :value="null" selected>Select stage</option>
                            <option v-for="(entry, index) in schedule" :value="index">{{ entry.stage }} ({{
                                entry.when }})
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <br>

            <!-- Accordion -->

            <div class="accordion accordion-flush" id="accordionFlush" v-if="selected_stage !== null">
                <div class="accordion-item" v-for="(time_window, index) in schedule[selected_stage].schedule">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            :data-bs-target="`#flush-collapse-${index}`" aria-expanded="false"
                            :aria-controls="`flush-collapse-${index}`">
                            {{ time_window.from }} - {{ time_window.to }} | {{ time_window.title }}
                        </button>
                    </h2>
                    <div :id="`flush-collapse-${index}`" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlush">
                        <div class="accordion-body">
                            <p>{{ time_window.description }}</p>
                            <div v-if="time_window.speaker">
                                <ScheduleInfo :speaker="time_window.speaker!.name" :image="time_window.speaker!.image"
                                    :employer="time_window.speaker!.employer" />
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

#scedule-area-root {
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
            selected_stage: null as (number | null)
        }
    }
}
</script>