<template>
    <!-- <div class="flex"> -->
    <button type="button"
        class="px-2 py-4 text-navbar-link my-auto text-center focus:outline-none hover:bg-secondary transition-color duration-300 bg-accent p-1 rounded-r-lg transition-color"
        @click="$emit('toggleMobileMenu')">
        <span class="sr-only">Open main menu</span>

        <transition name="fade" mode="out-in">
            <ChevronDoubleRightIcon v-if="true" class="h-5 w-5" aria-hidden="true" />
            <ChevronDoubleLeftIcon v-else class="h-5 w-5" aria-hidden="true" />
        </transition>

    </button>
    <!-- </div> -->
</template>

<script setup>
import { ChevronDoubleRightIcon, ChevronDoubleLeftIcon } from '@heroicons/vue/24/outline';
import { computed } from "vue";

const props = defineProps({
    textClass: {
        type: String,
        default: ''
    },
    // isMenuOpen: {
    //     type: Boolean,
    //     required: true
    // }
})

const mergedTextClass = computed(() => `leading-6 text-sm ${props.textClass}`)
</script>
