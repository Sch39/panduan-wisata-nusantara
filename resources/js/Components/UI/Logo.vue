<template>
    <div class="flex sm:hidden lg:flex-1">
        <Link :href="$useRoute('/')" class="-m-1.5 p-1.5">
        <span class="sr-only">Panduan Wisata Nusantara</span>
        <img class="h-8 w-auto" src="/assets/logo/logo-icon.svg" alt="Logo" />
        </Link>
    </div>
    <div class="hidden sm:flex lg:flex-1">
        <Link :href="$useRoute('/')" class="-m-1.5 p-1.5">
        <span class="sr-only">Panduan Wisata Nusantara</span>
        <img class="h-8 w-auto" src="/assets/logo/logo-no-background.png" alt="Logo" />
        </Link>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
</script>
