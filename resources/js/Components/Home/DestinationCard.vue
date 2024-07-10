<template>
    <BaseCard class="w-full h-full" link="/huhu" image="/assets/images/volcano-with-mist-sunset.jpg">
        <template #content>
            <div class="px-6 py-4 flex-grow">
                <div class="mb-2 flex items-center">
                    <Rating :rating="rating" fill-color="text-accent" background-color="text-gray-200" :size="12" />
                    <span class="font-semibold ml-2 text-sm">4.6</span>
                </div>
                <div class="font-serif font-bold text-2xl mb-2 text-left">{{ title }}</div>
                <div class="flex items-center mb-2">
                    <MapPinIcon class="w-4 h-4" />
                    <span class="ml-1 text-text text-[12px]">{{ address }}</span>
                </div>
                <p class="text-gray-700 line-clamp-2 text-sm text-left">
                    {{ description }}
                </p>
            </div>
            <div class="px-6 pt-4 pb-2 flex justify-end">
                <a :href="buttonLink"
                    class="inline-block bg-accent text-navbar-link rounded-full px-6 py-2 mt-2 font-semibold tracking-widest text-lg leading-6 hover:bg-secondary">{{
                        buttonText
                    }}</a>
            </div>
        </template>
    </BaseCard>
</template>

<script setup>
import BaseCard from '../UI/BaseCard.vue';
import Rating from './../UI/Rating.vue'
import { MapPinIcon } from '@heroicons/vue/16/solid'
import { defineProps } from 'vue'

const props = defineProps({
    title: { type: String, required: true },
    rating: { type: Number, required: true },
    address: { type: String, required: true, },
    description: { type: String, required: true },
    buttonLink: { type: String, required: true },
    buttonText: { type: String, required: true }
})
</script>
<style scoped></style>
