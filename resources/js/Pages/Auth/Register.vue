<template>

    <Head>
        <title>{{ __('pages.login.title') }}</title>
        <meta head-key="description" name="description" :content="__('pages.home.meta_description')" />
    </Head>

    <img src="/assets/images/traveler-asian-couple-direction-location-map-beijing-china.jpg" alt="Register Banner"
        class="w-full h-48 object-cover">

    <Form @submit="submitFom"
        class="mx-auto flex min-h-screen w-full items-center justify-center bg-white text-text pt-10">
        <div class="flex mx-5 sm:w-[35rem] flex-col space-y-10">
            <div>
                <h2 class="text-center text-4xl font-semibold font-serif mb-5">{{
            __('pages.register.register_title').toUpperCase()
        }}</h2>
                <p class="text-center text-xl font-serif ">{{ __('pages.register.register_description') }}</p>
            </div>
            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <Field v-model="form.name" rules="required|min:4|alpha_spaces" name="name" type="text"
                        :placeholder="__('utils.name_placeholder')"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />
                </div>
                <p class="text-red-500" v-if="form.errors.name">{{ form.errors.name }}</p>
                <ErrorMessage v-else class="text-red-500" name="name" />
            </div>

            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <Field v-model="form.email" rules="required|email" name="email" type="text"
                        :placeholder="__('utils.email_placeholder')"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />
                </div>
                <p class="text-red-500" v-if="form.errors.email">{{ form.errors.email }}</p>
                <ErrorMessage v-else class="text-red-500" name="email" />
            </div>

            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <Field v-model="form.password" rules="required|password|min:8" name="password"
                        :type="showPassword ? 'text' : 'password'" :placeholder="__('utils.password_placeholder')"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />

                    <button type="button" @click="toggleShowPassword"
                        class="absolute right-0 top-0 mt-2 mr-2 focus:outline-none">
                        <component :is="showPassword? EyeIcon: EyeSlashIcon" class="w-5 h-5"></component>
                    </button>
                </div>
                <p class="text-red-500" v-if="form.errors.password">{{ form.errors.password }}</p>
                <ErrorMessage v-else class="text-red-500" name="password" />
            </div>

            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <Field v-model="form.password_confirmation" rules="required|confirmed:password"
                        name="password_confirmation" :type="showPasswordConfirmation ? 'text' : 'password'"
                        :placeholder="__('utils.password_confirmation_placeholder')"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />

                    <button type="button" @click="toggleShowPasswordConfirmation"
                        class="absolute right-0 top-0 mt-2 mr-2 focus:outline-none">
                        <component :is="showPasswordConfirmation? EyeIcon: EyeSlashIcon" class="w-5 h-5"></component>
                    </button>
                </div>
                <p class="text-red-500" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}
                </p>
                <ErrorMessage v-else class="text-red-500" name="password_confirmation" />
            </div>

            <div>
                <div class="text-text">
                    <Field v-model="form.terms_of_service_and_privacy_policy" name="terms_of_service_and_privacy_policy"
                        rules="accepted" type="checkbox" id="recaptcha_confirmation"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                    <label class="ml-2" for="recaptcha_confirmation">
                        <TranslateWithLinks tKey="utils.recaptcha_notice" :replaces="{
            privacy_policy: { text: __('utils.privacy_policy'), href: 'https://policies.google.com/privacy' },
            terms_of_service: { text: __('utils.terms_of_service'), href: 'https://policies.google.com/terms' },
        }
            ">
                            <template #text="{ value }">
                                <span>{{ value }}</span>
                            </template>
                            <template #link="{ href, value }">
                                <a target="_blank" class="text-indigo-500 underline-offset-4 hover:underline"
                                    :href="href">{{
            value }}</a>
                            </template>
                        </TranslateWithLinks>
                    </label>
                </div>
                <p class="text-red-500" v-if="form.errors.terms_of_service_and_privacy_policy">{{
            form.errors.terms_of_service_and_privacy_policy }}</p>
                <ErrorMessage v-else class="text-red-500" name="terms_of_service_and_privacy_policy" />
            </div>

            <div class="flex justify-center">
                <button :class="{ '!bg-accent !text-navbar-link opacity-75 cursor-not-allowed': form.processing }"
                    :disabled="form.processing"
                    class="transform bg-primary py-2 font-bold duration-300 text-background rounded-full px-8 text-lg hover:bg-accent hover:bg-opacity-50 hover:text-navbar-link">{{
            __('pages.register.register').toUpperCase() }}

                    <i v-if="form.processing" class='bx bx-loader-alt bx-spin'></i>
                </button>

            </div>

            <!-- <div class="w-full flex justify-center">
                <button
                    class="flex items-center bg-white border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <img class="w-5 h-5 mr-2" src="/assets/icons/social-media/google.svg" alt="">
                    <span>Continue with Google</span>
                </button>
            </div> -->

            <p class="text-center text-lg">
                <TranslateWithLinks tKey="pages.register.login_notice" :replaces="{
            login: { text: __('pages.login.login'), href: $useRoute('/login') }
        }">
                    <template #text="{ value }">
                        <span>{{ value }}</span>
                    </template>
                    <template #link="{ href, value }">
                        <Link class="text-indigo-500 underline-offset-4 hover:underline" :href="href">{{ value }}</Link>
                    </template>
                </TranslateWithLinks>
            </p>
        </div>
    </Form>
</template>

<script setup>
import { Link, Head, useForm, usePage } from '@inertiajs/vue3'
import TranslateWithLinks from '../../Components/UI/TranslateWithLink.vue'
import { Form, Field, ErrorMessage } from 'vee-validate'
import { useVeeValidateI18n } from '../../Composables/useVeeValidateI18n'
import { useRoute } from '../../Composables/useRoute'
import { ref, watch } from 'vue'
import { setLocale } from "@vee-validate/i18n";
import { EyeIcon, EyeSlashIcon } from '@heroicons/vue/20/solid'



const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    terms_of_service_and_privacy_policy: 'on',
    'g-recaptcha-response': ''
})

useVeeValidateI18n()

// watch(() => usePage().props.locale, (newLocale) => {
//     setLocale(newLocale)
// })

const showPassword = ref(false),
    showPasswordConfirmation = ref(false)

function toggleShowPassword() {
    showPassword.value = !showPassword.value
}
function toggleShowPasswordConfirmation() {
    showPasswordConfirmation.value = !showPasswordConfirmation.value
}


function submitFom() {
    grecaptcha.ready(function() {
        grecaptcha.execute(usePage().props.grecaptcha_key, { action: 'submit' }).then(function(token) {
            form['g-recaptcha-response'] = token

            form.transform((data) => ({ ...data, terms_of_service_and_privacy_policy: 'on' })).post(useRoute('/register'), {
                onError(errors) {
                    if (errors['g-recaptcha-response']) {
                        alert(errors['g-recaptcha-response'])
                    }
                },
                preserveScroll: true,
            });
        });
    });
}
</script>
