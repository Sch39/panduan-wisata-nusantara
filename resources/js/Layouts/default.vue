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
</style>
