<template>
    <div class="flex flex-col justify-between flex-1 -mt-10">
        <nav>
            <template v-for="nav of  navLinks ">
                <Link :disabled="usePage().url === $useRoute(nav.link)" v-if="nav.type === 'link'"
                    class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-100 "
                    :class="{ 'bg-gray-100 !cursor-default disabled': usePage().url === $useRoute(nav.link) }"
                    :href="$useRoute(nav.link)">
                <i :class="nav.icon"></i>

                <span :class="{ '!font-semibold': usePage().url === $useRoute(nav.link) }" class="mx-4 font-medium">{{
                __('pages.dashboard.links.' + nav.textKey) }}</span>
                </Link>

                <hr v-if="nav.type === 'hr'" :class="nav.class" />
            </template>

        </nav>
    </div>
    <!-- </aside> -->

</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

const navLinks = [
    {
        type: 'link',
        icon: 'bx bxs-dashboard',
        link: '/dashboard',
        textKey: 'dashboard',
    },
    {
        type: 'link',
        icon: 'bx bxs-leaf',
        link: '/carbon-calculator',
        textKey: 'carbon_calculator',
    },
    {
        type: 'link',
        icon: 'bx bxs-camera',
        link: '/augmentation-reality',
        textKey: 'augmentation_reality',
    },
    {
        type: 'link',
        icon: 'bx bxs-book-open',
        link: '/quiz',
        textKey: 'quiz',
    },
    {
        type: 'link',
        icon: 'bx bxs-coupon',
        link: '/exchange-point',
        textKey: 'exchange_point',
    },
    {
        type: 'hr',
        class: 'my-6 border-gray-200 dark:border-gray-600'
    },
    {
        type: 'link',
        icon: 'bx bxs-bookmarks',
        link: '/saved-destinations',
        textKey: 'saved_destinations',
    },
]
</script>
