<template>
    <div class="m-5">
        <Link :href="$useRoute(props.previous_url)" class="focus:outline-none flex w-fit items-center mb-2 p-2">
        <i class='bx bx-arrow-back text-xl'></i>
        <h3 class="text-xl text-center font-bold item ml-2">{{ __('utils.back') }}</h3>
        </Link>

        <div class="w-full mx-auto p-2 bg-white rounded-lg shadow-md">
            <!-- Tabs for Reviews -->
            <div class="mt-1">
                <div class="border-b border-gray-300">
                    <nav class="flex space-x-4">
                        <button
                            :class="{ 'border-b-2 border-accent text-text': activeTab === 'destination', 'text-navbar-link': activeTab !== 'destination' }"
                            @click="activeTab = 'destination'"
                            class="py-2 px-4 text-lg font-semibold focus:outline-none">
                            Destination
                        </button>

                        <button
                            :class="{ 'border-b-2 border-accent text-text': activeTab === 'reviews', 'text-navbar-link': activeTab !== 'reviews' }"
                            @click="activeTab = 'reviews'" class="py-2 px-4 text-lg font-semibold focus:outline-none">
                            Reviews
                        </button>
                    </nav>
                </div>
            </div>

            <div v-if="activeTab === 'destination'" class="mt-4">
                <div class="relative">
                    <img :src="props.destination_detail.destination_details[0].image_url" alt="Destination Image"
                        class="w-full h-64 object-cover rounded-lg">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-40 rounded-lg">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <h1 class="text-4xl font-bold text-white">{{
            props.destination_detail.destination_details[0].title
        }}
                        </h1>
                    </div>
                </div>

                <!-- Rating and Vote Count -->
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center space-x-1">
                        <Rating :rating="parseFloat(props.destination_detail.rating.avg_rating).toFixed(1)"
                            fill-color="text-accent" background-color="text-gray-200" :size="12" />
                        <span class="font-semibold ml-2 text-sm">{{
            parseFloat(props.destination_detail.rating.avg_rating).toFixed(1)
        }}</span>
                        <span class="text-sm text-gray-600">({{ props.destination_detail.votes.length }} votes)</span>
                    </div>
                </div>

                <!-- Description and Content -->
                <div class="mt-6">
                    <div v-html="props.destination_detail.destination_details[0].html_content" class="text-gray-700">
                    </div>
                </div>
            </div>

            <div class="mt-4" v-else-if="activeTab === 'reviews'">
                <div>
                    <p class="text-gray-600">Reviews content will be here...</p>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import { Link, Head } from '@inertiajs/vue3'
import Rating from './../../Components/UI/Rating.vue'

const props = defineProps({
    destination_detail: {
        required: true,
        type: Object
    },
    previous_url: {
        type: String,
        default: ''
    },
})

const activeTab = ref('destination');
</script>
