<template>

    <Head>
        <title>{{ __('pages.dashboard.user.title', { user: usePage().props.auth.name }) }}</title>
    </Head>

    <div class="flex justify-center space-y-5 flex-row">
        <div class="relative">
            <div
                class="flex items-center bg-gray-800 text-white rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                <span
                    class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-indigo-600 text-white text-[50px]">
                    {{ useNameInitials(form.name) }}
                </span>
            </div>
        </div>

    </div>

    <Form @submit="submitFom" class="mx-auto flex min-h-screen w-full justify-center bg-white text-text !mt-10">
        <div class="flex mx-5 w-[35rem] flex-col space-y-10">
            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <Field :disabled="!editName" :class="{ 'text-gray-400': !editName }" v-model="form.name"
                        rules="required|min:4|alpha_spaces" name="name" type="text"
                        :placeholder="__('utils.name_placeholder')"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />

                    <button type="button" @click="toggleEditName"
                        class="absolute right-0 top-0 mt-2 mr-2 focus:outline-none">
                        <PencilSquareIcon :class="{ 'bg-gray-400 bg-opacity-50 rounded-md': editName }"
                            class="w-5 h-5" />
                    </button>
                </div>
                <p class="text-red-500" v-if="form.errors.name">{{ form.errors.name }}</p>
                <ErrorMessage v-else class="text-red-500" name="name" />
            </div>

            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <Field :class="{ 'text-gray-400': !editPassword }" :disabled="!editPassword" v-model="form.password"
                        rules="min:8" name="password" :type="showPassword ? 'text' : 'password'"
                        :placeholder="__('utils.password_placeholder')"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />

                    <div class="absolute right-0 top-0">
                        <button type="button" @click="toggleShowPassword" class="mt-2 mr-2 focus:outline-none">
                            <component :is="showPassword? EyeIcon: EyeSlashIcon" class="w-5 h-5"
                                :class="{ 'opacity-50': !editPassword }"></component>
                        </button>
                        <button type="button" @click="toggleEditPassword" class="mt-2 mr-2 focus:outline-none">
                            <PencilSquareIcon :class="{ 'bg-gray-400 bg-opacity-50 rounded-md': editPassword }"
                                class="w-5 h-5" />
                        </button>
                    </div>

                </div>
                <p class="text-red-500" v-if="form.errors.password">{{ form.errors.password }}</p>
                <ErrorMessage v-else class="text-red-500" name="password" />
            </div>

            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <Field :class="{ 'text-gray-400': !editPassword }" :disabled="!editPassword"
                        v-model="form.password_confirmation" rules="confirmed:password" name="password_confirmation"
                        :type="showPasswordConfirmation ? 'text' : 'password'"
                        :placeholder="__('utils.password_confirmation_placeholder')"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />

                    <button type="button" @click="toggleShowPasswordConfirmation"
                        class="absolute right-0 top-0 mt-2 mr-2 focus:outline-none">
                        <component :is="showPasswordConfirmation? EyeIcon: EyeSlashIcon" class="w-5 h-5"
                            :class="{ 'opacity-50': !editPassword }"></component>
                    </button>
                </div>
                <p class="text-red-500" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}
                </p>
                <ErrorMessage v-else class="text-red-500" name="password_confirmation" />
            </div>

            <div class="flex justify-center">
                <button
                    :class="{ '!bg-accent !text-navbar-link opacity-50 cursor-not-allowed': form.processing || !isDataChanged }"
                    :disabled="form.processing || !isDataChanged"
                    class="transform bg-primary py-2 font-bold duration-300 text-background rounded-full px-8 text-lg hover:bg-accent hover:bg-opacity-50 hover:text-navbar-link">{{
            __('utils.save').toUpperCase() }}

                    <i v-if="form.processing" class='bx bx-loader-alt bx-spin'></i>
                </button>
            </div>

        </div>
    </Form>
</template>

<script setup>
import { Head, useForm, usePage } from '@inertiajs/vue3'

import { Form, Field, ErrorMessage } from 'vee-validate'
import { useVeeValidateI18n } from '../../../Composables/useVeeValidateI18n'
import { useRoute } from '../../../Composables/useRoute'
import { ref, computed } from 'vue'
import { EyeIcon, EyeSlashIcon, PencilSquareIcon } from '@heroicons/vue/20/solid'
import { useToast } from 'vue-toastification'
import { useNameInitials } from '../../../Composables/useNameInitials'

const toast = useToast()
const { props } = usePage()

const form = useForm({
    name: props.auth.name,
    password: '',
    password_confirmation: '',
})

useVeeValidateI18n()

const showPassword = ref(false),
    showPasswordConfirmation = ref(false),
    editName = ref(false),
    editPassword = ref(false)

function toggleEditName() {
    editName.value = !editName.value
}
function toggleEditPassword() {
    editPassword.value = !editPassword.value
}

function toggleShowPassword() {
    showPassword.value = !showPassword.value
}
function toggleShowPasswordConfirmation() {
    showPasswordConfirmation.value = !showPasswordConfirmation.value
}

const isDataChanged = computed(() => form.name !== props.auth.name || form.password !== '')


function submitFom() {
    if (isDataChanged) {
        form.post(useRoute('/user/profile'), {
            onError(errors) {
                console.log(errors);
                if (errors.message) {
                    toast.error(errors.message, {
                        icon: 'bx bx-error',
                        toastClassName: 'toast-error',
                    });
                }
                setTimeout(() => {
                    form.errors.name = null
                    form.errors.password = null
                    form.errors.password_confirmation = null
                }, 3000);
            },
            onSuccess(page) {
                console.log('success');
                console.log(page.props);

                toast.success(page.props.flash.message, {
                    icon: 'bx bx-check',
                    toastClassName: 'toast-succes',
                });
            }
        })
        console.log('data berubah');
    } else {
        console.log('data tidak berubah');
    }
}

</script>
