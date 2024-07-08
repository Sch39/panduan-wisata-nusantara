<template>
    <Dialog :open="props.open" @close="closeMenu" class="">
        <div class="fixed inset-y-12 right-0 z-10 w-full h-full bg-black bg-opacity-10" />
        <DialogPanel class="fixed inset-y-12 right-0 z-10 w-full h-full overflow-y-auto bg-background px-6 sm:max-w-sm">
            <div class="flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <div class="space-y-2">
                            <!-- Back Button -->
                            <div v-if="selectedMenu" class="space-y-2">
                                <div @click.prevent="goBack"
                                    class="flex justify-start items-center -mx-3 rounded-lg px-3 py-2 text-lg font-semibold leading-7 text-navbar-link hover:bg-gray-50 cursor-pointer">
                                    <ChevronLeftIcon
                                        class="w-5 h-5 mr-2 text-navbar-link transition-transform transform font-semibold" />
                                    {{ selectedMenuTitle.toUpperCase() }}
                                </div>
                            </div>


                            <!-- Menu -->
                            <div v-for="menu of menuData" :key="menu.key">
                                <div v-if="!selectedMenu && menu.type === 'slide'"
                                    @click.prevent="openSubMenu(menu.key)"
                                    class="flex justify-between items-center -mx-3 rounded-lg px-3 py-2 text-lg font-semibold leading-7 text-gray-900 hover:bg-gray-50 cursor-pointer">
                                    {{ menu.name.toUpperCase() }}
                                    <ChevronRightIcon
                                        class="w-5 h-5 ml-2 -mr-1 text-navbar-link transition-transform transform" />
                                </div>

                                <div v-for="subMenu of menu.child" :key="subMenu.key">
                                    <div v-if="selectedMenu === menu.key && subMenu.type === 'dropdown'" class="">
                                        <div @click.prevent="openDropdown(subMenu.key)"
                                            class="flex justify-between items-center -mx-3 rounded-lg px-3 text-lg leading-7 text-navbar-link hover:bg-gray-50 cursor-pointer"
                                            :class="{ 'font-semibold': subMenu.key === selectedDropdown }">
                                            {{ subMenu.name.toUpperCase() }}
                                            <ChevronDownIcon v-if="subMenu.key === selectedDropdown"
                                                class="w-5 h-5 ml-2 -mr-1 text-navbar-link" />
                                            <ChevronRightIcon v-else class="w-5 h-5 ml-2 -mr-1 text-navbar-link" />
                                        </div>

                                        <div v-if="selectedDropdown === subMenu.key" class="flex flex-col gap-y-2">
                                            <BaseLink
                                                class="inline-block text-sm !font-normal text-navbar-link hover:underline decoration-accent underline-offset-2"
                                                v-for="link of subMenu.child" :key="link.key" :href="link.href">{{
        link.name }}</BaseLink>
                                        </div>
                                    </div>
                                    <div v-else-if="selectedMenu === menu.key && subMenu.type === 'link'">
                                        <BaseLink
                                            class="inline-block text-sm !font-normal text-navbar-link hover:underline decoration-accent underline-offset-2"
                                            :href="subMenu.href">{{
        subMenu.name.toUpperCase() }}</BaseLink>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="py-6" v-if="!selectedMenu">
                        <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-lg font-semibold leading-7 text-navbar-link
                             hover:bg-gray-50">{{
                            __('header.navbar.login').toUpperCase() }}</a>
                    </div>
                </div>
            </div>
        </DialogPanel>
    </Dialog>
</template>

<script setup>
import {
    ChartPieIcon,
    CursorArrowRaysIcon,
    FingerPrintIcon,
    SquaresPlusIcon,
    ArrowPathIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline';
import {
    PlayCircleIcon,
    PhoneIcon,
    ChevronDownIcon,
    ChevronRightIcon,
    ChevronLeftIcon,
} from '@heroicons/vue/20/solid'
import BaseLink from './BaseLink.vue'
import {
    DisclosureButton,
    DisclosurePanel,
    Disclosure,
    DialogPanel,
    Dialog,
} from '@headlessui/vue'
import { computed, ref, inject } from 'vue'
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    open: {
        type: Boolean,
        required: true,
    },
});
const propsMenu = usePage().props.translations.header.navbar;
const destinations = usePage().props.destinations.reduce((acc, current) => {
    const { province } = current.regency;
    const provinceIndex = acc.findIndex(p => p.code === province.code);

    const regency = {
        id: current.regency.id,
        code: current.regency.code,
        name: current.regency.name
    };

    if (provinceIndex === -1) {
        acc.push({
            id: province.id,
            code: province.code,
            name: province.name,
            regencies: [regency]
        });
    } else {
        acc[provinceIndex].regencies.push(regency);
    }

    return acc;
}, []);
const destinationsFormatted = []
for (const destination of destinations) {
    const data = {
        name: destination.name,
        key: `${destination.id}-${destination.code}`,
        type: 'dropdown',
        child: [],
    }

    for (const regency of destination.regencies) {
        data.child.push({
            name: regency.name,
            key: `${regency.id}-${regency.code}`,
            type: 'link',
            href: `destinations/${destination.code}${regency.code}`
        })
    }
    destinationsFormatted.push(data)
}
const menuData = [
    {
        name: propsMenu.destinations,
        key: 'destinations',
        type: 'slide',
        child: destinationsFormatted,
    },
    {
        name: propsMenu.travel_inspiration,
        key: 'travel_inspiration',
        type: 'slide',
        child: [

        ],
    },
    {
        name: propsMenu.planning,
        key: 'planning',
        type: 'slide',
        child: [

        ],
    },
    {
        name: 'Travel Styles',
        key: 'travel_styles',
        type: 'slide',
        child: [
            {
                name: 'Museum',
                key: 'museum',
                type: 'link',
                href: 'travel-styles/museum',
            },
            {
                name: 'Adventure',
                key: 'adventure',
                type: 'link',
                href: 'travel-styles/adventure',
            },
        ]
    }
]

const selectedDropdown = ref(null);
const selectedMenu = ref(null);
const previousMenu = ref(null);
const menuTitles = {
    destination: 'Destination',
    planning: 'Planning',
    travel_inspiration: 'Travel Inspiration',
    travel_styles: 'Travel Styles',
    destination_jawa_tengah: 'Jawa Tengah',
    destination_jawa_barat: 'Jawa Barat'
};
const selectedMenuTitle = computed(() => menuData.find((menu) => menu.key === selectedMenu.value)?.name);

const openSubMenu = (menu) => {
    previousMenu.value = selectedMenu.value;
    selectedMenu.value = menu;
};
const openDropdown = (dropdown) => {
    if (selectedDropdown.value === dropdown) {
        selectedDropdown.value = null
    }
    else {
        selectedDropdown.value = dropdown;
    }
};

const goBack = () => {
    selectedMenu.value = previousMenu.value;
    previousMenu.value = null;
};


const emits = defineEmits(['close']);

const closeMenu = () => {
    selectedMenu.value = null;
    previousMenu.value = null;
    emits('close');
};



</script>
