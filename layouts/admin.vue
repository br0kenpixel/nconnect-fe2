<template>
    <v-card>
        <v-layout>
            <v-app-bar color="primary" prominent>
                <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

                <v-toolbar-title>nConnect Administrácia</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-btn icon="mdi-dots-vertical" variant="text"></v-btn>
            </v-app-bar>

            <client-only>
                <v-navigation-drawer v-model="drawer" :location="$vuetify.display.mobile ? 'bottom' : undefined"
                    temporary>
                    <v-list :items="items"></v-list>
                </v-navigation-drawer>
            </client-only>

            <v-main style="height: 100%;" id="main-app-container">
                <v-card-text>
                    <slot />
                </v-card-text>
            </v-main>
        </v-layout>
    </v-card>
</template>

<script lang="ts">
export default {
    data: () => ({
        drawer: false,
        group: null,
        items: [
            {
                title: 'Foo',
                value: 'foo',
            },
            {
                title: 'Bar',
                value: 'bar',
            },
            {
                title: 'Fizz',
                value: 'fizz',
            },
            {
                title: 'Buzz',
                value: 'buzz',
            },
        ],
    }),

    watch: {
        group() {
            this.drawer = false;
        },
    }
}
</script>