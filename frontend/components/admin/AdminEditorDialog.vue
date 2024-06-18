<template>
    <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-cash" title="Editor administrátora">
            <v-card-text>
                <v-alert v-show="error" text="Prosím vyplňte všetky údaje." title="Chyba" type="error"></v-alert>

                <br />

                <v-row dense>
                    <v-col>
                        <v-text-field label="Meno" v-model="name" clearable required></v-text-field>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-text-field label="E-mail" v-model="email" clearable required type="email"></v-text-field>
                    </v-col>
                </v-row>

                <v-row dense>
                    <v-col>
                        <v-text-field label="Nové heslo" v-model="password" clearable required
                            type="password"></v-text-field>
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
import type { Administrator } from '~/types/private';

export default {
    expose: ['show'],
    emits: ['finished'],

    data() {
        return this.initialData();
    },

    methods: {
        initialData() {
            return {
                editing_id: null as (number | null),
                dialog: false,
                error: false,
                name: "",
                email: "",
                password: "",
            };
        },
        resetData() {
            Object.assign(this.$data, this.$options.data.apply(this));
        },
        canFinish() {
            return this.name.length > 0 && this.email.length > 0;
        },
        show(prefill?: Administrator) {
            this.dialog = true;

            if (prefill !== undefined) {
                this.editing_id = prefill.id;
                this.name = prefill.name;
                this.email = prefill.email;
            }
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

            this.$emit("finished", {
                id: this.editing_id,
                name: this.name,
                email: this.email,
                password: this.password.length === 0 ? null : this.password
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