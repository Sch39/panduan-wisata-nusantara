<script setup>
import TheHeader from '../Components/TheHeader.vue';
import TheFooter from '../Components/TheFooter.vue'
</script>


<template>
    <TheHeader />
    <main>
        <slot />
    </main>
    <TheFooter />
</template>
