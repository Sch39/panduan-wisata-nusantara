<template>
    <section class="bg-background">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-navbar-link">
                    404</h1>
                <p class="mb-4 text-3xl tracking-tight font-bold text-text md:text-4xl">Something's
                    missing.</p>
                <p class="mb-4 text-lg font-light text-text ">Sorry, we can't find that page.
                    You'll find lots to explore on the home page. </p>

                <Link :href="props.home"
                    class="inline-flex text-white bg-primary hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4 hover:bg-gray-600">
                Back to Home Page
                </Link>
            </div>
        </div>
    </section>

</template>

<script setup>
import { Link } from '@inertiajs/vue3'
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
