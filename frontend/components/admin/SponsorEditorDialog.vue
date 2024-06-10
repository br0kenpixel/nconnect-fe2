<template>
    <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-cash" title="Pridať sponzora">
            <v-card-text>
                <v-alert v-show="error" text="Prosím vyplňte všetky údaje. Vybraný súbor musí byť obrázok."
                    title="Chyba" type="error"></v-alert>

                <br />

                <v-row dense>
                    <v-col>
                        <v-text-field label="Názov" v-model="name" clearable required></v-text-field>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-file-input label="Logo/Obrázok" variant="underlined" v-model="image"></v-file-input>
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

    data() {
        return {
            dialog: false,
            error: false,
            name: "",
            image: null as (File | null),
        }
    },

    methods: {
        resetData() {
            this.error = false;
            this.name = "";
            this.image = null;
        },
        show() {
            this.dialog = true;
        },
        close() {
            this.dialog = false;
            this.resetData();
        },
        finish() {
            if (this.name.length == 0 || this.image === null || !this.image?.type.startsWith("image/")) {
                this.error = true;
                return;
            }

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