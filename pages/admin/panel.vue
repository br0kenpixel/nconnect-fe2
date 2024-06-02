<script setup lang="ts">
definePageMeta({
    layout: 'admin'
});

const date = new Date();
</script>

<template>
    <div class="container">
        <h1>Vitajte, user!</h1>

        <br>

        <p>Dnes je {{ date.getDay() }}.{{ date.getMonth() }}.{{ date.getFullYear() }}.</p>

        <h3>Štatistiky</h3>
        <v-table>
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
                <tr v-for="item in stats_table" :key="item.name">
                    <td>{{ item.name }}</td>
                    <td>{{ item.amount }}</td>
                </tr>
            </tbody>
        </v-table>
    </div>
</template>

<script lang="ts">
export default {
    data() {
        return {
            stats_table: [
                {
                    name: 'Počet konferencií',
                    amount: 159,
                },
                {
                    name: 'Celkový počet účastníkov',
                    amount: 237,
                },
                {
                    name: "Celkový počet stageov",
                    amount: 90,
                },
                {
                    name: "Najbližšia konferencia",
                    amount: "-"
                },
                {
                    name: "Posledná registrácia",
                    amount: "-"
                },

            ],
        }
    },
}
</script>