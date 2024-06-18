<template>
    <div id="indexCarousel" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#indexCarousel" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#indexCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="min-height: 100px;">
                <NuxtImg src="/img/carousel/nconnect.webp" class="d-block w-100" alt="nconnect" width="1500"
                    height="500" />
                <div class="carousel-caption d-md-block">
                    <h1>nCONNECT</h1>
                    <p>TECH KONFERENCIA PRE ŠTUDENTOV V NITRE</p>
                    <p>14 MAREC 2024, NITRA</p>

                </div>
            </div>
            <div class="carousel-item">
                <NuxtImg src="/img/carousel/studentske_centrum.webp" class="d-block w-100" alt="Študentské centrum"
                    loading="lazy" width="900" height="500" />
                <div class="carousel-caption d-md-block">
                    <h1>ŠTUDENTSKÉ CENTRUM UKF</h1>
                    <p>VIDÍME SA TAM</p>
                </div>
            </div>
        </div>
    </div>
</template>