<template>
    <div class="bg-white shadow-md rounded-lg overflow-hidden h-full flex flex-col">
        <img v-if="image" :src="image" :alt="imageAlt" class="w-full h-48 object-cover">
        <slot v-if="$slots.content" name="content"></slot>
        <div v-else class="p-6 flex-grow">
            <h3 class="text-2xl font-bold mb-2 text-gray-800">{{ title }}</h3>
            <p class="text-gray-600 mb-4">{{ description }}</p>
            <div v-if="buttonText" class="mt-4">
                <a :href="link"
                    class="px-4 py-2 bg-primary text-white font-semibold rounded hover:bg-secondary transition duration-300">
                    {{ buttonText }}
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    title: {
        type: String,
        required: false
    },
    description: {
        type: String,
        required: false
    },
    image: {
        type: String,
        default: null
    },
    imageAlt: {
        type: String,
        default: 'image'
    },
    buttonText: {
        type: String,
        default: null
    },
    link: {
        type: String,
        required: false,
    }
});
</script>
