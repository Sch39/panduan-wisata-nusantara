<template>

    <Head>
        <title>{{ __('pages.provinces.title') }}</title>
        <meta head-key="description" name="description" :content="__('pages.provinces.meta_description')" />
    </Head>

    <div class="p-4 mt-2 min-h-screen">
        <Link :href="$useRoute('/')" class="focus:outline-none flex items-center mb-2">
        <i class='bx bx-arrow-back text-xl'></i>
        <h3 class="text-xl text-center font-bold item ml-2">{{ __('pages.home.title') }}</h3>
        </Link>
        <h2 class="text-2xl text-center font-bold mb-5">{{ __('pages.provinces.content_title') }}</h2>
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
