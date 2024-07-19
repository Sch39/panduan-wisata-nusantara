<template>

    <Head>
        <title>{{ __('pages.travel_inspiration_list.title') }}</title>
        <meta head-key="description" name="description"
            :content="__('pages.travel_inspiration_list.meta_description')" />
    </Head>

    <div class="m-5">
        <Link :href="$useRoute('/')" class="focus:outline-none flex w-fit items-center mb-5">
        <i class='bx bx-arrow-back text-xl'></i>
        <h3 class="text-xl text-center font-bold item ml-2">{{ __('pages.home.title') }}</h3>
        </Link>
        <h2 class="text-center text-3xl font-semibold mb-5">{{ __('header.navbar.travel_inspiration') }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Menggunakan grid untuk responsivitas -->
            <Link v-for="(destination, index) in props.travel_inspirations_pagination.data"
                :key="`${index}-${destination.id}`" :href="$useRoute(`/travel-inspirations/${destination.slug.slug}`)"
                class="card-link rounded-md">
            <img class="card-image" :src="destination.image_url" :alt="destination.title">
            </Link>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex items-center justify-center space-x-4">
            <Link v-if="props.travel_inspirations_pagination.prev_page_url"
                :href="props.travel_inspirations_pagination.prev_page_url"
                class="px-4 py-2 bg-accent text-navbar-link rounded-lg hover:bg-secondary transition-colors duration-300">
            <i class="bx bxs-chevron-left font-semibold text-lg"></i>
            </Link>
            <span class="px-4 py-2 bg-accent opacity-50 text-navbar-link rounded-lg font-semibold text-lg">{{
            props.travel_inspirations_pagination.current_page
        }}</span>
            <Link v-if="props.travel_inspirations_pagination.next_page_url"
                :href="props.travel_inspirations_pagination.next_page_url"
                class="px-4 py-2 bg-accent text-navbar-link rounded-lg hover:bg-secondary transition-colors duration-300">
            <i class="bx bxs-chevron-right font-semibold text-lg"></i>

            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link, Head } from '@inertiajs/vue3'
const props = defineProps({
    travel_inspirations_pagination: {
        type: Object,
        required: true,
    },
});
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
