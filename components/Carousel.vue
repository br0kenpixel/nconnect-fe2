<template>
    <div id="indexCarousel" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#indexCarousel" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#indexCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <NuxtImg src="/img/carousel/nconnect.jpg" class="d-block w-100" alt="nconnect" />
                <div class="carousel-caption d-md-block">
                    <h1>nCONNECT</h1>
                    <p>TECH KONFERENCIA PRE ŠTUDENTOV V NITRE</p>
                    <p>14 MAREC 2024, NITRA</p>

                </div>
            </div>
            <div class="carousel-item">
                <NuxtImg src="/img/carousel/studentske_centrum.jpg" class="d-block w-100" alt="Študentské centrum" />
                <div class="carousel-caption d-md-block">
                    <h1>ŠTUDENTSKÉ CENTRUM UKF</h1>
                    <p>VIDÍME SA TAM</p>
                </div>
            </div>
        </div>
    </div>
</template>