<template>
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <Logo />
            <MobileMenuButton @toggle-mobile-menu="toggleMobileMenu" />

            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <NavLinks />
                <a href="#" class="text-sm text-center font-semibold leading-6 text-gray-900 lg:ml-16 w-20">Log in <span
                        aria-hidden="true">&rarr;</span></a>
            </div>
        </nav>

        <MobileMenu :open="mobileMenuOpen" @close="toggleMobileMenu" />

    </header>
</template>

<script setup>
import { ref } from 'vue'
import MobileMenuButton from './MobileMenuButton.vue'
import MobileMenu from './MobileMenu.vue'
import NavLinks from './NavLinks.vue'

import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
} from '@headlessui/vue'
import {
    ArrowPathIcon,
    ChartPieIcon,
    CursorArrowRaysIcon,
    FingerPrintIcon,
    SquaresPlusIcon,
} from '@heroicons/vue/24/outline'
import { ChevronDownIcon, PhoneIcon, PlayCircleIcon } from '@heroicons/vue/20/solid'
import { Link } from '@inertiajs/vue3';
import Logo from './Logo.vue';

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

const mobileMenuOpen = ref(false)

function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value
}
</script>
