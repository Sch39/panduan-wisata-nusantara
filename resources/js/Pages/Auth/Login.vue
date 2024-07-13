<template>

    <Head>
        <title>{{ __('pages.login.title') }}</title>
        <meta head-key="description" name="description" :content="__('pages.home.meta_description')" />
    </Head>

    <img src="/assets/images/group-happy-friends-raised-hands-background-city.jpg" alt="Login Banner"
        class="w-full h-48 object-cover">

    <Form class="mx-auto flex min-h-screen w-full items-center justify-center bg-white text-text pt-10"
        @submit="submitFom">
        <div class="flex mx-5 sm:w-[35rem] flex-col space-y-10">
            <div>
                <h2 class="text-center text-4xl font-semibold font-serif mb-5">{{
            __('pages.login.login_title').toUpperCase()
        }}</h2>
                <p class="text-center text-xl font-serif ">{{ __('pages.login.login_description') }}</p>
            </div>

            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <Field name="email" rules="email|required" type="text" :placeholder="__('utils.email_placeholder')"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                        v-model="form.email" />
                </div>
                <p class="text-red-500" v-if="form.errors.email">{{ form.errors.email }}</p>
                <ErrorMessage v-else class="text-red-500" name="email" />
            </div>

            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <Field name="password" rules="required" :type="showPassword ? 'text' : 'password'"
                        :placeholder="__('utils.password_placeholder')"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                        v-model="form.password" />

                    <button type="button" @click="toggleShowPassword"
                        class="absolute right-0 top-0 mt-2 mr-2 focus:outline-none">
                        <component :is="showPassword? EyeIcon: EyeSlashIcon" class="w-5 h-5"></component>
                    </button>
                </div>

                <p class="text-red-500" v-if="form.errors.email">{{ form.errors.password }}</p>
                <ErrorMessage v-else class="text-red-500" name="password" />
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" value="1"
                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                        v-model="form.remember">
                    <label for="remember_me" class="ml-2 block text-sm leading-5 text-text">{{
            __('pages.login.remember_me') }}</label>
                </div>

                <div class="text-sm leading-5">
                    <Link :href="$useRoute('/forgot-password')"
                        class="transform text-center font-semibold text-text duration-300 hover:underline-offset-2 hover:underline">
                    {{ __('pages.login.forgot_password') }}</Link>
                </div>
            </div>
            <div class="text-text">

                <TranslateWithLinks tKey="utils.recaptcha_notice" :replaces="{
            privacy_policy: { text: __('utils.privacy_policy'), href: 'https://policies.google.com/privacy' },
            terms_of_service: { text: __('utils.terms_of_service'), href: 'https://policies.google.com/terms' },
        }
            ">
                    <template #text="{ value }">
                        <span>{{ value }}</span>
                    </template>
                    <template #link="{ href, value }">
                        <a target="_blank" class="text-indigo-500 underline-offset-4 hover:underline" :href="href">{{
            value }}</a>
                    </template>
                </TranslateWithLinks>
            </div>

            <div class="flex justify-center">
                <button type="submit" :disabled="form.processing"
                    class="transform bg-primary py-2 font-bold duration-300 text-background rounded-full px-8 text-lg hover:bg-accent hover:bg-opacity-50 hover:text-navbar-link">{{
            __('pages.login.login').toUpperCase() }}
                    <i v-if="form.processing" class='bx bx-loader-alt bx-spin'></i>
                </button>
            </div>


            <!-- <div class="w-full flex justify-center">
                <button
                    class="flex items-center bg-white border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <img class="w-5 h-5 mr-2" src="/assets/icons/social-media/google.svg" alt="">
                    <span>{{ __('pages.login.login_google') }}</span>
                </button>
            </div> -->

            <p class="text-center text-lg">
                <TranslateWithLinks tKey="pages.login.create_account_notice" :replaces="{
            create_account: { text: __('pages.login.create_account'), href: $useRoute('/register') }
        }">
                    <template #text="{ value }">
                        <span>{{ value }}</span>
                    </template>
                    <template #link="{ href, value}">
                        <Link class="text-indigo-500 underline-offset-4 hover:underline" :href="href">{{ value }}</Link>
                    </template>
                </TranslateWithLinks>
            </p>
        </div>
    </form>
</template>

<script setup>
import { Head, Link, usePage, useForm } from '@inertiajs/vue3'
import { useRoute } from '../../Composables/useRoute'
import { ref, watch } from 'vue'
import TranslateWithLinks from './../../Components/UI/TranslateWithLink.vue'
import { useVeeValidateI18n } from '../../Composables/useVeeValidateI18n'
import { Form, Field, ErrorMessage } from 'vee-validate'
import { setLocale } from "@vee-validate/i18n";
import { EyeIcon, EyeSlashIcon } from '@heroicons/vue/20/solid'

const showPassword = ref(false)

useVeeValidateI18n()

// watch(() => usePage().props.locale, (newLocale) => {
//     setLocale(newLocale)
// })

const form = useForm({
    email: null,
    password: null,
    remember: false,
    'g-recaptcha-response': ''
})

function submitFom() {
    grecaptcha.ready(function() {
        grecaptcha.execute(usePage().props.grecaptcha_key, { action: 'submit' }).then(function(token) {
            form['g-recaptcha-response'] = token

            form.post(useRoute('/login'), {
                onError(errors) {
                    if (errors['g-recaptcha-response']) {
                        alert(errors['g-recaptcha-response'])
                    }
                }
            });
        });
    });
}

function toggleShowPassword() {
    showPassword.value = !showPassword.value
}

</script>
