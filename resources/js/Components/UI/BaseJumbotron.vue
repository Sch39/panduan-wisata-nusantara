<template>
    <div class="relative bg-cover bg-center h-screen" :style="{ 'background-image': `url(${props.image})` }">
        <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white">
            <h1 v-if="!$slots.title && props.title" class="text-5xl font-bold mb-4">{{ props.title }}</h1>
            <slot v-else name="title"></slot>
            <p v-if="!$slots.description && props.description" class="text-lg mb-8 max-w-xl mx-auto">{{
        props.description }}</p>
            <slot v-else name="description"></slot>
            <Link v-if="!$slots.link && props.link" :href="props.link"
                class="px-6 py-3 bg-accent text-black text-lg rounded-full hover:opacity-80 transition duration-300 font-semibold">
            {{ props.linkText }}</Link>
            <slot v-else name="link"></slot>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { defineProps } from "vue";
const props = defineProps({
    title: { type: String, required: false },
    description: { type: String, required: false },
    link: { type: String, required: false },
    linkText: { type: String, required: false },
    image: { type: String, required: true },
})
</script>
