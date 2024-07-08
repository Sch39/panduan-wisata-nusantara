<template>
    <header ref="navbar" class="bg-background sticky top-0 z-50 transition-transform duration-300 ease-in-out">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-2 pb-1 lg:px-1" aria-label="Global">
            <Logo />
            <div class="flex flex-1 h-12 justify-end gap-x-1">
                <BaseLink href=""
                    class="hidden lg:flex items-center py-3 px-3 tracking-widest relative group hover:text-text">
                    {{ __('header.navbar.login').toUpperCase() }}
                    <span
                        class="absolute left-0 bottom-0 w-full h-[4px] bg-accent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-in-out origin-left"></span>
                </BaseLink>
                <LangDropdown class="hidden lg:!flex" button-class="relative group">
                    <template #buttonSlot="{ languageName, menuOpen }">
                        <span class="leading-6">{{ languageName }}</span>
                        <transition name="fade" mode="out-in">
                            <ChevronDownIcon v-if="!menuOpen" class="w-5 h-5 ml-1 -mr-1 text-gray-400"
                                aria-hidden="true" key="down" />
                            <ChevronUpIcon v-else class="w-5 h-5 ml-1 -mr-1 text-gray-400" aria-hidden="true"
                                key="up" />
                        </transition>
                        <span
                            class="absolute left-0 bottom-0 w-11/12 h-[4px] bg-accent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-in-out origin-left"></span>
                    </template>
                </LangDropdown>
                <BaseLink :href="$useRoute('/newsletter')"
                    class="relative overflow-hidden bg-black !text-background hover:!text-navbar-link py-3 px-6 tracking-widest flex items-center group">
                    <span class="relative z-10 transition-colors duration-500 ease-in-out">{{
                        __('header.navbar.newsletter').toUpperCase() }}</span>
                    <span
                        class="absolute inset-0 bg-accent transition-transform duration-500 ease-in-out transform -translate-x-full group-hover:translate-x-0"></span>
                </BaseLink>
                <MenuButton text-class="hidden md:inline mr-2 tracking-widest flex items-center font-semibold"
                    @toggle-mobile-menu="toggleMenu" :is-menu-open="menuOpen" />
            </div>
        </nav>
        <Menu :open="menuOpen" @close="toggleMenu" />
    </header>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import MenuButton from './MenuButton.vue'
import Menu from './Menu.vue'
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
import { ChevronDownIcon, PhoneIcon, PlayCircleIcon, ChevronUpIcon } from '@heroicons/vue/20/solid'
import { Link } from '@inertiajs/vue3';
import Logo from './Logo.vue';
import { getLocale } from '../../Composables/useRoute'

const menuOpen = ref(false)

function toggleMenu() {
    menuOpen.value = !menuOpen.value
}

const lastScrollTop = ref(0);
const navbar = ref(null);

const handleScroll = () => {
    const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScrollTop > lastScrollTop.value && currentScrollTop > 50) {
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
