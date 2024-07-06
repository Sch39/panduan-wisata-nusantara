<template>
    <a :href="props.href" :class="mergedClass">
        <slot></slot>
    </a>
</template>

<script setup>
import { computed } from 'vue'
const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    class: {
        type: String,
        default: '',
    }
})

const mergedClass = computed(() => {
    return `text-sm font-semibold leading-6 text-gray-900 ${props.class}`
})
</script>
