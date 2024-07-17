<template>
    <div class="flex flex-col justify-between flex-1 ">
        <nav>
            <template v-for="nav of  navLinks ">
                <Link :as="nav.status === statuses.comingSoon ? 'button' : 'a'"
                    :disabled="usePage().url === $useRoute(nav.link)" v-if="nav.type === 'link'"
                    class="relative flex w-full items-center px-4 pr-8 py-2 text-gray-700 rounded-md hover:bg-gray-100 "
                    :class="{ 'bg-gray-100 !cursor-default disabled': usePage().url === $useRoute(nav.link), '!cursor-default': nav.status === statuses.comingSoon }"
                    :href="$useRoute(nav.link)">
                <i :class="nav.icon"></i>

                <span :class="{ '!font-semibold': usePage().url === $useRoute(nav.link) }" class="mx-4 font-medium">{{
                __('pages.dashboard.links.' + nav.textKey) }}</span>

                <span v-if="nav.status" :class="{
                'absolute top-0 right-0 text-xs px-2 py-1 rounded-full text-white bg-opacity-85': true,
                'bg-yellow-500': nav.status === statuses.comingSoon,
                'bg-indigo-500': nav.status === statuses.new
            }">
                    {{ nav.status === statuses.comingSoon ? 'Coming Soon' : 'New' }}
                </span>
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
const statuses = {
    comingSoon: "coming_soon",
    new: "new",
    none: null
}

const navLinks = [
    // {
    //     type: 'link',
    //     icon: 'bx bxs-dashboard',
    //     link: '/dashboard',
    //     textKey: 'dashboard',
    // },
    {
        type: 'link',
        icon: 'bx bxs-leaf',
        link: '/carbon-calculator',
        textKey: 'carbon_calculator',
        status: statuses.none,
    },
    {
        type: 'link',
        icon: 'bx bxs-camera',
        link: '/augmentation-reality',
        textKey: 'augmentation_reality',
        status: statuses.new,
    },
    {
        type: 'link',
        icon: 'bx bxs-book-open',
        link: '/quiz',
        textKey: 'quiz',
        status: statuses.comingSoon,
    },
    // {
    //     type: 'link',
    //     icon: 'bx bxs-coupon',
    //     link: '/exchange-point',
    //     textKey: 'exchange_point',
    //     status: statuses.comingSoon,
    // },
    {
        type: 'hr',
        class: 'my-6 border-gray-200 dark:border-gray-600'
    },
    {
        type: 'link',
        icon: 'bx bxs-bookmarks',
        link: '/saved-destinations',
        textKey: 'saved_destinations',
        status: statuses.none,
    },
    {
        type: 'link',
        icon: 'bx bxs-help-circle',
        link: '/help',
        textKey: 'help',
        status: statuses.none,
    },
]
</script>
