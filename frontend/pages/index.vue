<script lang="ts" setup>
definePageMeta({
    layout: 'public'
});
useSeoMeta({
    title: "nConnect | Spájame IT komunity",
    ogTitle: "Domovská stránka - Spájame IT komunity",
    description: "Domovská stránka konferencie nConnect",
    ogDescription: "Domovská stránka",
});
</script>

<template>
    <div>
        <Carousel />
        <AboutArea />
        <SpeakersArea />
        <ScheduleArea />
        <ReviewsArea />
        <SponsorsArea />
        <ContactArea />
    </div>
</template>

<style scoped></style>
