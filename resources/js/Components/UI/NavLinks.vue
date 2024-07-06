<template>
    <PopoverGroup class="hidden lg:flex lg:gap-x-12">

        <BaseLink href="">LOGIN</BaseLink>
        <BaseLink href="">SUBSCRIBE</BaseLink>
        <BaseLink href="">Company</BaseLink>
    </PopoverGroup>
</template>

<script setup>
import { Popover, PopoverButton, PopoverPanel, PopoverGroup } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { ArrowPathIcon, ChartPieIcon, CursorArrowRaysIcon, FingerPrintIcon, SquaresPlusIcon } from '@heroicons/vue/24/outline'
import BaseLink from './BaseLink.vue'
</script>
