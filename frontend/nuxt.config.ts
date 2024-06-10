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
        "nuxt-tiptap-editor"
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
    tiptap: {
        prefix: "Tiptap",
    },
    runtimeConfig: {
        public: {
            apiUrl: process.env.BACKEND_API
        }
    }
});