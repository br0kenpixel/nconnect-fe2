import vuetify, { transformAssetUrls } from 'vite-plugin-vuetify';

export default defineNuxtConfig({
    devtools: { enabled: false },
    css: ['~/assets/styles/main.scss'],
    modules: [
        "@nuxt/image",
        (_options, nuxt) => {
            nuxt.hooks.hook('vite:extendConfig', (config) => {
                // @ts-expect-error
                config.plugins.push(vuetify({ autoImport: true }))
            })
        },
        "nuxt-tiptap-editor",
        "nuxt-auth-sanctum"
    ],
    build: {
        transpile: ['vuetify']
    },
    vite: {
        vue: {
            template: {
                transformAssetUrls,
            }
        }
    },
    nitro: {
        compressPublicAssets: true
    },
    tiptap: {
        prefix: "Tiptap",
    },
    sanctum: {
        baseUrl: 'http://localhost:8000',
        origin: 'http://localhost:3000',
        redirect: {
            onLogin: "/admin/panel",
            onLogout: "/admin/login",
            onAuthOnly: '/admin/login',
            keepRequestedRoute: false,
            onGuestOnly: false,
        },
        redirectIfAuthenticated: true
    },
    runtimeConfig: {
        public: {
            apiUrl: process.env.BACKEND_API
        }
    }
});