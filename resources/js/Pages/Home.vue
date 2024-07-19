<template>

    <Head>
        <title>{{ __('pages.home.title') }}</title>
        <meta head-key="description" name="description" :content="__('pages.home.meta_description')" />
    </Head>
    <BaseJumbotron background-class="bg-gray-900 bg-opacity-10" image="/assets/images/volcano-with-mist-sunset.jpg"
        :title="__('pages.home.jumbotron_title')" :description="__('pages.home.jumbotron_description')"
        :link="$useRoute('/dashboard')" :link-text="__('pages.home.jumbotron_button').toUpperCase()" />

    <div class="mx-5 mt-10">
        <h2
            class="font-serif font-extrabold text-center text-2xl md:text-3xl leading-6 tracking-wider text-navbar-link mb-10 md:mb-5">
            Recommended</h2>
        <div class="justify-end space-x-8 hidden md:flex mb-5">
            <button :disabled="currentSlide === 0" :class="{ '!text-gray-400 !border-gray-400': currentSlide === 0 }"
                class="disabled p-2 border-2 border-navbar-link rounded-full" @click="carousel.prev()">
                <ChevronLeftIcon class="w-8 h-8" />
            </button>
            <button :disabled="currentSlide === 9" :class="{ '!text-gray-400 !border-gray-400': currentSlide === 9 }"
                class="p-2 border-2 border-navbar-link rounded-full" @click="carousel.next()">
                <ChevronRightIcon class="w-8 h-8" />
            </button>
        </div>
        <Carousel v-model="currentSlide" ref="carousel" v-bind="settings" :breakpoints="breakpoints">
            <template #slides>
                <Slide v-for="destination in props.destination_slider" :key="destination.id">
                    <div class="flex justify-center items-center h-full">
                        <DestinationCard class="w-full " :title="destination.title"
                            :address="`${toTitleCase(destination.regency.name)}, ${toTitleCase(destination.regency.province.name)}`"
                            :rating="destination.destination.rating.avg_rating" :description="destination.description"
                            :buttonLink="$useRoute(`/tour/${destination.destination.slug}`)"
                            :buttonText="__('utils.visit').toUpperCase()" />
                    </div>
                </Slide>
            </template>
            <template #addons>
                <Pagination />
            </template>
        </Carousel>
        <div class="flex justify-center mt-5">
            <BaseLink :href="$useRoute('/travel-inspirations')"
                class="inline-block bg-accent text-navbar-link rounded-full px-6 py-2 mt-2 font-semibold tracking-widest text-lg leading-7 hover:bg-secondary">
                {{ __('utils.view_recommended').toUpperCase() }}</BaseLink>
        </div>
        <BaseJumbotron background-class="bg-accent bg-opacity-[0.08]" image="/assets/images/indonesian-culture.jpg"
            class="mt-20 mb-10">
            <template #title>
                <h2 class="text-3xl font-bold mb-4 text-center text-background">{{
            __('pages.home.culture_tour_jumbotron_title') }}</h2>
            </template>
            <template #description>
                <p class="text-lg mb-8 max-w-xl text-center text-background">
                    {{ __('pages.home.culture_tour_jumbotron_description') }}</p>
            </template>
            <template #link>
                <Link :href="$useRoute('/travel-inspirations')"
                    class="px-6 py-3 bg-secondary bg-opacity-75 text-background text-xl border-2 rounded-full transition duration-300 font-semibold hover:text-text hover:bg-accent hover:bg-opacity-75">
                {{ __('pages.home.culture_tour_jumbotron_button') }}</Link>
            </template>
        </BaseJumbotron>

        <section class="w-full mx-auto lg:px-0">
            <div
                class="bg-gray-800 p-6 md:p-10 rounded-sm mx-auto flex flex-col gap-y-5 justify-center items-center relative">
                <svg class="absolute right-0 top-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" width="227"
                    height="223" viewBox="0 0 227 223" fill="none">
                    <path opacity="0.21"
                        d="M163.766 -28.3772C163.766 -31.8935 161.662 -35.0699 158.422 -36.4473C155.181 -37.8247 151.429 -37.1368 148.891 -34.6996L117.649 -4.71041C71.1338 39.9411 31.8296 91.5182 1.13522 148.185C0.412538 149.459 0 150.932 0 152.501C0 157.345 3.9335 161.271 8.78571 161.271H84.5186V287.378C84.5186 290.852 86.5716 293.998 89.754 295.401C92.9365 296.805 96.6487 296.201 99.2207 293.862L113.199 281.15C162.13 236.652 203.656 184.662 236.217 127.133L244.863 111.856C246.4 109.141 246.377 105.814 244.802 103.121C243.228 100.427 240.339 98.7703 237.214 98.7703H163.766V-28.3772Z"
                        fill="#F2F9FB" fill-opacity="0.4" />
                </svg>
                <h3 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white text-center">{{
            __('utils.newsletter_title') }}
                </h3>
                <div
                    class="input-form max-w-2xl mx-auto w-full flex flex-col md:flex-row gap-y-2 items-center justify-center lg:justify-start gap-x-5 lg:gap-x-5 mt-5">
                    <div class="w-full">
                        <input type="text" :placeholder="__('utils.email_placeholder')"
                            class="py-2.5 px-5 placeholder:text-sm rounded-lg bg-white/20 border border-zinc-400/40 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500/50 ring-offset-2 ring-offset-white transition duration-200">
                    </div>
                    <button
                        class="bg-white w-full md:w-1/3 hover:shadow-md focus:ring-2 focus:ring-indigo-500/50 ring-offset-2 ring-offset-[#EAE8FF] hover:drop-shadow transition duration-200 lg:w-1/3 text-zinc-800 text-sm rounded-lg px-5 py-2.5 shadow-md group font-clash font-[500]">
                        {{ __('header.navbar.subscribe') }}
                    </button>
                </div>
            </div>
        </section>

    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BaseJumbotron from './../Components/UI/BaseJumbotron.vue'
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline'
import DestinationCard from '../Components/Home/DestinationCard.vue'
import { ref, defineModel } from 'vue'

import { Carousel, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import BaseLink from '../Components/UI/BaseLink.vue'
import { toTitleCase } from '../Helper/toTitlecase'

const currentSlide = defineModel({ default: 0 })
const props = defineProps({
    destination_slider: {
        required: true,
        type: Object,
    }
})

const carousel = ref(null)
const settings = ref({
    itemsToShow: 1.5,
    // snapAlign: 'center',
    transition: 500
    // wrapAround: true
}),
    breakpoints = ref({
        0: {
            itemsToShow: 1.2,
        },
        640: {
            itemsToShow: 1.5,
        },
        1024: {
            itemsToShow: 2,
            // snapAlign: 'start',
        }
    })
</script>
<style scoped>
.carousel__slide {
    padding: 15px;
    margin-top: 20px;
    margin-left: 20px;
    margin-bottom: 20px;
}

.carousel__track {
    transform-style: preserve-3d;
}

.carousel__slide--sliding {
    transition: 0.5s;
}

.carousel__slide {
    opacity: 0.9;
    transform: rotateY(-20deg) scale(0.9);
}

.carousel__slide--active~.carousel__slide {
    transform: rotateY(20deg) scale(0.9);
}

.carousel__slide--prev {
    opacity: 1;
    transform: rotateY(-10deg) scale(0.95);
}

.carousel__slide--next {
    opacity: 1;
    transform: rotateY(10deg) scale(0.95);
}

.carousel__slide--active {
    opacity: 1;
    transform: rotateY(0) scale(1.1);
}
</style>
