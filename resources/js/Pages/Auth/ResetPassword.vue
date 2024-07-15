<template>

    <Head>
        <title>{{ __('pages.new_password.title') }}</title>
    </Head>

    <div class="max-w-lg mx-auto my-10 bg-white p-8 rounded-xl shadow shadow-slate-300">
        <h1 class="text-4xl font-medium">{{ __('pages.new_password.content_title') }}</h1>
        <p class="text-slate-500">{{ __('pages.new_password.content_description') }}</p>


        <Form @submit="submitForm" class="my-5">
            <ul class="list-disc px-5 text-red-600">
                <li v-if="form.errors.email">{{ form.errors.email }}</li>
                <ErrorMessage as="li" class="text-red-500" name="email" />
                <li v-if="form.errors['g-recaptcha-response']">{{ form.errors['g-recaptcha-response'] }}</li>
                <li v-if="form.errors.token">{{ form.errors.token }}</li>
            </ul>

            <div class="mt-5">
                <Field name="email" v-model="form.email" rules="required|email" class="!hidden" />

            </div>
            <div class="flex flex-col space-y-5">
                <div>
                    <label for="newPassword">
                        <p class="font-medium text-slate-700 pb-2">{{ __('pages.new_password.new_password_label') }}</p>

                        <div class="relative">
                            <Field v-model="form.new_password" name="new_password" rules="required|password|min:8"
                                id="newPassword" :type="showPassword ? 'text' : 'password'"
                                class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                                :placeholder="__('pages.new_password.new_password_placeholder')" />

                            <button type="button" @click="toggleShowPassword"
                                class="absolute right-0 top-1/2 transform -translate-y-1/2 mr-3 focus:outline-none">
                                <component :is="showPassword ? EyeIcon : EyeSlashIcon" class="w-5 h-5"></component>
                            </button>
                        </div>

                    </label>
                    <p class="text-red-500" v-if="form.errors.new_password">{{ form.errors.new_password }}</p>
                    <ErrorMessage v-else class="text-red-500" name="new_password" />
                </div>

                <div>
                    <label for="passwordConfirmation">
                        <p class="font-medium text-slate-700 pb-2"> {{
            __('pages.new_password.new_password_confirmation_label') }}</p>
                        <div class="relative">
                            <Field v-model="form.new_password_confirmation" name="new_password_confirmation"
                                rules="required|confirmed:new_password" id="passwordConfirmation"
                                :type="showPasswordConfirmation ? 'text' : 'password'"
                                class="w-full py-3 border border-slate-200 rounded-lg px-3 focus:outline-none focus:border-slate-500 hover:shadow"
                                :placeholder="__('pages.new_password.new_password_confirmation_placeholder')" />

                            <button type="button" @click="toggleShowPasswordConfirmation"
                                class="absolute right-0 top-1/2 transform -translate-y-1/2 mr-3 focus:outline-none">
                                <component :is="showPasswordConfirmation ? EyeIcon : EyeSlashIcon" class="w-5 h-5">
                                </component>
                            </button>
                        </div>
                    </label>
                    <p class="text-red-500" v-if="form.errors.new_password_confirmation">{{
            form.errors.new_password_confirmation }}</p>
                    <ErrorMessage v-else class="text-red-500" name="new_password_confirmation" />
                </div>
                <div>
                    <button type="submit"
                        class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center">
                        <span>{{ __('pages.new_password.change_password_button') }}</span>
                    </button>
                </div>

            </div>
        </Form>
    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { useRoute } from '../../Composables/useRoute'
import { useVeeValidateI18n } from '../../Composables/useVeeValidateI18n'
import { Form, Field, ErrorMessage } from 'vee-validate'
import { ref } from 'vue'
import { EyeIcon, EyeSlashIcon } from '@heroicons/vue/20/solid'
import { useToast } from 'vue-toastification'

const toast = useToast()


useVeeValidateI18n()
const showPassword = ref(false),
    showPasswordConfirmation = ref(false)

function toggleShowPassword() {
    showPassword.value = !showPassword.value
}
function toggleShowPasswordConfirmation() {
    showPasswordConfirmation.value = !showPasswordConfirmation.value
}

const { props } = usePage()
const form = useForm({
    email: props.email,
    token: props.token,
    new_password: null,
    new_password_confirmation: null,
    locale: props.locale,
    'g-recaptcha-response': null
})

const submitForm = () => {
    grecaptcha.ready(function() {
        grecaptcha.execute(props.grecaptcha_key, { action: 'submit' }).then(function(token) {
            form['g-recaptcha-response'] = token

            form.post(useRoute('/reset-password'), {
                onError(errors) {
                    console.log(errors);
                    if (errors.message) {
                        toast.error(errors.message, {
                            icon: 'bx bx-error',
                            toastClassName: 'toast-errror',
                        })
                    }
                    setTimeout(() => {
                        form.errors.email = null
                        form.errors.token = null
                        form.errors.password = null
                        form.errors.new_password_confirmation = null
                        form.errors['g-recaptcha-response'] = null
                    }, 5000);
                },
                onSuccess(page) {
                    // console.log(page.props);

                    toast.success(page.props.flash.message, {
                        icon: 'bx bx-check',
                        toastClassName: 'toast-success',
                    })
                },
                preserveScroll: true,
            });
        });
    });
}
</script>

<style scoped>
/* Custom styling if needed */
</style>
