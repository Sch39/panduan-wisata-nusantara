<template>
    <img src="/assets/images/traveler-asian-couple-direction-location-map-beijing-china.jpg" alt="Register Banner"
        class="w-full h-48 object-cover">

    <main class="mx-auto flex min-h-screen w-full items-center justify-center bg-white text-text pt-10">
        <section class="flex w-[30rem] flex-col space-y-10">
            <div class="text-center text-4xl font-semibold font-serif">Register</div>
            <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                <input type="text" placeholder="Name"
                    class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />
            </div>
            <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                <input type="text" placeholder="Email"
                    class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />
            </div>

            <div class="w-full transform border-b-2 bg-transparent text-lg duration-300 focus-within:border-accent">
                <input type="password" placeholder="Password"
                    class="w-full border-none bg-transparent outline-none placeholder:italic focus:outline-none" />
            </div>

            <div class="flex justify-center">
                <button
                    class="transform bg-primary py-2 font-bold duration-300 text-background rounded-full px-8 text-lg hover:bg-accent hover:bg-opacity-50 hover:text-navbar-link">REGISTER</button>
            </div>

            <div class="w-full flex justify-center">
                <button
                    class="flex items-center bg-white border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <img class="w-5 h-5 mr-2" src="/assets/icons/social-media/google.svg" alt="">
                    <span>Continue with Google</span>
                </button>
            </div>

            <p class="text-center text-lg">
                Already have account?
                <Link :href="$useRoute('/login')"
                    class="font-medium text-indigo-500 underline-offset-4 hover:underline">Login</Link>
            </p>
        </section>
    </main>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
