<script setup lang="ts">
import { VTimePicker } from 'vuetify/labs/VTimePicker';
</script>

<template>
    <v-text-field v-model="value" :active="menu2" :label="title" prepend-icon="mdi-clock-time-four-outline" readonly>
        <v-menu v-model="menu2" :close-on-content-click="false" activator="parent" transition="scale-transition">
            <v-time-picker v-if="menu2" v-model="value" format="24hr" full-width></v-time-picker>
        </v-menu>
    </v-text-field>
</template>

<script lang="ts">
export default {
    expose: ['time'],

    props: {
        title: {
            type: String,
            required: true,
        },
        prefill: {
            type: String,
            required: false
        },
        modelValue: {
            type: String,
            required: false
        }
    },

    emits: ['update:modelValue'],

    computed: {
        value: {
            get() {
                return this.modelValue;
            },
            set(value: String | null) {
                this.$emit('update:modelValue', value);
            }
        }
    },

    data() {
        return {
            menu2: false,
        }
    }
}
</script>