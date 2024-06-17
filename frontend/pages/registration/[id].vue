<script setup lang="ts">
import type { FullSchedule, RegistrationForm } from '~/types/public';

const config = useRuntimeConfig();
const route = useRoute();
const { data: schedule_data } = await useFetch<FullSchedule>(`${config.public.apiUrl}/registrations/schedule`);
const { data: registration_data, pending: _, error: registration_error } = await useFetch<RegistrationForm>(`${config.public.apiUrl}/registrations/${route.params.id}`);
</script>

<template>
    <v-app>
        <v-sheet class="pa-14" rounded>
            <h3 class="text-center">Úprava registrácie</h3>

            <br>

            <div class="alert alert-danger" role="alert" v-if="registration_error">
                Registrácia nenájdená
            </div>

            <v-card class="mx-auto px-6 py-8" max-width="800" v-else>
                <div class="text-center" v-show="processing">
                    <v-progress-circular :size="30" color="primary" indeterminate></v-progress-circular>
                    <p>Spracovávam požiadavku...</p>
                </div>

                <div class="alert alert-danger" role="alert" v-if="error">
                    {{ error }}
                </div>

                <RegistrationEditor v-show="!processing" :schedule="schedule_data!" :prefill="registration_data!"
                    @finished="handleForm" />
            </v-card>
        </v-sheet>
    </v-app>
</template>

<script lang="ts">
export default {
    data() {
        return {
            error: null as (string | null),
            processing: false,
            client: useSanctumClient(),
        };
    },
    methods: {
        async handleForm(data: RegistrationForm) {
            this.error = null;
            this.processing = true;

            if (data.email.length === 0 || data.name.length === 0 || data.selection.length === 0) {
                this.error = "Prosím vyplnte všetky polia.";
                this.processing = false;
                return;
            }

            try {
                await this.client(`/api/registrations/${this.$route.params.id}`, {
                    method: "POST",
                    body: { ...data }
                });

                this.$router.push({ name: "registration-done" });
            } catch (e) {
                this.error = e as any;
            } finally {
                this.processing = false;
            }
        }
    }
}
</script>