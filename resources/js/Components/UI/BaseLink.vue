<template>
    <Link :href="props.href" :class="mergedClass">
    <slot></slot>
    </Link>
</template>

<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'
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
    return `text-sm font-semibold leading-6 text-navbar-link ${props.class}`
})
</script>
