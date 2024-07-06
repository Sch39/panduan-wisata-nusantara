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
