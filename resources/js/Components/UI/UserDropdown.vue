<template>
    <div class="relative inline-block text-left">
        <Menu as="div" class="relative">
            <MenuButton
                class="flex items-center bg-gray-800 text-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                <span
                    class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-600 text-white text-xl">
                    {{ useNameInitials(props.user.name) }}
                </span>
            </MenuButton>

            <transition enter="transition ease-out duration-150" enter-from="transform opacity-0 scale-95"
                enter-to="transform opacity-100 scale-100" leave="transition ease-in duration-100"
                leave-from="transform opacity-100 scale-100" leave-to="transform opacity-0 scale-95">
                <MenuItems :class="[`origin-top-${position}`, `${position}-0`]"
                    class="absolute mt-2 w-56 rounded-lg shadow-lg bg-white focus:outline-none">
                    <div class="py-1">


                        <template v-for="nav of navLinks">
                            <MenuItem v-if="nav.type === 'link'">
                            <Link :href="$useRoute(nav.href)"
                                :class="{ '!font-semibold bg-gray-100 !cursor-default disabled': usePage().url === $useRoute(nav.href) }"
                                class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">{{ __(nav.textKey) }}
                            </Link>
                            </MenuItem>

                            <MenuItem v-if="nav.type === 'button'">
                            <button v-if="nav.method === 'post'" @click="router.post($useRoute(nav.href))" type="button"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">{{
                        __(nav.textKey) }}</button>
                            </MenuItem>
                        </template>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { usePage } from '@inertiajs/vue3'
import { useNameInitials } from '../../Composables/useNameInitials'


import { router, Link } from '@inertiajs/vue3'

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    position: {
        type: String,
        default: 'left',
        validator(value) {
            return ['left', 'right'].includes(value)
        }
    },
})

const navLinks = [
    {
        type: 'link',
        href: '/user/profile',
        textKey: 'header.navbar.profile',
    },
    // {
    //     type: 'link',
    //     href: '/dashboard',
    //     textKey: 'header.navbar.dashboard',
    // },
    {
        type: 'link',
        href: '/saved-destinations',
        textKey: 'header.navbar.saved_destinations',
    },
    {
        type: 'button',
        method: 'post',
        href: '/logout',
        textKey: 'header.navbar.logout',
    },
]
</script>

<style scoped>
.menu-button {
    display: flex;
    align-items: center;
    background-color: #2d3748;
    color: white;
    border-radius: 9999px;
    padding: 0.5rem;
    cursor: pointer;
}

.menu-items {
    position: absolute;
    right: 0;
    margin-top: 0.5rem;
    border-radius: 0.5rem;
    background-color: white;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    z-index: 50;
    min-width: 14rem;
    /* Set a minimum width for the dropdown */
    font-family: 'Inter', sans-serif;
    /* Use a clean, modern font */
}

.menu-item {
    padding: 0.75rem 1rem;
    transition: background-color 0.15s ease;
}

.menu-item:hover {
    background-color: #edf2f7;
}
</style>
