<template>
    <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-cash" title="Speaker editor">
            <v-card-text>
                <v-alert v-show="error" text="Prosím vyplňte všetky údaje. Vybraný súbor musí byť obrázok."
                    title="Chyba" type="error"></v-alert>

                <br />

                <v-row dense>
                    <v-col>
                        <v-text-field label="Meno" v-model="name" clearable required></v-text-field>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-text-field label="Zamestnávateľ/Firma" v-model="employer" clearable required></v-text-field>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-checkbox label="Headliner" v-model="headliner"></v-checkbox>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-textarea label="Popis" v-model="description" clearable required></v-textarea>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-file-input label="Profilovka/Obrázok" variant="underlined" v-model="image"></v-file-input>
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
import { encode } from 'base64-arraybuffer';
import type { Speaker } from '~/types/public';

export default {
    expose: ['show'],
    emits: ["finished"],

    data() {
        return this.initialData();
    },

    methods: {
        initialData() {
            return {
                dialog: false,
                error: false,
                editing_id: null as (number | null),
                name: "",
                employer: "",
                headliner: false,
                description: "",
                image: null as (File | null),
            };
        },
        resetData() {
            Object.assign(this.$data, this.$options.data.apply(this));
        },
        canFinish() {
            if (this.image === null && this.editing_id === null) {
                return false;
            }

            if (this.image !== null && !this.image?.type.startsWith("image/")) {
                return false;
            }

            return this.name.length > 0 &&
                this.employer.length > 0 &&
                this.description.length > 0;
        },
        show(prefill?: Speaker) {
            this.dialog = true;

            if (prefill !== undefined) {
                this.editing_id = prefill.id;
                this.name = prefill.name;
                this.employer = prefill.company;
                this.headliner = prefill.headliner;
                this.description = prefill.description;
            }
        },
        close() {
            this.dialog = false;
            this.resetData();
        },
        async finish() {
            if (!this.canFinish()) {
                this.error = true;
                return;
            }

            let image_content: string | null = "data:image/";
            if (this.image !== null) {
                let buffer = await this.image.arrayBuffer();
                let extension = this.image.name.substring(this.image.name.lastIndexOf(".") + 1);

                switch (extension.toLowerCase()) {
                    case "jpg":
                    case "jpeg":
                        image_content += "jpg";
                        break;
                    case "png":
                        image_content += "png";
                        break;
                    default:
                        this.error = true;
                        return;
                }

                image_content += ";base64, ";
                image_content += encode(buffer);
            } else {
                image_content = null;
            }

            this.$emit("finished", {
                id: this.editing_id,
                name: this.name,
                image: image_content,
                employer: this.employer,
                description: this.description,
                headliner: this.headliner
            });
            this.close();
        }
    },

    watch: {
        dialog(newDialog, _) {
            if (!newDialog) this.error = false;
        }
    }
}
</script>