<script setup lang="ts">
import type { Stats } from '~/types/public';

definePageMeta({
    layout: 'admin'
});

const date = new Date();
const config = useRuntimeConfig();
const { data, pending, error } = await useFetch<Stats>(`${config.public.apiUrl}/stats`, { lazy: true });
</script>

<template>
    <div class="container">
        <h1>Vitajte, user!</h1>

        <br>

        <p>Dnes je {{ date.getDay() }}.{{ date.getMonth() }}.{{ date.getFullYear() }}.</p>

        <h3>Štatistiky</h3>

        <p v-if="pending">
            Načítavam...
        </p>

        <div class="alert alert-danger" role="alert" v-else-if="error">
            Nepodarilo sa načítať obsah.
        </div>

        <v-table v-else>
            <thead>
                <tr>
                    <th class="text-left">
                        Názov
                    </th>
                    <th class="text-left">
                        Hodnota
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Počet konferencií</td>
                    <td>{{ data!.conferences }}</td>
                </tr>
                <tr>
                    <td>Celkový počet účastníkov</td>
                    <td>{{ data!.attendees }}</td>
                </tr>
                <tr>
                    <td>Celkový počet stageov</td>
                    <td>{{ data!.stages }}</td>
                </tr>
                <tr>
                    <td>Najbližšia konferencia</td>
                    <td>{{ data!.next_conference }}</td>
                </tr>
                <tr>
                    <td>Posledná registrácia</td>
                    <td>{{ data!.last_registration }}</td>
                </tr>
            </tbody>
        </v-table>
    </div>
</template>