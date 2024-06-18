<script lang="ts" setup>
definePageMeta({
    layout: 'public'
});

useSeoMeta({
    title: "Speakeri | nConnect",
    ogTitle: "Naši speakeri - Spájame IT komunity",
    description: "Speakeri konferencie nConnect",
    ogDescription: "Naši speakeri",
});
</script>

<template>
    <div>
        <SpecificPublicPageHeader title="Speakers" />
        <SpeakersArea />
    </div>
</template>

<style scoped></style>
