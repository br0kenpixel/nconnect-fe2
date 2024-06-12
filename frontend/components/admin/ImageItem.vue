<template>
    <v-container>
        <v-row>
            <v-col>
                <img :src="img" alt="Obrázok" width="200" />
            </v-col>
            <v-col>
                <v-btn prepend-icon="mdi-trash-can" base-color="red" @click="deleter">Zmazať</v-btn>
            </v-col>
        </v-row>
        <v-row>

        </v-row>
    </v-container>
</template>

<script lang="ts">
export default {
    props: {
        img: {
            type: String,
            required: true
        },
        deleter: {
            type: Function,
            required: true,
            default: () => { }
        }
    }
}
</script>