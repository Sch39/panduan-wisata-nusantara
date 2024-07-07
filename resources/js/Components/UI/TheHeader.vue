<template>
    <header class="bg-background">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 pb-1 lg:px-1" aria-label="Global">
            <Logo />
            <div class="flex flex-1 h-12 justify-end gap-x-1">
                <BaseLink href=""
                    class="hidden lg:flex items-center py-3 px-3 tracking-widest hover:underline underline-offset-8 decoration-accent decoration-4">
                    <span class="relative z-10">{{
                        __('header.navbar.login').toUpperCase() }}</span>
                </BaseLink>
                <LangDropdown class="hidden lg:!flex " />
                <BaseLink :href="$useRoute('/subscribe')"
                    class="relative overflow-hidden bg-black !text-background hover:!text-text py-3 px-6 tracking-widest flex items-center group">
                    <span class="relative z-10 transition-colors duration-500 ease-in-out">{{
                        __('header.navbar.newsletter').toUpperCase()
                    }}</span>
                    <span
                        class="absolute inset-0 bg-accent transition-transform duration-500 ease-in-out transform -translate-x-full group-hover:translate-x-0"></span>
                </BaseLink>


                <MobileMenuButton @toggle-mobile-menu="toggleMobileMenu" />
            </div>

            <!-- <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <NavLinks />
                <BaseLink href="" class="text-center lg:ml-16 w-20">Log in <span aria-hidden="true">&rarr;</span>
                </BaseLink>

            </div> -->
        </nav>

        <MobileMenu :open="mobileMenuOpen" @close="toggleMobileMenu" />

    </header>
</template>

<script setup>
import { ref } from 'vue'
import MobileMenuButton from './MobileMenuButton.vue'
import MobileMenu from './MobileMenu.vue'
import NavLinks from './NavLinks.vue'
import BaseLink from './BaseLink.vue'
import LangDropdown from './LangDropdown.vue'

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
import { getLocale } from '../../Composables/useRoute'

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


<style scoped></style>
