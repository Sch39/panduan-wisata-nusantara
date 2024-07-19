<template>

    <Head>
        <title>{{ __('pages.404.title') }}</title>
    </Head>

    <section class="bg-gray-100">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-gray-800">404</h1>
                <p class="mb-4 text-3xl tracking-tight font-bold text-gray-800 md:text-4xl">{{
            __('pages.404.content_title') }}</p>
                <p class="mb-4 text-lg font-light text-gray-600">{{ __('pages.404.content_description') }}</p>

                <Link :href="props.home"
                    class="inline-flex text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4">
                {{ __('pages.404.to_home') }}
                </Link>
            </div>
        </div>
    </section>

</template>

<script setup>
import { Link, Head } from '@inertiajs/vue3'
import { defineOptions } from 'vue'
defineOptions({ layout: undefined })
const props = defineProps({
    home: {
        type: String,
        required: true
    },
})

</script>

<style scoped>
/* Tambahkan gaya sesuai kebutuhan */
</style>
