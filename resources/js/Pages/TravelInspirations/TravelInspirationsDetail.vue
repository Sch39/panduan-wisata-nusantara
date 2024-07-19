<template>

    <Head>
        <title>{{ __('pages.travel_inspiration_detail.title', { title: props.travel_inspirations_detail.title }) }}
        </title>
        <meta head-key="description" name="description"
            :content="__('pages.travel_inspiration_detail.meta_description', { title: props.travel_inspirations_detail.title, author: props.travel_inspirations_detail.author })" />
    </Head>
    <div class="m-5">
        <Link :href="$useRoute('/travel-inspirations')" class="focus:outline-none flex w-fit items-center mb-5">
        <i class='bx bx-arrow-back text-xl'></i>
        <h3 class="text-xl text-center font-bold item ml-2">{{ __('header.navbar.travel_inspiration') }}</h3>
        </Link>

        <div class="container mx-auto">
            <!-- Card Container -->
            <div class="bg-white shadow-sm border rounded-md overflow-hidden">
                <img :src="props.travel_inspirations_detail.image_url" alt="Travel Inspiration"
                    class="w-full h-64 object-cover" />

                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ props.travel_inspirations_detail.title }}</h1>
                    <p class="text-sm text-gray-600 mb-4">{{ __('pages.travel_inspiration_detail.picture_by',
            { author: props.travel_inspirations_detail.author }) }}</p>
                    <div v-html="props.travel_inspirations_detail.html_content" class="text-gray-700 mb-4"></div>

                    <!-- Link to Destination -->
                    <Link :href="props.travel_inspirations_detail.destination.slug"
                        class="text-accent font-semibold hover:underline">
                    {{ __('utils.view_destination') }}
                    </Link>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    'travel_inspirations_detail': {
        required: true,
        type: Object
    }
})
</script>
