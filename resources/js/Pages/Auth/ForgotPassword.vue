<template>

    <Head>
        <title>{{ __('pages.reset_password.title') }}</title>
    </Head>
    <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
        <h1 class="text-4xl font-medium">{{ __('pages.reset_password.content_title') }}</h1>
        <p class="text-slate-500">{{ __('pages.reset_password.content_description') }}</p>
        <p v-if="isEmailSended" class="mt-2 text-sm text-gray-600">
            <TranslateWithLinks tKey="pages.email_confirmation.content_description" :replaces="{
            email: { text: form.email, href: '' }
        }">
                <template #text="{ value }">
                    <span>{{ value }}</span>
                </template>
                <template #link="{ value }">
                    <span class="font-bold">{{ value }}</span>
                </template>
            </TranslateWithLinks>
        </p>

        <Form @submit="submitForm" class="my-10">
            <div class="flex flex-col space-y-5">
                <label for="email">
                    <p class="font-medium text-slate-700 pb-2">{{ __('pages.reset_password.form_label') }}</p>
                    <Field v-model="form.email" id="email" name="email" rules="email|required" type="email"
                        class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                        :placeholder="__('utils.email_placeholder')" />

                    <p class="text-red-600" v-if="form.errors.email">{{ form.errors.email }}</p>
                    <ErrorMessage v-else class="text-red-500" name="email" />
                </label>

                <button :class="{ '!bg-blue-300 cursor-not-allowed': isButtonDisabled }" :disabled="isButtonDisabled"
                    type="submit"
                    class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                    </svg>

                    <span>{{ __('pages.reset_password.form_submit_button') }}</span>
                    <i v-if="form.processing" class="bx bx-loader-alt bx-spin ml-2"></i>
                </button>
                <p class="text-center">
                    <TranslateWithLinks tKey="pages.login.create_account_notice" :replaces="{
            create_account: { text: __('pages.login.create_account'), href: $useRoute('/register') }
        }">
                        <template #text="{ value }">
                            <span>{{ value }}</span>
                        </template>
                        <template #link="{ href, value }">
                            <Link class="text-indigo-500 underline-offset-4 hover:underline" :href="href">{{ value }}
                            </Link>
                        </template>
                    </TranslateWithLinks>
                </p>
                <p v-if="isEmailSended" class="mt-2 text-s text-center text-red-600">
                    {{ __('pages.email_confirmation.waiting_message', { time: formattedTime }) }}
                </p>
            </div>
        </Form>
    </div>
</template>
<script setup>
import { Head, Link, usePage, useForm } from '@inertiajs/vue3'
import { useRoute } from '../../Composables/useRoute'
import { Form, Field, ErrorMessage } from 'vee-validate'
import { useVeeValidateI18n } from '../../Composables/useVeeValidateI18n'
import { useToast } from 'vue-toastification'
import { ref, computed } from 'vue'
import TranslateWithLinks from './../../Components/UI/TranslateWithLink.vue'


const toast = useToast()
const isButtonDisabled = ref(false),
    isEmailSended = ref(false),
    remainingTime = ref(0)

useVeeValidateI18n()

const form = useForm({
    email: null,
    locale: usePage().props.locale
})

function submitForm() {
    isButtonDisabled.value = true
    form.post(useRoute('/forgot-password'), {
        onError(errors) {
            if (errors.message) {
                toast.error(errors.message, {
                    icon: 'bx bx-error',
                    toastClassName: 'toast-error',
                });
            }
            setTimeout(() => {
                form.errors.email = null
                isButtonDisabled.value = false
            }, 2000);
        },
        onSuccess(page) {
            isEmailSended.value = true
            remainingTime.value = 90
            startTimer()

            toast.success(page.props.flash.message, {
                icon: 'bx bx-check',
                toastClassName: 'toast-succes',
            });
        }
    })
}

const startTimer = () => {
    const interval = setInterval(() => {
        remainingTime.value -= 1
        if (remainingTime.value <= 0) {
            clearInterval(interval)
            isButtonDisabled.value = false
            isEmailSended.value = false
        }
    }, 1000)
}

const formattedTime = computed(() => {
    const minutes = Math.floor(remainingTime.value / 60)
    const seconds = remainingTime.value % 60
    return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`
})
</script>
