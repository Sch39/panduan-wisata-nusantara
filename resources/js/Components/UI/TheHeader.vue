<template>
    <header ref="navbar" class="bg-background sticky top-0 z-50 transition-transform duration-300 ease-in-out">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 pb-1 lg:px-1" aria-label="Global">
            <Logo />
            <div class="flex flex-1 h-12 justify-end gap-x-1">
                <BaseLink href="" class="hidden lg:flex items-center py-3 px-3 tracking-widest relative group">
                    <span class="relative z-10">{{ __('header.navbar.login').toUpperCase() }}</span>
                    <span
                        class="absolute left-0 bottom-0 w-full h-[4px] bg-accent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-in-out origin-left"></span>
                </BaseLink>
                <LangDropdown class="hidden lg:!flex" button-class="relative group">
                    <template #buttonSlot="{ languageName }">
                        <span class="leading-6">{{ languageName }}</span>
                        <ChevronDownIcon class="w-5 h-5 ml-2 -mr-1 text-gray-400" aria-hidden="true" />
                        <span
                            class="absolute left-0 bottom-0 w-11/12 h-[4px] bg-accent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-in-out origin-left"></span>
                    </template>
                </LangDropdown>
                <BaseLink :href="$useRoute('/subscribe')"
                    class="relative overflow-hidden bg-black !text-background hover:!text-text py-3 px-6 tracking-widest flex items-center group">
                    <span class="relative z-10 transition-colors duration-500 ease-in-out">{{
                        __('header.navbar.newsletter').toUpperCase() }}</span>
                    <span
                        class="absolute inset-0 bg-accent transition-transform duration-500 ease-in-out transform -translate-x-full group-hover:translate-x-0"></span>
                </BaseLink>
                <MobileMenuButton @toggle-mobile-menu="toggleMobileMenu" />
            </div>
        </nav>
        <MobileMenu :open="mobileMenuOpen" @close="toggleMobileMenu" />
    </header>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
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

const lastScrollTop = ref(0);
const navbarVisible = ref(true);
const navbar = ref(null);

const handleScroll = () => {
    const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScrollTop > lastScrollTop.value && currentScrollTop > 100) {
        // Scroll down
        navbar.value.classList.add('-translate-y-full');
    } else {
        // Scroll up
        navbar.value.classList.remove('-translate-y-full');
    }
    lastScrollTop.value = currentScrollTop <= 0 ? 0 : currentScrollTop; // For Mobile or negative scrolling
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>


<style scoped>
.header {
    @apply transition-transform duration-300 ease-in-out;
}
</style>
