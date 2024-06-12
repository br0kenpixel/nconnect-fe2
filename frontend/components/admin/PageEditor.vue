<template>
    <div>
        <div v-if="editor">
            <v-row no-gutters>
                <v-col>
                    <v-btn @click="editor?.chain().focus().toggleHeading({ level: 1 }).run()"
                        :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-header-1"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().toggleHeading({ level: 2 }).run()"
                        :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-header-2"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().toggleHeading({ level: 3 }).run()"
                        :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-header-3"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().toggleHeading({ level: 4 }).run()"
                        :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-header-4"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().toggleHeading({ level: 5 }).run()"
                        :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-header-5"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().toggleHeading({ level: 6 }).run()"
                        :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-header-6"></v-icon>
                    </v-btn>
                </v-col>
                <v-col>
                    <v-btn @click="editor?.chain().focus().toggleBold().run()"
                        :disabled="!editor.can().chain().focus().toggleBold().run()"
                        :class="{ 'is-active': editor.isActive('bold') }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-bold"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().toggleItalic().run()"
                        :disabled="!editor.can().chain().focus().toggleItalic().run()"
                        :class="{ 'is-active': editor.isActive('italic') }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-italic"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().toggleStrike().run()"
                        :disabled="!editor.can().chain().focus().toggleStrike().run()"
                        :class="{ 'is-active': editor.isActive('strike') }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-strikethrough"></v-icon>
                    </v-btn>
                </v-col>
            </v-row>

            <v-row no-gutters>
                <v-col>
                    <v-btn @click="editor?.chain().focus().clearNodes().run()" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-list-group"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().toggleBulletList().run()"
                        :class="{ 'is-active': editor.isActive('bulletList') }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-list-bulleted"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().toggleOrderedList().run()"
                        :class="{ 'is-active': editor.isActive('orderedList') }" class="pa-2 ma-2">
                        <v-icon icon="mdi-format-list-numbered"></v-icon>
                    </v-btn>
                    <v-btn @click="editor?.chain().focus().setHorizontalRule().run()">
                        <v-icon icon="mdi-minus"></v-icon>
                    </v-btn>
                </v-col>
            </v-row>

            <editor-content :editor="(editor as any)" id="editor" />
        </div>
    </div>
</template>

<style scoped>
#editor {
    background: rgb(238, 235, 235);
    border-color: black;
    border-radius: 4px;
    border-style: solid;
}

#editor * {
    outline: none;
}
</style>

<script lang="ts">
import { Editor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';

export default {
    components: {
        EditorContent,
    },
    props: {
        modelValue: {
            type: String,
            default: '',
        },
    },
    emits: ['update:modelValue'],
    data() {
        return {
            editor: null as (Editor | null),
        }
    },
    mounted() {
        this.editor = new Editor({
            content: this.modelValue,
            extensions: [
                StarterKit,
            ],
            onUpdate: () => {
                this.$emit('update:modelValue', this.editor!.getHTML())
            },
        }) as any;
    },
    watch: {
        modelValue(value) {
            const isSame = this.editor!.getHTML() === value;
            if (isSame) {
                return;
            }
            this.editor!.commands.setContent(value, false);
        },
    },
    beforeUnmount() {
        this.editor!.destroy();
    }
}
</script>