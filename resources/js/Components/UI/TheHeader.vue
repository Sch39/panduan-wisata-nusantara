<template>
    <header ref="navbar"
        class="bg-background sticky top-0 z-50 transition-transform duration-300 ease-in-out text-navbar-link">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-2 pb-1 lg:px-1" aria-label="Global">
            <Logo />
            <div class="flex flex-1 h-12 justify-end gap-x-1">
                <BaseLink v-if="!$page.props.auth" :href="$useRoute('/login')"
                    class="hidden lg:flex items-center py-3 px-3 tracking-widest relative group hover:text-text">
                    {{ __('header.navbar.login').toUpperCase() }}
                    <span
                        class="absolute left-0 bottom-0 w-full h-[4px] bg-accent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-in-out origin-left"></span>
                </BaseLink>

                <UserDropdown class="hidden lg:flex items-center py-3 px-3" position="right" v-else
                    :user="{ name: $page.props.auth.name }" :dashboardLink="$useRoute('/dashboard')"
                    :savedDestinationsLink="$useRoute('/saved-destinations')" :logoutLink="$useRoute('/logout')"
                    :dashboardText="__('header.navbar.dashboard')"
                    :savedDestinationsText="__('header.navbar.saved_destinations')"
                    :logoutText="__('header.navbar.logout')" />
                <LangDropdownUnderline class="hidden lg:!flex" />

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
        <Menu :open="menuOpen" @close="toggleMenu">
            <template #navBottom="{ selectedMenu }">
                <div v-if="!selectedMenu" class="flex justify-between lg:!hidden items-center">
                    <BaseLink v-if="!$page.props.auth" :href="$useRoute('/login')"
                        class="items-center py-3 px-3 tracking-widest relative group hover:text-text">
                        {{ __('header.navbar.login').toUpperCase() }}
                        <span
                            class="absolute left-0 bottom-0 w-full h-[4px] bg-accent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-in-out origin-left"></span>
                    </BaseLink>
                    <UserDropdown v-else :user="{ name: $page.props.auth.name }"
                        :dashboardLink="$useRoute('/dashboard')"
                        :savedDestinationsLink="$useRoute('/saved-destinations')" :logoutLink="$useRoute('/logout')"
                        :dashboardText="__('header.navbar.dashboard')"
                        :savedDestinationsText="__('header.navbar.saved_destinations')"
                        :logoutText="__('header.navbar.logout')" />
                    <LangDropdownUnderline />
                </div>
            </template>
        </Menu>
    </header>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from 'vue'
import MenuButton from './MenuButton.vue'
import Menu from './Menu.vue'
import BaseLink from './BaseLink.vue'
import LangDropdownUnderline from "./LangDropdownUnderline.vue";
import UserDropdown from './UserDropdown.vue';

import Logo from './Logo.vue';
import { useRecaptcha } from '../../Composables/useRecaptcha';

import { usePage, router } from '@inertiajs/vue3'

useRecaptcha(usePage().props.locale)
watch(() => usePage().props.locale, (newLocale) => {
    useRecaptcha(newLocale)
})

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
<style>
.grecaptcha-badge {
    visibility: hidden !important;
}
</style>
