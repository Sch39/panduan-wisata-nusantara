<template>
    <LangDropdown :class="mergedClass" button-class="relative group">
        <template #buttonSlot="{ languageName, menuOpen }">
            <span class="leading-6">{{ languageName }}</span>
            <transition name="fade" mode="out-in">
                <ChevronDownIcon v-if="!menuOpen" class="w-5 h-5 ml-1 -mr-1" aria-hidden="true" key="down" />
                <ChevronUpIcon v-else class="w-5 h-5 ml-1 -mr-1" aria-hidden="true" key="up" />
            </transition>
            <span
                class="absolute left-0 bottom-0 w-11/12 h-[4px] bg-accent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-in-out origin-left"></span>
        </template>
    </LangDropdown>
</template>
<script setup>
import { ChevronDownIcon, ChevronUpIcon } from '@heroicons/vue/20/solid'
import { defineProps, computed } from "vue";
import LangDropdown from './LangDropdown.vue'
const props = defineProps({
    class: {
        type: String,
        default: ''
    }
})

const mergedClass = computed(() => `${props.class}`)
</script>
