<script setup>
import TheHeader from '../Components/UI/TheHeader.vue';
import TheFooter from '../Components/UI/TheFooter.vue'
</script>


<template>
    <TheHeader />
    <main>
        <slot />
    </main>
    <TheFooter />
</template>

<style>
input::-ms-reveal,
input::-ms-clear {
    display: none;
}

.toast-success {
    background-color: #4caf50;
    color: white;
}

.toast-error {
    background-color: #f44336;
    color: white;
}

.toast-info {
    background-color: #2196f3;
    color: white;
}
</style>
