<template>
    <PopoverGroup class="hidden lg:flex lg:gap-x-12">
        <Popover class="relative">
            <PopoverButton
                class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900 focus:outline-none focus:ring-0">
                Product
                <ChevronDownIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
            </PopoverButton>

            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1"
                enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150"
                leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                <PopoverPanel
                    class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
                    <div class="p-4">
                        <div v-for="item in products" :key="item.name"
                            class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                            <div
                                class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                                <component :is="item.icon" class="h-6 w-6 text-gray-600 group-hover:text-indigo-600"
                                    aria-hidden="true" />
                            </div>
                            <div class="flex-auto">
                                <BaseLink v-for="item in callsToAction" :key="item.name" :href="item.href + '/hh'"
                                    class="block">
                                    {{ item.name }}
                                    <span class="absolute inset-0" />
                                </BaseLink>

                            </div>
                        </div>
                    </div>

                </PopoverPanel>
            </transition>
        </Popover>

        <BaseLink href="">Features</BaseLink>
        <BaseLink href="">Marketplace</BaseLink>
        <BaseLink href="">Company</BaseLink>
    </PopoverGroup>
</template>

<script setup>
import { Popover, PopoverButton, PopoverPanel, PopoverGroup } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { ArrowPathIcon, Bars3Icon, ChartPieIcon, CursorArrowRaysIcon, FingerPrintIcon, SquaresPlusIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { PlayCircleIcon, PhoneIcon } from '@heroicons/vue/20/solid'
import BaseLink from './BaseLink.vue'

const products = [
    { name: 'Analytics', description: 'Get a better understanding of your traffic', href: '#', icon: ChartPieIcon },
    { name: 'Engagement', description: 'Speak directly to your customers', href: '#', icon: CursorArrowRaysIcon },
    { name: 'Security', description: 'Your customers’ data will be safe and secure', href: '#', icon: FingerPrintIcon },
    { name: 'Integrations', description: 'Connect with third-party tools', href: '#', icon: SquaresPlusIcon },
    { name: 'Automations', description: 'Build strategic funnels that will convert', href: '#', icon: ArrowPathIcon },
]
const callsToAction = [
    { name: 'Watch demo', href: '#', icon: PlayCircleIcon },
    { name: 'Contact sales', href: '#', icon: PhoneIcon },
]
</script>
