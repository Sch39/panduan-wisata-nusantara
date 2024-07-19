<template>
    <div class="m-5">
        <Link :href="$useRoute(props.previous_url)" class="focus:outline-none flex w-fit items-center mb-2 p-2">
        <i class='bx bx-arrow-back text-xl'></i>
        <h3 class="text-xl text-center font-bold item ml-2">{{ __('utils.back') }}</h3>
        </Link>

        <div class="w-full mx-auto p-2 bg-white rounded-lg shadow-md">
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
                        <h1 class="text-4xl font-bold text-white text-center">{{
            props.destination_detail.destination_details[0].title
        }}
                        </h1>
                    </div>
                </div>

                <!-- Rating and Vote Count -->
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center space-x-1">
                        <Rating :rating="parseFloat(props.destination_detail.rating.avg_rating).toFixed(1)"
                            fill-color="text-accent" background-color="text-gray-200" :size="20" />
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
                <Form
                    v-if="$page.props.auth && !props.destination_detail.votes.find(vote => vote.user_id === $page.props.auth.id)"
                    @submit="store" class="bg-white p-6 rounded-lg shadow-md">
                    <!-- Rating Display on the Left -->
                    <div class="flex item-start justify-between w-full">
                        <div class="flex items-center space-x-4">
                            <Rating :rating="parseFloat(form.rating).toFixed(1)" fill-color="text-accent"
                                background-color="text-gray-200" :size="12" />
                        </div>

                        <!-- Form on the Right -->
                        <div class="flex items-start space-x-4">
                            <div class="flex flex-col space-y-2">
                                <Field type="number" min="0" max="5" rules="required|numeric|min_value:0|max_value:5"
                                    step="0.5" name="rating" v-model="form.rating"
                                    class="w-32 py-2 px-4 border border-slate-300 rounded-lg focus:outline-none focus:border-blue-500 hover:shadow-md transition duration-150 ease-in-out"
                                    placeholder="Enter rating" />

                            </div>
                            <button type="submit"
                                class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                                :disabled="form.processing" :class="{ '!bg-blue-200 ': form.processing }">
                                Vote
                                <i v-if="form.processing" class="bx bx-loader-alt bx-spin ml-2"></i>
                            </button>

                        </div>
                    </div>
                    <div class="text-right mt-2">
                        <p class="text-red-500 text-sm" v-if="form.errors.rating">{{ form.errors.rating }}</p>
                        <ErrorMessage as="p" v-else class="text-red-500 text-sm" name="rating" />
                    </div>
                </Form>

                <div v-if="!$page.props.auth" class="text-center text-xl">
                    <TranslateWithLinks tKey="utils.login_for_rating" :replaces="{
            login: { text: __('header.navbar.login'), href: $useRoute('/login') }
        }">
                        <template #text="{ value }">
                            <span>{{ value }}</span>
                        </template>
                        <template #link="{ href, value }">
                            <Link class="text-indigo-500 underline-offset-4 hover:underline" :href="href">{{ value }}
                            </Link>
                        </template>
                    </TranslateWithLinks>
                </div>

                <div>
                    <div v-if="props.destination_detail.votes.length < 1">
                        <p class="text-xl mt-8 text-center
                        ">Belum ada review</p>
                    </div>

                    <div v-else v-for="vote in props.destination_detail.votes" :key="vote.id"
                        class="p-4 bg-white shadow-md rounded-lg flex items-center space-x-4">
                        <div class="flex items-center">
                            <Rating :rating="parseFloat(vote.rating).toFixed(1)" fill-color="text-accent"
                                background-color="text-gray-200" :size="12" />
                            <span class="ml-2 text-gray-700 text-lg">{{ parseFloat(vote.rating).toFixed(1) }}</span>
                        </div>
                        <div class="flex-1 text-gray-800">
                            <!-- Display User Name -->
                            <span class="font-semibold">{{ vote.user.name }} </span>
                        </div>
                        <div>
                            <button @click.prevent="destroy(vote.id)" class="px-2 py-1 rounded-sm hover:bg-gray-200">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref } from 'vue';
import { Link, Head, useForm } from '@inertiajs/vue3'
import Rating from './../../Components/UI/Rating.vue'
import { useVeeValidateI18n } from '../../Composables/useVeeValidateI18n'
import { Form, Field, ErrorMessage } from 'vee-validate'
import TranslateWithLinks from './../../Components/UI/TranslateWithLink.vue'
import { useRoute } from '../../Composables/useRoute'
import { useToast } from 'vue-toastification'


useVeeValidateI18n()
const toast = useToast()


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

const activeTab = ref('destination'),
    form = useForm({
        rating: 0,
        destination_id: props.destination_detail.id,
    })

function store() {
    form.post(useRoute('/votes'), {
        onError(errors) {
            if (errors.message) {
                toast.error(errors.message, {
                    icon: 'bx bx-error',
                    toastClassName: 'toast-error',
                });
            }
        },
        onSuccess(page) {
            toast.success(page.props.flash.message, {
                icon: 'bx bx-check',
                toastClassName: 'toast-succes',
            });
        }
    })
}

function destroy(id) {
    const form = useForm({})
    form.delete(useRoute(`/votes/${id}`), {
        onError(errors) {
            if (errors.message) {
                toast.error(errors.message, {
                    icon: 'bx bx-error',
                    toastClassName: 'toast-error',
                });
            }
        },
        onSuccess(page) {
            toast.success(page.props.flash.message, {
                icon: 'bx bx-check',
                toastClassName: 'toast-succes',
            });
        }
    })
}
</script>
