<template>
    <Dialog :open="props.open" @close="closeMenu" class="">
        <div class="fixed inset-y-12 right-0 w-full h-full bg-black bg-opacity-10 z-50" />
        <DialogPanel class="fixed inset-y-12 right-0 z-50 w-full h-full overflow-y-auto bg-white px-6 sm:max-w-sm">
            <div class="flow-root">
                <div class="-my-6 divide-y divide-gray-500/20">
                    <div class="space-y-2 py-6">
                        <div class="space-y-2">
                            <!-- Back Button -->
                            <div v-if="selectedMenu" class="space-y-2">
                                <div @click.prevent="goBack"
                                    class="flex justify-start items-center -mx-3 rounded-lg px-3 py-2 text-lg font-semibold leading-7 text-navbar-link hover:bg-gray-100 cursor-pointer">
                                    <ChevronLeftIcon
                                        class="w-5 h-5 mr-2 text-navbar-link transition-transform transform font-semibold" />
                                    {{ selectedMenuTitle.toUpperCase() }}
                                </div>
                            </div>

                            <!-- Menu -->
                            <div v-for="menu of menuData" :key="menu.key">
                                <div v-if="!selectedMenu && menu.type === 'slide'"
                                    @click.prevent="openSubMenu(menu.key)"
                                    class="flex justify-between items-center -mx-3 rounded-lg px-3 py-2 text-lg font-semibold leading-7 text-gray-900 hover:bg-gray-100 cursor-pointer">
                                    {{ menu.name.toUpperCase() }}
                                    <ChevronRightIcon
                                        class="w-5 h-5 ml-2 -mr-1 text-navbar-link transition-transform transform" />
                                </div>

                                <div v-for="(subMenu, index) in menu.child" :key="subMenu.key">
                                    <div v-if="selectedMenu === menu.key && subMenu.type === 'dropdown'" class="">
                                        <div @click.prevent="openDropdown(subMenu.key)"
                                            class="flex justify-between items-center -mx-3 rounded-lg px-3 text-lg leading-7 text-navbar-link hover:bg-gray-100 cursor-pointer"
                                            :class="{ 'font-semibold': subMenu.key === selectedDropdown }">
                                            {{ subMenu.name.toUpperCase() }}
                                            <ChevronDownIcon v-if="subMenu.key === selectedDropdown"
                                                class="w-5 h-5 ml-2 -mr-1 text-navbar-link" />
                                            <ChevronRightIcon v-else class="w-5 h-5 ml-2 -mr-1 text-navbar-link" />
                                        </div>

                                        <div v-if="selectedDropdown === subMenu.key" class="flex flex-col gap-y-2">
                                            <BaseLink
                                                class="inline-block text-sm !font-normal text-navbar-link hover:underline decoration-accent underline-offset-2"
                                                v-for="link of subMenu.child" :key="link.key"
                                                :href="$useRoute(`/${link.href}`)">{{
        link.name }}</BaseLink>
                                        </div>
                                    </div>

                                    <div v-else-if="selectedMenu === menu.key && subMenu.type === 'link'">
                                        <BaseLink
                                            class="inline-block text-sm !font-normal text-navbar-link hover:underline decoration-accent underline-offset-2"
                                            :href="$useRoute(`/${subMenu.href}`)">{{
        subMenu.name.toUpperCase() }}</BaseLink>
                                    </div>

                                    <div v-else-if="selectedMenu === menu.key && subMenu.type === 'card'">
                                        <Link :href="$useRoute(`/travel-inspirations/${subMenu.href}`)"
                                            class="my-5 card-link rounded-md">
                                        <img class="card-image" :src="subMenu.img_link" :alt="subMenu.title">
                                        </Link>

                                        <BaseLink v-if="index === menu.child.length - 1"
                                            class="inline-block !text-lg !font-normal text-navbar-link hover:underline decoration-accent underline-offset-2 mb-10 !mx-auto"
                                            :href="$useRoute(`/travel-inspirations`)">{{
        __('utils.view_more').toUpperCase() }}</BaseLink>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <slot name="navBottom" :selectedMenu="selectedMenu"></slot>
                </div>
            </div>
        </DialogPanel>
    </Dialog>
</template>

<script setup>
import {
    ChevronDownIcon,
    ChevronRightIcon,
    ChevronLeftIcon,
} from '@heroicons/vue/20/solid'
import BaseLink from './BaseLink.vue'
import {
    DialogPanel,
    Dialog,
} from '@headlessui/vue'
import { computed, ref } from 'vue'
import { usePage, Link } from '@inertiajs/vue3';

const props = defineProps({
    open: {
        type: Boolean,
        required: true,
    },
});

const page = usePage();

// Compute menu data
const menuData = computed(() => {
    const propsMenu = page.props.translations.header.navbar;
    const destinations = page.props.destinations.reduce((acc, current) => {
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

    const destinationsFormatted = destinations.map(destination => ({
        name: destination.name,
        key: `${destination.id}-${destination.code}`,
        type: 'dropdown',
        child: destination.regencies.map(regency => ({
            name: regency.name,
            key: `${regency.id}-${regency.code}`,
            type: 'link',
            href: `destinations/${destination.code}${regency.code}`
        }))
    }));

    const travelInspirationsFormatted = page.props.travel_inspirations.map(destination => ({
        id: destination.id,
        type: 'card',
        img_link: destination.image_url,
        title: destination.title,
        href: destination.slug.slug
    }));

    console.log(travelInspirationsFormatted);


    return [
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
            child: travelInspirationsFormatted,
        },
        {
            name: propsMenu.planning,
            key: 'planning',
            type: 'slide',
            child: [
                {
                    name: page.props.translations.pages.dashboard.links.carbon_calculator,
                    key: 'carbon_calculator',
                    type: 'link',
                    href: 'carbon-calculator'
                },
                {
                    name: page.props.translations.pages.dashboard.links.augmentation_reality,
                    key: 'augmentatin_reality',
                    type: 'link',
                    href: 'augmentatin-reality'
                }
            ],
        },
        // {
        //     name: 'Travel Styles',
        //     key: 'travel_styles',
        //     type: 'slide',
        //     child: [
        //         {
        //             name: 'Museum',
        //             key: 'museum',
        //             type: 'link',
        //             href: 'travel-styles/museum',
        //         },
        //         {
        //             name: 'Adventure',
        //             key: 'adventure',
        //             type: 'link',
        //             href: 'travel-styles/adventure',
        //         },
        //     ]
        // }
    ];
});

const selectedDropdown = ref(null);
const selectedMenu = ref(null);
const previousMenu = ref(null);

const selectedMenuTitle = computed(() => menuData.value.find((menu) => menu.key === selectedMenu.value)?.name);

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
<style scoped>
.card-link {
    display: block;
    position: relative;
    overflow: hidden;
}

.card-image {
    transition: transform 0.3s ease, filter 0.3s ease;
    width: 100%;
    height: auto;
}

.card-link:hover .card-image {
    transform: scale(1.05);
    filter: brightness(50%);
}
</style>
