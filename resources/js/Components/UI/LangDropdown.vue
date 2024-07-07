<template>
    <div :class="mergedClass">
        <Menu v-slot="{ open, close }" as="div" class="relative">
            <MenuButton id="toggleMenu" @mouseenter="(e) => hoverMenu(e, open)" @mouseleave="closeMenu(close)"
                :class="mergedButtonClass">
                <span v-if="!$slots.buttonSlot" class="leading-6">{{ selectedLanguage?.name }}</span>
                <ChevronDownIcon v-if="!$slots.buttonSlot && open" class="w-5 h-5 ml-2 -mr-1 text-gray-400"
                    aria-hidden="true" />
                <slot v-if="$slots.buttonSlot" name="buttonSlot" :languageName="selectedLanguage?.name"
                    :menuOpen="open"></slot>
            </MenuButton>
            <transition enter="transition ease-out duration-100 transform" enter-from="opacity-0 scale-95"
                enter-to="opacity-100 scale-100" leave="transition ease-in duration-100 transform"
                leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                <MenuItems @mouseover.prevent="menuHover = true" @mouseleave.prevent="closeMenu(close)"
                    class="absolute right-0 w-56 mt-1 origin-top-right bg-white divide-y divide-gray-100 shadow-sm focus:!outline-none border border-text rounded-lg">
                    <div class="py-1">
                        <MenuItem v-for="language in languages" :key="language.code">
                        <Link :href="'/' + language.code"
                            class="flex items-center px-4 py-2 text-sm text-text hover:bg-gray-100 transition duration-150 ease-in-ou">
                        <img :src="language.icon" alt="" class="w-4 h-4 mr-3">
                        {{ language.name }}
                        </Link>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItems, MenuItem, TransitionRoot } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { getLocale } from './../../Composables/useRoute'
const props = defineProps({
    class: {
        type: String,
        default: ''
    },
    buttonClass: {
        type: String,
        default: ''
    },
});

const mergedClass = computed(() => `text-center items-center py-3 px-6 tracking-widest ${props.class}`)
const mergedButtonClass = computed(() => `inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-background focus:!ring-0 ${props.buttonClass}`)
const languages = [
    {
        code: 'en',
        name: 'English',
        icon: '/assets/icons/countries/united-states.png'
    },
    {
        code: 'id',
        name: 'Indonesia',
        icon: '/assets/icons/countries/indonesia.png'
    }
]

const selectedLanguage = computed(() => {
    return languages.find(language => language.code === getLocale())
})

const menuHover = ref(false)
const menuTimeout = ref()
const hoverMenu = (e, open) => {
    menuHover.value = true
    if (!open) {
        e.target.click()
    }
}

const closeMenu = (close) => {
    menuHover.value = false
    if (menuTimeout.value) clearTimeout(menuTimeout.value)
    menuTimeout.value = setTimeout(() => {
        if (!menuHover.value) {
            close()
        }
    }, 100)
}
</script>
