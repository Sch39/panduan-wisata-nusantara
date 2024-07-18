<template>

    <Head>
        <title>{{ __('pages.provinces.title') }}</title>
        <meta head-key="description" name="description" :content="__('pages.provinces.meta_description')" />
    </Head>

    <div class="p-4 mt-2 min-h-screen">
        <div class="flex items-center mb-5">
            <button class="focus:outline-none">
                <i class='bx bx-arrow-back text-2xl'></i>
            </button>
            <h2 class="text-2xl font-bold item ml-4">{{ __('pages.provinces.content_title') }}</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <Link v-for="province in props.provinces" :key="province.code"
                :href="$useRoute(`/provinces/${province.code}`)"
                class="p-2 bg-blue-50 hover:bg-blue-100 rounded-lg text-center block border shadow-md">
            {{ province.name }}
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link, Head } from '@inertiajs/vue3'
const props = defineProps({
    provinces: {
        type: Object,
        required: true,
    }
})
</script>
