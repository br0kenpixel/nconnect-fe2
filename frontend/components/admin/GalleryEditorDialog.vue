<script setup lang="ts">
import { encode } from 'base64-arraybuffer';
import { convertImage } from '~/helpers';
import type { Conference } from '~/types/private';
import type { Gallery } from '~/types/public';

const config = useRuntimeConfig();
const { data, pending } = await useFetch<Conference[]>(`${config.public.apiUrl}/conferences`, { lazy: true });
</script>

<template>
    <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-cash" title="Editor galérie">
            <v-card-text>
                <v-alert v-show="error" text="Prosím vyplňte všetky údaje. Vybrané súbory musia byť obrázky."
                    title="Chyba" type="error"></v-alert>

                <br />

                <v-row dense>
                    <v-col>
                        <p v-if="pending">Načítavam...</p>
                        <v-select v-else label="Ročník" clearable variant="underlined" :items="(data as Conference[])"
                            item-title="year" v-model="conference" return-object></v-select>
                    </v-col>
                </v-row>

                <v-row dense v-for="(image, i) in images">
                    <v-col>
                        <AdminImageItem :img="image" :deleter="() => deleteImage(i)" />
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-file-input label="Pridať obrázok" variant="underlined"
                            v-model="selectedImage"></v-file-input>
                    </v-col>
                </v-row>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn text="Zrušiť" variant="plain" @click="close" append-icon="mdi-cancel"></v-btn>
                <v-btn color="primary" text="Uložiť" variant="tonal" @click="finish"
                    append-icon="mdi-content-save-move"></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script lang="ts">
export default {
    expose: ['show'],
    emits: ['finished'],

    data() {
        return this.initialData();
    },

    methods: {
        initialData() {
            return {
                dialog: false,
                error: false,
                editing: false,
                conference: null as (Conference | null),
                images: [] as string[],
                selectedImage: null as (File | null)
            };
        },
        resetData() {
            Object.assign(this.$data, this.$options.data.apply(this));
        },
        canFinish() {
            if (this.editing && this.images.length == 0) {
                return false;
            }

            return this.conference !== null;
        },
        show(prefill?: Gallery[]) {
            this.dialog = true;

            if (prefill !== undefined) {
                this.conference = prefill[0].conference;
                this.images = new Array();

                prefill.forEach((entry) => {
                    entry.gallery.forEach((g_entry) => {
                        this.images.push(g_entry.image);
                    });
                });
                this.editing = true;
            }
        },
        close() {
            this.dialog = false;
            this.resetData();
        },
        deleteImage(i: number) {
            this.images.splice(i, 1);
        },
        async finish() {
            if (!this.canFinish()) {
                this.error = true;
                return;
            }

            this.$emit("finished", {
                editing: this.editing,
                conference: this.conference,
                images: this.images
            });
            this.close();
        }
    },
    watch: {
        dialog(newDialog, _) {
            if (!newDialog) this.error = false;
        },
        date(newDate: Date, _) {
            this.weekendWarning = newDate.getDay() % 6;
        },
        selectedImage(newImage: File | null, _) {
            if (newImage === null) {
                return;
            }

            convertImage(newImage).then((result) => {
                if (result === null) {
                    return;
                }

                this.images.push(result);
            }).finally(() => {
                this.selectedImage = null;
            });
        }
    }
}
</script>