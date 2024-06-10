<script setup lang="ts">
const links = [
    { display: "Domov", to: "admin-panel" },
    { display: "Manažment konferencií", to: "admin-conferences" },
    { display: "Manažment stageov", to: "admin-stages" },
    { display: "Manažment speakerov", to: "admin-speakers" },
    { display: "Manažment prednášok", to: "admin-schedules" },
    { display: "Manažment partnerov", to: "admin-sponsors" },
    { display: "Vlastné stránky", to: "admin-custom_pages" },
    { display: "Galéria", to: "admin-gallery" },
];
</script>

<template>
    <div>
        <v-card>
            <v-layout>
                <v-app-bar color="primary" prominent>
                    <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

                    <v-toolbar-title>nConnect Administrácia</v-toolbar-title>

                    <v-spacer></v-spacer>

                    <client-only>
                        <v-tooltip text="Log out">
                            <template v-slot:activator="{ props }">
                                <v-btn v-bind="props" icon="mdi-logout"></v-btn>
                            </template>
                        </v-tooltip>
                    </client-only>
                </v-app-bar>

                <client-only>
                    <v-navigation-drawer v-model="drawer" :location="$vuetify.display.mobile ? 'left' : undefined"
                        temporary>
                        <v-list nav>
                            <v-list-item v-for="link in links" :to="{ name: link.to }" nuxt link>
                                {{ link.display }}
                            </v-list-item>
                        </v-list>
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
    }),

    watch: {
        group() {
            this.drawer = false;
        },
    }
}
</script>