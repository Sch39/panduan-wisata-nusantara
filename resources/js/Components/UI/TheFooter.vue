<template>
    <footer class="bg-white rounded-lg m-4">
        <div class="w-full mx-auto max-w-screen-xl p-4 flex flex-col items-center justify-between md:flex-row">
            <span class="text-sm text-gray-500 text-center">© 2023 <a href="/" class="hover:underline">Panduan Wisata
                    Nusantara</a>. All Rights Reserved.</span>
            <ul class="flex flex-wrap justify-center items-center mt-3 text-sm font-medium text-gray-500 md:mt-0">
                <li>
                    <a target="_blank" href="https://policies.google.com/privacy"
                        class="hover:underline me-4 md:me-6">{{ __("utils.privacy_policy") }}</a>
                </li>
                <li>
                    <a target="_blank" :href="$useRoute('/assets-credit')" class="hover:underline me-4 md:me-6">{{
                            __('footer.credit_asset') }}</a>
                </li>
            </ul>
        </div>
    </footer>
</template>
