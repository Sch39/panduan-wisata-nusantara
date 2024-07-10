<template>
    <div class="flex items-center">
        <template v-for="star in 5">
            <svg :width="props.size + 10" :height="props.size + 10" v-if="star <= Math.floor(rating)"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" :class="[props.fillColor]">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
            </svg>
            <svg :width="props.size + 10" :height="props.size + 10"
                v-else-if="star === Math.ceil(rating) && rating % 1 !== 0" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                :class="[props.fillColor]">
                <defs>
                    <linearGradient id="half">
                        <stop offset="50%" stop-color="currentColor" />
                        <stop offset="50%" stop-color="transparent" />
                    </linearGradient>
                </defs>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"
                    fill="url(#half)" />
            </svg>
            <svg :width="props.size + 10" :height="props.size + 10" v-else xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                :class="[props.backgroundColor]">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
            </svg>
        </template>
    </div>
</template>
<script setup>
import { defineProps, computed } from 'vue'
const props = defineProps({
    stars: {
        type: Number,
        default: 5,
    },
    rating: {
        type: Number,
        required: true,
    },
    size: {
        type: Number,
        default: 5
    },
    fillColor: {
        type: String,
        default: 'text-yellow-500',
    },
    backgroundColor: {
        type: String,
        default: 'text-gray-300'
    }
})

const sizeClass = computed(() => `w-${props.size} h-${props.size}`)
</script>
