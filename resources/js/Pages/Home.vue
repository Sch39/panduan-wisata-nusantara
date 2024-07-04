<template>

    <Head>
        <title>My app</title>
        <meta head-key="description" name="description" content="This is the default description" />
        <!-- <link rel="icon" type="image/svg+xml" href="/favicon.svg" /> -->
    </Head>

    <!-- resources/views/welcome.blade.php -->
    <div class="bg-background min-h-screen flex flex-col items-center justify-center">
        <h1 class="font-serif text-primary text-4xl mb-4">Selamat Datang di Panduan Wisata Nusantara</h1>
        <p class="font-sans text-text text-lg">Temukan destinasi wisata terbaik di Indonesia.</p>
        <button class="bg-secondary text-white py-2 px-4 mt-4 rounded hover:bg-accent">Jelajahi Sekarang</button>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

</script>
