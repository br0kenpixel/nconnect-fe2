<template>
    <div>
        <v-card>
            <v-layout>
                <v-app-bar color="primary" prominent>
                    <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

                    <v-toolbar-title>nConnect Administrácia</v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-tooltip text="Log out">
                        <template v-slot:activator="{ props }">
                            <v-btn v-bind="props" icon="mdi-logout"></v-btn>
                        </template>
                    </v-tooltip>
                </v-app-bar>

                <client-only>
                    <v-navigation-drawer v-model="drawer" :location="$vuetify.display.mobile ? 'bottom' : undefined"
                        temporary>
                        <v-list :items="items"></v-list>
                    </v-navigation-drawer>
                </client-only>

                <v-main id="app-main-container">
                    <slot />
                </v-main>
            </v-layout>
        </v-card>
    </div>
</template>

<style scoped>
#app-main-container {
    min-height: 100vh;
}
</style>

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