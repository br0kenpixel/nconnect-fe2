<script setup lang="ts">
const reviews = [
    {
        name: "John Doe",
        text: "Very good!",
        image: "/",
        position: "IBM"
    },
    {
        name: "Jenna Doe",
        text: "Great company!",
        image: "/",
        position: "Microsoft - kernel dev"
    },
    {
        name: "Joe Dawn",
        text: "Great people and awesome personel. Very nice!",
        image: "/",
        position: "Google"
    },
    {
        name: "Stanley Fee",
        text: "Example...",
        image: "/",
        position: "EA"
    }
];
</script>

<template>
    <div id="reviews-area-root">
        <div class="container" id="reviews-area">
            <h2 class="text-center">Povedali o nás</h2>

            <hr>

            <div>
                <Review v-for="review in reviews" :name="review.name" :text="review.text" :position="review.position"
                    :image="review.image" class="mx-auto" />
            </div>
        </div>
    </div>
</template>

<style scoped>
#reviews-area {
    padding-top: 50px;
    padding-bottom: 50px;
    width: 85%;
}

#reviews-area-root {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("/img/testimonial.jpg");
}

h2 {
    color: white;
    text-transform: uppercase;
    font-weight: bold;
}

hr {
    color: white;
}
</style>
