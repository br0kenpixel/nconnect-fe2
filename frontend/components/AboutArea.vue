<script lang="ts" setup></script>

<template>
    <div id="about-area-root">
        <div class="container text-center" id="about-area">
            <h3>PÁR SLOV O KONFERENCII NCONNECT</h3>
            <hr>
            <p>Po mnohých rokoch premýšľania a plánovania sme vytvorili nConnect, jedinečnú udalosť v Nitre, ktorá spája
                študentov IT a popredné firmy z tohto dynamického odvetvia. Konferencia nConnect nadväzuje na dlhoročnú
                tradíciu formátu "IT v praxi" Fakulty prírodných vied a informatiky UKF v Nitre. Táto iniciatíva je
                mostom
                medzi novou generáciou talentov a skúsenými profesionálmi, ktorý poskytuje fórum pre vzájomnú výmenu
                myšlienok a inšpirácií. Naše poslanie bolo jasné: vyplniť medzeru v regionálnej komunikácii a spolupráci
                v
                IT a nConnect je hrdým výsledkom tejto vízie.</p>

            <div class="card-group">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">KTO SME?</h5>
                        <hr>
                        <p class="card-text custom-card-text">Sme skupina nadšencov pre IT z akademického a súkromného
                            sektora.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ČO CHCEME DOSIAHNUŤ?</h5>
                        <hr>
                        <p class="card-text custom-card-text">Vytvoriť udalosť, ktorá bude na pravidelnej báze spájať IT
                            komunitu v
                            Nitre.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
h3,
h5,
p {
    font-family: 'Lato', sans-serif;
}

#about-area {
    padding-top: 50px;
    padding-bottom: 50px;
    width: 85%;
}

#about-area-root {
    background: #f0f3f5;
}

p {
    text-align: justify;
    color: #777;
}

h3,
h5 {
    text-transform: uppercase;
    font-weight: bold;
}

.custom-card-text {
    font-style: italic !important;
}
</style>
