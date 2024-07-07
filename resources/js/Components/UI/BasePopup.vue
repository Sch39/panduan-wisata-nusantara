<template>
    <div :class="mergedClass">
        <slot></slot>
    </div>
</template>
<script setup>
import { computed, defineProps } from 'vue'
const props = defineProps({
    class: {
        type: String,
        default: '',
    }
})
const mergedClass = computed(() => {
    const customClass = props.class || 'bg-white divide-y divide-gray-100 shadow-sm focus:!outline-none border border-text rounded-md'

    return `absolute right-0 w-56 mt-1 origin-top-right ${customClass}`
})
</script>
