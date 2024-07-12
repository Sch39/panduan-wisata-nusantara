<template>
    <div class="relative inline-block text-left">
        <Menu as="div" class="relative">
            <MenuButton
                class="flex items-center bg-gray-800 text-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                <span
                    class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-600 text-white text-xl">
                    {{ initials }}
                </span>
            </MenuButton>

            <transition enter="transition ease-out duration-150" enter-from="transform opacity-0 scale-95"
                enter-to="transform opacity-100 scale-100" leave="transition ease-in duration-100"
                leave-from="transform opacity-100 scale-100" leave-to="transform opacity-0 scale-95">
                <MenuItems :class="[`origin-top-${position}`, `${position}-0`]"
                    class="absolute mt-2 w-56 rounded-lg shadow-lg bg-white focus:outline-none">
                    <div class="py-1">
                        <MenuItem>
                        <Link :href="props.dashboardLink"
                            class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">{{ props.dashboardText }}
                        </Link>
                        </MenuItem>
                        <MenuItem>
                        <Link :href="props.savedDestinationsLink"
                            class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">{{
                        props.savedDestinationsText }}</Link>
                        </MenuItem>
                        <MenuItem>
                        <button @click="router.post(props.logoutLink)" type="button"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">{{
                        props.logoutText }}</button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'

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
    dashboardLink: { type: String, required: true },
    dashboardText: { type: String, required: true },
    savedDestinationsLink: { type: String, required: true },
    savedDestinationsText: { type: String, required: true },
    logoutLink: { type: String, required: true },
    logoutText: { type: String, required: true },
})

const initials = computed(() => {
    const names = props.user.name.split(' ')
    return names.map(name => name.charAt(0)).join('').toUpperCase()
})
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
