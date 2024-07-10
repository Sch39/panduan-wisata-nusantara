<template>

    <Head>
        <title>{{ __('pages.home.title') }}</title>
        <meta head-key="description" name="description" :content="__('pages.home.meta_description')" />
    </Head>
    <BaseJumbotron image="/assets/images/volcano-with-mist-sunset.jpg" :title="__('pages.home.jumbotron_title')"
        :description="__('pages.home.jumbotron_description')" :link="$useRoute('/dashboard')"
        :link-text="__('pages.home.jumbotron_button').toUpperCase()" />

    <div class="mx-5 mt-5">
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
                <Slide v-for="slide in 10" :key="slide">
                    <div class="flex justify-center items-center h-full">
                        <DestinationCard class="w-full " :title="'Title ' + slide" address="place" :rating="2.5"
                            description="lorem50 ifhirh ghrgi ihgirgiorh hduhud suhd uh duhsd husd usihd ushduhdsu hsufhufiruegfurgfugruif urgfur fguigr"
                            buttonLink="link" buttonText="VISIT" />
                    </div>
                </Slide>
            </template>
            <template #addons>
                <Pagination />
            </template>
        </Carousel>
        <div class="flex justify-center mt-5">
            <BaseLink href=""
                class="inline-block bg-accent text-navbar-link rounded-full px-6 py-2 mt-2 font-semibold tracking-widest text-lg leading-7 hover:bg-secondary">
                VIEW ALL RECOMMENDED</BaseLink>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import BaseJumbotron from './../Components/UI/BaseJumbotron.vue'
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline'
import DestinationCard from '../Components/Home/DestinationCard.vue'
import { ref, defineModel } from 'vue'

import { Carousel, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import BaseLink from '../Components/UI/BaseLink.vue'

const currentSlide = defineModel({ default: 0 })

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
