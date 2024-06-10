<template>
    <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-cash" title="Editor galérie">
            <v-card-text>
                <v-alert v-show="error" text="Prosím vyplňte všetky údaje. Vybrané súbory musia byť obrázky."
                    title="Chyba" type="error"></v-alert>

                <br />

                <v-row dense>
                    <v-col>
                        <v-select label="Ročník" clearable variant="underlined" :items="['2020']"
                            v-model="year"></v-select>
                    </v-col>
                </v-row>

                <v-row dense v-for="image in ['/']">
                    <v-col>
                        <AdminImageItem :img="image" />
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-file-input label="Pridať obrázok" variant="underlined"></v-file-input>
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
        return this.initialData();
    },

    methods: {
        initialData() {
            return {
                dialog: false,
                error: false,
                year: "",
            };
        },
        resetData() {
            Object.assign(this.$data, this.$options.data.apply(this));
        },
        canFinish() {
            return this.year.length > 0 &&
                this.date !== null;
        },
        show() {
            this.dialog = true;
        },
        close() {
            this.dialog = false;
            this.resetData();
        },
        finish() {
            if (!this.canFinish()) {
                this.error = true;
                return;
            }

            this.close();
        }
    },

    watch: {
        dialog(newDialog, _) {
            if (!newDialog) this.error = false;
        },
        date(newDate: Date, _) {
            this.weekendWarning = newDate.getDay() % 6;
        }
    }
}
</script>