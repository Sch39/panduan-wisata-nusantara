<template>

    <Head>
        <title>Login page</title>
        <meta head-key="description" name="description" :content="__('pages.home.meta_description')" />
    </Head>

    <img src="/assets/images/group-happy-friends-raised-hands-background-city.jpg" alt="Login Banner"
        class="w-full h-48 object-cover">

    <form class="mx-auto flex min-h-screen w-full items-center justify-center bg-white text-text pt-10"
        @submit.prevent="submitFom">
        <div class="flex w-[30rem] flex-col space-y-10">
            <div>
                <h2 class="text-center text-4xl font-semibold font-serif mb-5">Log In</h2>
                <p class="text-center text-xl font-serif ">Log in below to access your account</p>
            </div>

            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <input type="text" placeholder="Email"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                        v-model="form.email" />
                </div>
                <p class="text-red-500" v-if="form.errors.email">{{ form.errors.email }}</p>
            </div>

            <div>
                <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                    <input type="password" placeholder="Password"
                        class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none"
                        v-model="form.password" />
                </div>

                <p class="text-red-500" v-if="form.errors.email">{{ form.errors.password }}</p>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" value="1"
                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                        v-model="form.remember">
                    <label for="remember_me" class="ml-2 block text-sm leading-5 text-text">Remember me</label>
                </div>

                <div class="text-sm leading-5">
                    <Link :href="$useRoute('/forgot-password')"
                        class="transform text-center font-semibold text-text duration-300 hover:underline-offset-2 hover:underline">
                    Forgot Password?</Link>
                </div>
            </div>
            <div class="text-text">
                <span>This site is protected by reCAPTCHA and the Google </span>
                <a class="text-indigo-500 underline-offset-4 hover:underline" href="https://policies.google.com/privacy"
                    target="_blank">Privacy Policy</a> and
                <a class="text-indigo-500 underline-offset-4 hover:underline" href="https://policies.google.com/terms"
                    target="_blank">Terms of Service</a> apply.
            </div>

            <div class="flex justify-center">
                <button type="submit" :disabled="form.processing"
                    class="transform bg-primary py-2 font-bold duration-300 text-background rounded-full px-8 text-lg hover:bg-accent hover:bg-opacity-50 hover:text-navbar-link">LOG
                    IN
                    <i v-if="form.processing" class='bx bx-loader-alt bx-spin'></i>
                </button>
            </div>


            <div class="w-full flex justify-center">
                <button
                    class="flex items-center bg-white border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <img class="w-5 h-5 mr-2" src="/assets/icons/social-media/google.svg" alt="">
                    <span>Continue with Google</span>
                </button>
            </div>

            <p class="text-center text-lg">
                No account?
                <Link :href="$useRoute('/register')"
                    class="font-medium text-indigo-500 underline-offset-4 hover:underline">Create One</Link>
            </p>
        </div>
    </form>
</template>

<script setup>
import { Head, Link, usePage, useForm } from '@inertiajs/vue3'
import { useRoute } from '../../Composables/useRoute'
const form = useForm({
    email: null,
    password: null,
    remember: false,
    'g-recaptcha-response': ''
})

function submitFom() {
    grecaptcha.ready(function() {
        grecaptcha.execute(usePage().props.grecaptcha_key, { action: 'submit' }).then(function(token) {
            form['g-recaptcha-response'] = token + 'uhuh'
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
</script>
