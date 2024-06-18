<template>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div id="root">
            <slot />
        </div>
    </div>
</template>

<style scoped>
#root {
    background-color: aliceblue;
    border-radius: 10px;
    border-style: solid;
    padding: 80px !important;
}
</style>
