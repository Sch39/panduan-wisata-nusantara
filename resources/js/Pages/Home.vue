<template>

    <Head>
        <title>{{ __('pages.home.title') }}</title>
        <meta head-key="description" name="description" :content="__('pages.home.meta_description')" />
    </Head>

    <div class="relative bg-cover bg-center h-screen"
        style="background-image: url('/assets/images/volcano-with-mist-sunset.jpg');">
        <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
            <h1 class="text-5xl font-bold mb-4">{{ __('pages.home.jumbotron_title') }}</h1>
            <p class="text-lg mb-8 max-w-xl mx-auto">{{ __('pages.home.jumbotron_description') }}</p>
            <Link :href="$useRoute('/dashboard')"
                class="px-6 py-3 bg-accent text-black text-lg rounded-full hover:opacity-80 transition duration-300 font-semibold">
            {{ __('pages.home.jumbotron_button') }}</Link>

        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>
