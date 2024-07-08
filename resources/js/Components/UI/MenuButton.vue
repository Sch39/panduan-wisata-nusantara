<template>
    <div class="flex">
        <button type="button" class="inline-flex items-center justify-center px-3 py-3 text-navbar-link"
            @click="$emit('toggleMobileMenu')">
            <span class="sr-only">Open main menu</span>
            <span :class="mergedTextClass">{{ __('header.navbar.menu').toUpperCase() }}</span>
            <transition name="fade" mode="out-in">
                <ChevronDoubleDownIcon v-if="!props.isMenuOpen" class="h-5 w-5 ml-1" aria-hidden="true" />
                <ChevronDoubleUpIcon v-else class="h-5 w-5 ml-1" aria-hidden="true" />
            </transition>

        </button>
    </div>
</template>

<script setup>
import { ChevronDoubleDownIcon, ChevronDoubleUpIcon } from '@heroicons/vue/24/outline';
import { computed } from "vue";

const props = defineProps({
    textClass: {
        type: String,
        default: ''
    },
    isMenuOpen: {
        type: Boolean,
        required: true
    }
})

const mergedTextClass = computed(() => `leading-6 text-sm ${props.textClass}`)
</script>
