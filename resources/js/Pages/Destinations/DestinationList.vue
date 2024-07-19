<template>

    <Head>
        <title>{{ __('pages.destination_lists.title', {
            regency:
                toTitleCase(props.destinations_pagination.data[0]['regency']['name'])
        })
            }}</title>
        <meta head-key="description" name="description" :content="__('pages.destination_lists.meta_description', {
            regency:
                toTitleCase(props.destinations_pagination.data[0]['regency']['name'])
        })" />
    </Head>

    <div class="m-5">
        <Link :href="$useRoute('/')" class="focus:outline-none flex w-fit items-center mb-5">
        <i class='bx bx-arrow-back text-xl'></i>
        <h3 class="text-xl text-center font-bold item ml-2">{{ __('pages.home.title') }}</h3>
        </Link>

        <h2 class="text-center text-3xl font-semibold mb-5">{{ __('pages.destination_lists.content_title', {
            regency:
                toTitleCase(props.destinations_pagination.data[0]['regency']['name'])
        }) }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Menggunakan grid untuk responsivitas -->
            <div v-for="(destination, index) in props.destinations_pagination.data" :key="`${index}-${destination.id}`">
                <DestinationCard class="w-full " :title="destination.title"
                    :address="`${destination.regency.name}, ${destination.regency.province.name}`"
                    :rating="destination.destination.rating.avg_rating" :description="destination.description"
                    :buttonLink="$useRoute('/tour/' + destination.destination.slug)"
                    :buttonText="__('utils.visit').toUpperCase()" />
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex items-center justify-center space-x-4">
            <Link v-if="props.destinations_pagination.prev_page_url" :href="props.destinations_pagination.prev_page_url"
                class="px-4 py-2 bg-accent text-navbar-link rounded-lg hover:bg-secondary transition-colors duration-300">
            <i class="bx bxs-chevron-left font-semibold text-lg"></i>
            </Link>
            <span class="px-4 py-2 bg-accent opacity-50 text-navbar-link rounded-lg font-semibold text-lg">{{
            props.destinations_pagination.current_page
        }}</span>
            <Link v-if="props.destinations_pagination.next_page_url" :href="props.destinations_pagination.next_page_url"
                class="px-4 py-2 bg-accent text-navbar-link rounded-lg hover:bg-secondary transition-colors duration-300">
            <i class="bx bxs-chevron-right font-semibold text-lg"></i>

            </Link>
        </div>
    </div>
</template>

<script setup>
import DestinationCard from '../../Components/Home/DestinationCard.vue'
import { Link, Head } from '@inertiajs/vue3'
import { toTitleCase } from '../../Helper/toTitlecase'
const props = defineProps({
    destinations_pagination: {
        type: Object,
        required: true,
    },
});
</script>
